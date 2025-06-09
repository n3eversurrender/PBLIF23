<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function statistikPerusahaan()
    {
        return view('Perusahaan.Statistik');
    }

     public function berandaPerusahaan()
    {
        return view('Perusahaan.BerandaPerusahaan');
    }
}
