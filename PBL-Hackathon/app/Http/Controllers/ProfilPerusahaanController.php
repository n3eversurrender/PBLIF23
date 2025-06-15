<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use App\Models\Perusahaan;

use Illuminate\Http\Request;

class ProfilPerusahaanController extends Controller
{
    public function profilPerusahaan()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Pastikan hanya untuk user perusahaan
        if ($user->peran !== 'Perusahaan') {
            abort(403, 'Akses hanya untuk perusahaan');
        }

        // Ambil data perusahaan dari relasi
        $perusahaan = $user->perusahaan;

        return view('Perusahaan.Profil', compact('user', 'perusahaan'));
    }


    public function editProfilPerusahaan()
    {
        return view('Perusahaan.EditProfil');
    }
}
