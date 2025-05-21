<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{

    public function profil()
    {
        // Ganti 'beranda.trainee' dengan nama file view kamu
        return view('Traineev2.Profil');
    }
}
