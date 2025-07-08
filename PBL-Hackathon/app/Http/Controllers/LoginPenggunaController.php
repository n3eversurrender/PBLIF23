<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
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
            case 'Perusahaan':
                return redirect()->route('StatistikPerusahaan')->with('success', 'Login berhasil!');
            case 'Peserta':
                return redirect()->route('SkillMatching')->with('success', 'Login berhasil!');
            case 'Admin':
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            case 'Superadmin':
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            default:
                return redirect()->route('login')->with('error', 'Login gagal!'); // Rute fallback jika peran tidak dikenal
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
        // Login berhasil
        Auth::login($user);
        

        // Arahkan ke dashboard sesuai peran
        switch ($user->peran) {
            case 'Perusahaan':
                return redirect()->route('StatistikPerusahaan')->with('success', 'Login berhasil!');
            case 'Peserta':
                return redirect()->route('SkillMatching')->with('success', 'Login berhasil!');
            case 'Admin':
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            case 'Superadmin':
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            default:
                return redirect()->route('login')->with('error', 'Login gagal!'); // Rute fallback jika peran tidak dikenal
        }
        
    }




}
