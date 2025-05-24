<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailRiwayatController extends Controller
{
     public function detailRiwayat()
    {
        // Ganti 'beranda.trainee' dengan nama file view kamu
        return view('Traineev2.DetailRiwayat');
    }
}
