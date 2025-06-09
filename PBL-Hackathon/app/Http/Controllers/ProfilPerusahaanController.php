<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilPerusahaanController extends Controller
{
    public function profilPerusahaan()
    {
        return view('Perusahaan.Profil');
    }

    public function editProfilPerusahaan()
    {
        return view('Perusahaan.EditProfil');
    }
}
