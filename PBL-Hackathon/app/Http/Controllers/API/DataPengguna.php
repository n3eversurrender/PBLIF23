<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPengguna extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        $pengguna = Pengguna::all();
        return response()->json($pengguna);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|string',
            'peran' => 'required|string',
            'kata_sandi' => 'required|string|min:8',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto profil
        ]);

        // Mengecek apakah email sudah ada di database
        $existingUser = Pengguna::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(['error' => 'Email sudah terdaftar'], 400);
        }

        // Mengenskripsi kata sandi
        $request['kata_sandi'] = Hash::make($request['kata_sandi']);

        // Menyimpan foto profil jika diunggah
        if ($request->hasFile('foto_profil')) {
            $fotoProfilPath = $request->file('foto_profil')->store('foto_profil', 'public'); // Simpan di direktori public/foto_profil
            $request['foto_profil'] = $fotoProfilPath; // Tambahkan path ke data yang akan disimpan
        }

        // Menyimpan pengguna baru
        $pengguna = Pengguna::create($request->only(['nama', 'email', 'no_telepon', 'alamat', 'jenis_kelamin', 'peran', 'kata_sandi', 'foto_profil']));

        // Mengembalikan response JSON jika berhasil
        return response()->json($pengguna, 201);
    }


    // Menampilkan pengguna berdasarkan ID
    public function show($id)
    {
        $pengguna = Pengguna::find($id);

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        return response()->json($pengguna, 200);
    }

    // Mengupdate pengguna berdasarkan ID
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::find($id);

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:pengguna,email,' . $id,
            'no_telepon' => 'sometimes|required|string|max:15',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'sometimes|required|string',
            'kata_sandi' => 'sometimes|required|string|min:8',
            'foto_profil' => 'nullable|string',
            'peran' => 'sometimes|required|string',
        ]);

        $pengguna->update($request->all());

        return response()->json($pengguna, 200);
    }

    // Menghapus pengguna berdasarkan ID
    public function destroy($id)
    {
        $pengguna = Pengguna::find($id);

        if (!$pengguna) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        $pengguna->delete();
        return response()->json(['message' => 'Pengguna berhasil dihapus'], 200);
    }
}
