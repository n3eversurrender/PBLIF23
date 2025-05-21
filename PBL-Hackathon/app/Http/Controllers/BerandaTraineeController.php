<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaTraineeController extends Controller
{
     public function berandaTrainee()
    {
        // Ganti 'beranda.trainee' dengan nama file view kamu
        return view('Traineev2.BerandaTrainee');
    }
}
