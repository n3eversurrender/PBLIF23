<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function indexUlasan()
    {
        return view('Perusahaan.Ulasan');
    }

    public function detailUlasan()
    {
        return view('Perusahaan.DetailUlasan');
    }
}
