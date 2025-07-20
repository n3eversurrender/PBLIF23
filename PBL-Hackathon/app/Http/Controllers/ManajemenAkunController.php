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

    public function apiMasuk(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'kata_sandi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Cari pengguna berdasarkan email
        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email tidak ditemukan',
            ], 404);
        }

        // Cek password
        if (!Hash::check($request->kata_sandi, $user->kata_sandi)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kata sandi salah',
            ], 401);
        }

        // Jika berhasil, bisa return data user atau token
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => [
                'user_id' => $user->pengguna_id,
                'nama' => $user->nama,
                'email' => $user->email,
                'peran' => $user->peran,
                // kalau pakai token (misal JWT) bisa ditambahkan di sini
            ],
        ]);
    }
}
