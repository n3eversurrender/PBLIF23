<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus; // Import model Kursus
use Illuminate\Support\Facades\Auth; // Import facade Auth
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Import facade Log untuk logging error

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
        // Cari kursus + relasi ratingKursus + pengguna pemberi ulasan
        $kursus = Kursus::with('ratingKursus.pengguna')->find($kursus_id);

        if (!$kursus) {
            abort(404, 'Kursus tidak ditemukan.');
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat detail ulasan.');
        }

        if ($kursus->pengguna_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke detail ulasan kursus ini.');
        }

        $ulasan = $kursus->ratingKursus;

        // Tidak memanggil Flask / DSS dulu
        return view('Perusahaan.DetailUlasan', compact('kursus', 'ulasan'));
    }

    public function analisaDSS($kursus_id)
    {
        $kursus = Kursus::with('ratingKursus')->find($kursus_id);
        if (!$kursus) {
            return response()->json(['error' => 'Kursus tidak ditemukan.'], 404);
        }

        $ulasan = $kursus->ratingKursus;
        $komentar = $ulasan->pluck('komentar')->filter(fn($val) => !empty(trim($val)))->toArray();

        if (count($komentar) === 0) {
            return response()->json([
                'distribusi' => [],
                'rekomendasi' => 'Tidak ada komentar untuk dianalisis.',
                'batas_aman' => null,
                'pred_negatif' => null,
                'historis' => []
            ]);
        }

        try {
            $response = Http::timeout(10)->post('http://127.0.0.1:9999/predict-ulasan', [
                'komentar' => $komentar
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                Log::warning("Flask API error: " . $response->status());
                return response()->json(['error' => 'Analisa gagal, coba lagi.'], 500);
            }
        } catch (\Exception $e) {
            Log::error("Flask API call failed: " . $e->getMessage());
            return response()->json(['error' => 'Gagal memanggil analisa.'], 500);
        }
    }
}
