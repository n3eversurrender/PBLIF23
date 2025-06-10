<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna; // Pastikan model Pengguna diimpor jika diperlukan untuk Auth::user()

class KursusPerushaanController extends Controller
{
    public function indexKursus()
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Dapatkan ID pengguna yang sedang login
            // Asumsi Auth::id() mengembalikan primary key dari model Pengguna Anda.
            // Jika primary key tabel 'pengguna' adalah 'pengguna_id' dan Anda menggunakan fitur autentikasi default Laravel,
            // maka Auth::id() sudah sesuai. Jika tidak, Anda mungkin perlu Auth::user()->pengguna_id.
            $penggunaId = Auth::id();

            // Ambil data kursus yang dimiliki oleh pengguna yang sedang login
            // Lakukan eager loading relasi 'kategori' dan 'pendaftaran'
            $kursus = Kursus::where('pengguna_id', $penggunaId)
                ->with('kategori', 'pendaftaran') // Eager load relasi kategori dan pendaftaran
                ->get();

            // Kirim data kursus ke view
            return view('Perusahaan.Kursus', compact('kursus'));
        } else {
            // Jika pengguna belum login, arahkan kembali ke halaman login atau tampilkan pesan error
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat kursus Anda.');
        }
    }

    public function tambahKursus()
    {
        return view('Perusahaan.TambahKursus');
    }

    public function detailKursus()
    {
        return view('Perusahaan.DetailKursus');
    }
}
