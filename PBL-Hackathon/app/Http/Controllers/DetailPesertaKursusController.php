<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailPesertaKursusController extends Controller
{
    public function detailPesertaKursus()
    {
        return view('Admin/DetailPesertaKursus', [
        ]);
    }
}
