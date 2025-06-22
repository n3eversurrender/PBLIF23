<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Pengguna;
use App\Models\Perusahaan;
use App\Models\RatingPerusahaan;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function detailProfilPerusahaan($id)
    {
        $perusahaan = Perusahaan::with('pengguna')
            ->withAvg('ratingPerusahaan as average_rating', 'rating')
            ->withCount('ratingPerusahaan')
            ->where('pengguna_id', $id)
            ->first();

        if (!$perusahaan) {
            return view('guest.DetailProfilPerusahaanKosong');
        }

        $user = $perusahaan->pengguna;

        $kursus = Kursus::with('pengguna')
            ->withAvg('ratingKursus as average_rating', 'rating')
            ->withCount('ratingKursus')
            ->where('status', 'Aktif')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $ratingPerusahaan = RatingPerusahaan::with('pemberi')
            ->where('perusahaan_id', $perusahaan->perusahaan_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $hasReviewed = false;
        if (auth()->check()) {
            $hasReviewed = RatingPerusahaan::where('perusahaan_id', $perusahaan->perusahaan_id)
                ->where('pemberi_id', auth()->id())
                ->exists();
        } else {
            $hasReviewed = RatingPerusahaan::where('perusahaan_id', $perusahaan->perusahaan_id)
                ->where('ip_address', request()->ip())
                ->exists();
        }

        // ✅ Tambahkan ambil galeri dengan pagination
        $galeri = $perusahaan->fotoPerusahaan()->paginate(4);

        return view('guest.DetailProfilPerusahaan', compact('perusahaan', 'user', 'kursus', 'ratingPerusahaan', 'hasReviewed', 'galeri'));
    }


    public function store(Request $request, $perusahaanId)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        $userId = auth()->id();
        $ip = $request->ip();

        // Cek apakah sudah review sebelumnya
        $sudahReview = RatingPerusahaan::where('perusahaan_id', $perusahaanId)
            ->where(function ($query) use ($userId, $ip) {
                if ($userId) {
                    $query->where('pemberi_id', $userId);
                } else {
                    $query->where('ip_address', $ip);
                }
            })
            ->exists();

        if ($sudahReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk perusahaan ini.');
        }

        // Simpan review
        RatingPerusahaan::create([
            'perusahaan_id' => $perusahaanId,
            'pemberi_id' => $userId, // null kalau guest
            'ip_address' => $userId ? null : $ip, // isi IP kalau guest
            'rating' => $request->rating,
            'komentar' => $request->review,
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
