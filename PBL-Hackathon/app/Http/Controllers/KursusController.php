<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function Kursus()
    {
        $id = Auth::id(); // Ambil ID pengguna yang sedang login

        // Ambil pendaftaran yang terkait dengan pengguna yang sedang login dengan status 'Aktif'
        $pendaftaran = Pendaftaran::with(['kursus']) // Muat relasi kursus
            ->where('pengguna_id', $id) // Filter berdasarkan peserta yang login
            ->where('status_pendaftaran', 'Aktif') // Filter hanya pendaftaran dengan status 'Aktif'
            ->where('status_pembayaran', 'Berhasil') // Filter hanya pembayaran yang berhasil
            ->paginate(10); // Paginate dengan ukuran 10 per halaman

        return view('peserta.Kursus', [
            'pendaftaran' => $pendaftaran,
        ]);
    }


    public function kursusModul($id_kursus)
    {
        // Ambil kursus berdasarkan id_kursus dan muat relasi kurikulum
        $kursus = Kursus::with('kurikulum')->findOrFail($id_kursus);

        // Kirim data kursus dan kurikulum ke view
        return view('peserta.KursusModul', [
            'kursus' => $kursus,
            'kurikulum' => $kursus->kurikulum // Mengirimkan kurikulum ke view
        ]);
    }



    public function kursusMateri()
    {
        return view('peserta/KursusMateri', []);
    }
}
