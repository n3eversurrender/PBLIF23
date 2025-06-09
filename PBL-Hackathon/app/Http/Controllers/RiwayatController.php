<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\RatingKursus;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $user = Auth::user();

        // Ambil semua pendaftaran yang terkait dengan user
        $riwayat = Pendaftaran::with('kursus')
            ->where('pengguna_id', $user->pengguna_id)
            ->get();

        // Tambahkan info apakah sudah memberi ulasan
        foreach ($riwayat as $item) {
            $hasReview = RatingKursus::where('kursus_id', $item->kursus_id)
                ->where('pengguna_id', $user->pengguna_id)
                ->exists();
            $item->has_reviewed = $hasReview;
        }

        return view('Traineev2.Riwayat', compact('riwayat', 'user'));
    }
}
