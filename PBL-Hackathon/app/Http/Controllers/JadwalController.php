<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function indexJadwal()
    {
        return view('Perusahaan.Jadwal');
    }

    public function kelolaJadwal()
    {
        return view('Perusahaan.KelolaJadwal');
    }

    public function tambahJadwal()
    {
        return view('Perusahaan.TambahJadwal');
    }
}
