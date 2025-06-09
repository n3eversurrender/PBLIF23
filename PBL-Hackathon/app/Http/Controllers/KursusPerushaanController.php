<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KursusPerushaanController extends Controller
{
    public function indexKursus()
    {
        return view('Perusahaan.Kursus');
    }
    public function tambahKursus()
    {
        return view('Perusahaan.TambahKursus');
    }
    public function detailKursus()
    {
        return view('Perusahaan.DetailKursus');
    }
}
