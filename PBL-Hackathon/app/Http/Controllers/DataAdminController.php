<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class DataAdminController extends Controller
{
    public function dataAdmin()
    {
        // Ambil semua data dari tabel admin
        $admins = Pengguna::where('peran', 'Admin')->paginate(10);

        // Kirim data ke view
        return view('Admin/DataAdmin', [
            'admins' => $admins,
        ]);
    }

    public function tambahAdmin()
    {
        return view('admin/TambahAdmin', []);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna', // Ubah ke 'pengguna'
            'no_telepon' => 'required|numeric',
            'kata_sandi' => 'required|min:8',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'kata_sandi' => bcrypt($request->kata_sandi),
            'peran' => 'Admin', // Posisi ditetapkan langsung di sini
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $admin = Pengguna::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kata_sandi' => 'nullable|string|min:8',
        ]);

        $admin->nama = $request->nama;

        if ($request->filled('kata_sandi')) {
            $admin->kata_sandi = bcrypt($request->kata_sandi);
        }

        $admin->save();

        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('admin.index')->with('success', 'Informasi admin berhasil diperbarui!');
    }
}
