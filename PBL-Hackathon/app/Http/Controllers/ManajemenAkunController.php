<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Support\Facades\Validator;

class ManajemenAkunController extends Controller
{
    public function Daftar()
    {
        return view('guest/Daftar', []);
    }

    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silakan gunakan email lain.',

            'kata_sandi.required' => 'Kata sandi wajib diisi.',
            'kata_sandi.string' => 'Kata sandi harus berupa teks.',
            'kata_sandi.min' => 'Kata sandi minimal 8 karakter.',
            'kata_sandi.regex' => 'Kata sandi harus mengandung huruf besar, huruf kecil, dan angka.',
            'kata_sandi.confirmed' => 'Konfirmasi Kata sandi tidak cocok.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'kata_sandi' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
            ],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Gagal membuat akun. Periksa kembali data yang Anda masukkan.')
                ->withInput();
        }

        // Simpan data pengguna
        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'peran' => 'Peserta',
            'kata_sandi' => Hash::make($request->kata_sandi),
        ]);

        // Redirect ke halaman login setelah berhasil
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function Masuk()
    {
        return view('guest/Masuk', []);
    }
}
