<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class DataRiwayatTransaksiController extends Controller
{
    public function dataRiwayatTransaksi()
    {
        // Ambil data pembayaran dari database
        $pembayaranList = Pembayaran::paginate(10);

        // Kirim data ke view
        return view('Admin.DataRiwayatTransaksi', [
            'pembayaranList' => $pembayaranList,
        ]);
    }

    public function destroy($id)
    {
        // Cari data pembayaran berdasarkan ID
        $pembayaran = Pembayaran::findOrFail($id);

        // Hapus data pembayaran
        $pembayaran->delete();

        // Redirect kembali ke halaman riwayat transaksi dengan pesan sukses
        return redirect()->route('dataRiwayatTransaksi')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
