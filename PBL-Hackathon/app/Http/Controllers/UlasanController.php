<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus; // Import model Kursus
use Illuminate\Support\Facades\Auth; // Import facade Auth
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Import facade Log untuk logging error\
use Illuminate\Pagination\LengthAwarePaginator;


class UlasanController extends Controller
{
    public function indexUlasan()
    {
        if (Auth::check()) {
            $penggunaId = Auth::id();

            // Ambil semua kursus dengan relasi
            $allKursus = Kursus::where('pengguna_id', $penggunaId)
                ->with('ratingKursus')
                ->get();

            // Proses data manual dengan map
            $mapped = $allKursus->map(function ($kursusItem) {
                $jumlahUlasan = $kursusItem->ratingKursus ? $kursusItem->ratingKursus->count() : 0;
                $rataRataRating = $kursusItem->ratingKursus ? $kursusItem->ratingKursus->avg('rating') : 0;

                return [
                    'kursus_id' => $kursusItem->kursus_id,
                    'nama_kursus' => $kursusItem->judul,
                    'jumlah_ulasan' => $jumlahUlasan,
                    'rata_rata_rating' => round($rataRataRating, 1),
                ];
            });

            // Manual pagination
            $perPage = 5;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentItems = $mapped->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $dataKursusUlasan = new LengthAwarePaginator(
                $currentItems,
                $mapped->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return view('Perusahaan.Ulasan', compact('dataKursusUlasan'));
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat ulasan kursus Anda.');
        }
    }


    public function detailUlasan($kursus_id)
    {
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

        $ulasan = $kursus->ratingKursus()->paginate(5); // Atur per halaman sesuai keinginan
        $total = $ulasan->count();
        $positif_count = $ulasan->where('pred_label', 'positif')->count();
        $negatif_count = $ulasan->where('pred_label', 'negatif')->count();
        $netral_count = $ulasan->where('pred_label', 'netral')->count();

        $distribusi = [
            'positif' => $total > 0 ? round(($positif_count / $total) * 100) : 0,
            'negatif' => $total > 0 ? round(($negatif_count / $total) * 100) : 0,
            'netral' => $total > 0 ? round(($netral_count / $total) * 100) : 0,
        ];

        // LOG DEBUG
        Log::info("Distribusi hitung", $distribusi);
        Log::info("Jumlah positif: $positif_count, negatif: $negatif_count, netral: $netral_count, total: $total");

        // Rekomendasi berdasar dominan
        if ($distribusi['positif'] > $distribusi['negatif'] && $distribusi['positif'] > $distribusi['netral']) {
            $rekomendasi = '✅ Layanan sangat baik, pertahankan kualitas!';
        } elseif ($distribusi['negatif'] > $distribusi['positif'] && $distribusi['negatif'] > $distribusi['netral']) {
            $rekomendasi = '🚨 Banyak komentar negatif, segera evaluasi layanan.';
        } elseif ($distribusi['netral'] > $distribusi['positif'] && $distribusi['netral'] > $distribusi['negatif']) {
            $rekomendasi = '⚠ Banyak komentar netral, pertimbangkan untuk meningkatkan daya tarik layanan.';
        } else {
            $rekomendasi = 'ℹ Layanan stabil. Lanjutkan monitoring rutin.';
        }

        return view('Perusahaan.DetailUlasan', compact(
            'kursus',
            'ulasan',
            'distribusi',
            'positif_count',
            'negatif_count',
            'netral_count',
            'total',
            'rekomendasi'
        ));
    }
}
