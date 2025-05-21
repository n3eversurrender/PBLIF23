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
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'no_telepon.digits_between' => 'Nomor telepon harus antara 10 hingga 15 digit.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'peran.required' => 'Peran wajib dipilih.',
            'peran.in' => 'Peran tidak valid.',

            'kata_sandi.required' => 'Kata sandi wajib diisi.',
            'kata_sandi.string' => 'Kata sandi harus berupa teks.',
            'kata_sandi.min' => 'Kata sandi minimal 8 karakter.',
            'kata_sandi.regex' => 'Kata sandi harus mengandung huruf besar, huruf kecil, dan angka.',
            'kata_sandi.confirmed' => 'Konfirmasi Kata sandi tidak cocok.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'no_telepon' => 'required|digits_between:10,15',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'peran' => 'required|in:Peserta,Pelatih',
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

        // Ambil status dari form
        $status = $request->status;

        // Simpan data pengguna
        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'peran' => $request->peran,
            'status' => $status, // Gunakan status yang dikirimkan dari form
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
