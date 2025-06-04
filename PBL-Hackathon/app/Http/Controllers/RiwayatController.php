<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;


class RiwayatController extends Controller
{
    public function riwayat()
    {
        $user = Auth::user();

        // Ambil semua pendaftaran yang terkait dengan user
        $riwayat = Pendaftaran::with('kursus')
            ->where('pengguna_id', $user->pengguna_id)
            ->get();

        return view('Traineev2.Riwayat', compact('riwayat', 'user'));
    }
}
