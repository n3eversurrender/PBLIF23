<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginPenggunaController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|string|email',
            'kata_sandi' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'kata_sandi.required' => 'Kata sandi wajib diisi.',
        ]);

        // Cari pengguna
        $pengguna = Pengguna::where('email', $validated['email'])->first();

        if (!$pengguna) {
            return back()->withErrors(['login_error' => 'Email tidak ditemukan.']);
        }

        if (!Hash::check($validated['kata_sandi'], $pengguna->kata_sandi)) {
            return back()->withErrors(['login_error' => 'Kata sandi salah.']);
        }

        // Login berhasil
        Auth::login($pengguna);

        return $this->redirectByRole($pengguna);
    }

    public function handleLoginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleLoginGoogleCalback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = Pengguna::where('email', $googleUser->email)->first();

        if (!$user) {
            $user = Pengguna::create([
                'nama' => $googleUser->name,
                'email' => $googleUser->email,
                'no_telepon' => '-',
                'alamat' => '-',
                'jenis_kelamin' => null,
                'peran' => 'Peserta',
                'status' => 'Aktif',
                'kata_sandi' => Hash::make(rand(100000, 999999)),
            ]);
        }

        Auth::login($user);

        return $this->redirectByRole($user);
    }

    private function redirectByRole($pengguna)
    {
        switch ($pengguna->peran) {
            case 'Perusahaan':
                return redirect()->route('StatistikPerusahaan')->with('success', 'Login berhasil!');
            case 'Admin':
            case 'Superadmin':
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            case 'Peserta':
                $peserta = Peserta::where('pengguna_id', $pengguna->pengguna_id)->first();

                // Cek kelengkapan data
                if ($peserta && $peserta->minat_bidang && $peserta->bidang_saat_ini) {
                    return redirect()->route('BerandaTrainee')->with('success', 'Login berhasil!');
                } else {
                    return redirect()->route('SkillMatching')->with('success', 'Silakan lengkapi data pengalaman!');
                }

            default:
                return redirect()->route('login')->with('error', 'Login gagal! Peran tidak dikenali.');
        }
    }

    public function logoutPeserta()
    {
        Auth::logout();
        return redirect('/Home')->with('success', 'Logout berhasil!');
    }

    public function logoutPerusahaan()
    {
        Auth::logout();
        return redirect('/Home')->with('success', 'Logout berhasil!');
    }

    public function logoutAdmin()
    {
        Auth::logout();
        return redirect('/Home')->with('success', 'Logout berhasil!');
    }
}
