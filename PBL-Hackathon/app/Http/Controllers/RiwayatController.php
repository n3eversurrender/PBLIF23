<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
     public function riwayat()
    {
        // Ganti 'beranda.trainee' dengan nama file view kamu
        return view('Traineev2.Riwayat');
    }
}
