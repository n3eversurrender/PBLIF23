<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\RatingKursus;
use Illuminate\Support\Facades\Log;



class DetailRiwayatController extends Controller
{
    public function detailRiwayat($id)
    {
        $pendaftaran = Pendaftaran::with('kursus.ratingKursus')->findOrFail($id);

        $originalAverage = $pendaftaran->kursus->ratingKursus->avg('rating');
        $totalReview = $pendaftaran->kursus->ratingKursus->count();

        $averageRating = $originalAverage ? round(($originalAverage / 10) * 5, 1) : 0;

        // Cek apakah user sudah memberi ulasan untuk kursus ini
        $userHasReviewed = RatingKursus::where('kursus_id', $pendaftaran->kursus_id)
            ->where('pengguna_id', Auth::id())
            ->exists();

        return view('Traineev2.DetailRiwayat', compact('pendaftaran', 'averageRating', 'totalReview', 'userHasReviewed'));
    }

    public function submitUlasan(Request $request, $id)
    {
        // Cek data dikirim atau tidak
        Log::info('Form ulasan dikirim', [
            'pendaftaran_id' => $id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        // ATAU untuk debug sementara:
        // dd($request->all());

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        $pendaftaran = \App\Models\Pendaftaran::findOrFail($id);

        // Simpan ulasan
        RatingKursus::create([
            'kursus_id' => $pendaftaran->kursus_id,
            'pengguna_id' => Auth::id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }
}
