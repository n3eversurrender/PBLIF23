<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Ambil data pendaftaran berdasarkan pendaftaran_id yang ada di request
        $pendaftaran_id = $request->pendaftaran_id;
        $pendaftaran = Pendaftaran::find($pendaftaran_id);

        if (!$pendaftaran) {
            return response()->json(['error' => 'Pendaftaran tidak ditemukan'], 404);
        }

        // Ambil harga dari kursus yang didaftarkan
        $kursus = $pendaftaran->kursus;
        $totalPembayaran = $kursus->harga;

        // Pastikan gross_amount adalah angka bulat tanpa sen
        $totalPembayaran = round($totalPembayaran);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $orderId = uniqid(); // Buat order ID unik

        // Data untuk Snap token
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPembayaran,
            ],
            'customer_details' => [
                'first_name' => $pendaftaran->pengguna->nama,
                'email' => $pendaftaran->pengguna->email,
            ],
        ];

        try {
            // Ambil Snap token
            $snapToken = Snap::getSnapToken($params);

            // Simpan data pembayaran ke tabel pembayaran
            $pembayaran = Pembayaran::create([
                'pendaftaran_id' => $pendaftaran->pendaftaran_id,
                'tgl_pembayaran' => Carbon::now(),
                'metode_pembayaran' => 'Midtrans',
                'jumlah' => $totalPembayaran,
                'status' => 'Pending',
                'midtrans_order_id' => $orderId,
                'midtrans_transaction_id' => null,
                'midtrans_status' => 'Pending',
                'midtrans_response' => null,
            ]);

            if (!$pembayaran) {
                return response()->json(['error' => 'Pembayaran gagal disimpan'], 500);
            }

            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Gagal memproses pembayaran: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        $orderId = $request->order_id;
        $status = $request->status;

        // Cari pembayaran berdasarkan Order ID
        $pembayaran = \App\Models\Pembayaran::where('midtrans_order_id', $orderId)->first();

        if (!$pembayaran) {
            return response()->json(['error' => 'Order ID tidak ditemukan'], 404);
        }

        // Update status pembayaran
        $pembayaran->status = $status;
        $pembayaran->midtrans_status = $status;
        $pembayaran->save();

        if ($status == 'Berhasil') {
            // Cari pendaftaran terkait
            $pendaftaran = Pendaftaran::find($pembayaran->pendaftaran_id);

            if ($pendaftaran) {
                // Update status_pendaftaran dan status_pembayaran di tabel pendaftaran
                $pendaftaran->status_pendaftaran = 'Aktif'; // Atur status_pendaftaran menjadi 'Aktif'
                $pendaftaran->status_pembayaran = 'Berhasil'; // Atur status_pembayaran menjadi 'Berhasil'
                $pendaftaran->save();
            }
        }
        return response()->json(['message' => 'Status pembayaran dan pendaftaran diperbarui.'], 200);
    }
}
