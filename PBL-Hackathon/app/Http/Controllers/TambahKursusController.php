<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class TambahKursusController extends Controller
{
    public function tambahKursus()
{
    $kategori = Kategori::all();

    return view('pelatih/TambahKursus', [
        'kategori' => $kategori,
    ]);
}
}
