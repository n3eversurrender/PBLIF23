<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class DashboardPesertaController extends Controller
{
    public function dashboardPeserta()
    {
        $id = Auth::id(); // Ambil ID pengguna yang sedang login

        // Ambil semua pendaftaran terkait pengguna yang sedang login
        $pendaftaran = Pendaftaran::where('pengguna_id', $id)->get();

        // Hitung total pendaftaran
        $totalPendaftaran = $pendaftaran->count();

        // Hitung jumlah berdasarkan status_pendaftaran
        $statusPendaftaranCounts = [
            'Menunggu' => $pendaftaran->where('status_pendaftaran', 'Menunggu')->count(),
            'Aktif' => $pendaftaran->where('status_pendaftaran', 'Aktif')->count(),
            'Selesai' => $pendaftaran->where('status_pendaftaran', 'Selesai')->count(),
            'Dibatalkan' => $pendaftaran->where('status_pendaftaran', 'Dibatalkan')->count(),
        ];

        // Hitung jumlah berdasarkan status_pembayaran
        $statusPembayaranCounts = [
            'Pending' => $pendaftaran->where('status_pembayaran', 'Pending')->count(),
            'Berhasil' => $pendaftaran->where('status_pembayaran', 'Berhasil')->count(),
            'Gagal' => $pendaftaran->where('status_pembayaran', 'Gagal')->count(),
        ];

        return view('peserta/DashboardPeserta', [
            'pendaftaran' => $pendaftaran, 
            'totalPendaftaran' => $totalPendaftaran,
            'statusPendaftaranCounts' => $statusPendaftaranCounts,
            'statusPembayaranCounts' => $statusPembayaranCounts,
        ]);
    }
}
