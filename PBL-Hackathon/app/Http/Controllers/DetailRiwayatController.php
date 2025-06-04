<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class DetailRiwayatController extends Controller
{
    public function detailRiwayat($id)
    {
        $pendaftaran = Pendaftaran::with('kursus.ratingKursus')->findOrFail($id);

        // Hitung rata-rata rating dan jumlah ulasan
        $averageRating = $pendaftaran->kursus->ratingKursus->avg('rating');
        $totalReview = $pendaftaran->kursus->ratingKursus->count();

        return view('Traineev2.DetailRiwayat', compact('pendaftaran', 'averageRating', 'totalReview'));
    }
}
