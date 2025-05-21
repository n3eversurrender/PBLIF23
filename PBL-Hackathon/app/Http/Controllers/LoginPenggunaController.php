<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginPenggunaController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|string|email', // Menambahkan validasi email
            'kata_sandi' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'kata_sandi.required' => 'Kata sandi wajib diisi.',
        ]);

        // Mencari pengguna berdasarkan email
        $pengguna = Pengguna::where('email', $validated['email'])->first();

        // Mengecek apakah pengguna ditemukan dan password cocok
        if (!$pengguna) {
            return back()->withErrors([
                'login_error' => 'Email tidak ditemukan, silahkan masukkan email dengan benar!',
            ]);
        }

        if (!Hash::check($validated['kata_sandi'], $pengguna->kata_sandi)) {
            return back()->withErrors([
                'login_error' => 'Kata sandi salah, silahkan masukkan kata sandi dengan benar!',
            ]);
        }

        // Login berhasil
        Auth::login($pengguna);

        // Arahkan ke dashboard sesuai peran
        switch ($pengguna->peran) {
            case 'Pelatih':
                return redirect()->route('DashboardPelatih');
            case 'Peserta':
                return redirect()->route('DashboardPeserta');
            case 'Admin':
                return redirect()->route('dashboard');
            case 'Superadmin':
                return redirect()->route('dashboard');
            default:
                return redirect()->route('login'); // Rute fallback jika peran tidak dikenal
        }
    }

    public function logoutPeserta()
    {
        Auth::logout();
        return redirect('/Masuk')->with('success', 'Logout berhasil!');
    }

    public function logoutPelatih()
    {
        Auth::logout();
        return redirect('/Masuk')->with('success', 'Logout berhasil!');
    }

    public function logoutAdmin()
    {
        Auth::logout();
        return redirect('/Masuk');
    }


}
