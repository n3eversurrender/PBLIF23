<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus; // Import model Kursus
use Illuminate\Support\Facades\Auth; // Import facade Auth

class UlasanController extends Controller
{
    public function indexUlasan()
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Dapatkan ID pengguna yang sedang login
            $penggunaId = Auth::id(); // Asumsi Auth::id() mengembalikan primary key dari model Pengguna Anda (pengguna_id)

            // Ambil semua kursus yang dibuat oleh pengguna yang sedang login, dengan relasi ratingKursus
            // Pastikan relasi di model Kursus adalah 'ratingKursus' atau sesuaikan jika namanya 'ratingKursus'
            $kursus = Kursus::where('pengguna_id', $penggunaId)
                ->with('ratingKursus') // Menggunakan 'ratingKursus' sesuai konvensi nama relasi HasMany
                ->get();

            // Siapkan data untuk view
            $dataKursusUlasan = $kursus->map(function ($kursusItem) {
                // Pastikan $kursusItem->ratingKursus sudah ada sebelum diakses
                $jumlahUlasan = $kursusItem->ratingKursus ? $kursusItem->ratingKursus->count() : 0;
                $rataRataRating = $kursusItem->ratingKursus ? $kursusItem->ratingKursus->avg('rating') : 0;

                return [
                    'kursus_id' => $kursusItem->kursus_id,
                    'nama_kursus' => $kursusItem->judul,
                    'jumlah_ulasan' => $jumlahUlasan,
                    'rata_rata_rating' => round($rataRataRating, 1), // Bulatkan 1 desimal
                ];
            });

            return view('Perusahaan.Ulasan', compact('dataKursusUlasan'));
        } else {
            // Jika pengguna belum login, arahkan kembali ke halaman login atau tampilkan pesan error
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat ulasan kursus Anda.');
        }
    }

    public function detailUlasan($kursus_id)
    {
        // Cari kursus berdasarkan ID
        $kursus = Kursus::with('ratingKursus.pengguna') // Eager load ulasan dan pengguna yang memberi ulasan
            ->find($kursus_id);

        // Jika kursus tidak ditemukan, atau jika pengguna tidak memiliki kursus ini (jika Anda ingin membatasi akses)
        if (!$kursus) {
            abort(404, 'Kursus tidak ditemukan.');
        }

        // Opsional: Batasi akses hanya untuk pemilik kursus
        if (Auth::check() && $kursus->pengguna_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke detail ulasan kursus ini.');
        } elseif (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat detail ulasan.');
        }

        // Ambil semua ulasan untuk kursus ini
        $ulasan = $kursus->ratingKursus;

        return view('Perusahaan.DetailUlasan', compact('kursus', 'ulasan'));
    }
}
