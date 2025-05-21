<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataKategoriController extends Controller
{
    public function dataKategori()
    {
        // Ambil data kursus dengan pagination 10 data per halaman
        $kategoriList = Kategori::paginate(10);

        // Kirim data ke view
        return view('Admin.DataKategori', [
            'kategoriList' => $kategoriList,
        ]);
    }

    public function tambahKategori()
    {
        return view('Admin.TambahKategori', []);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $validated['nama_kategori'],
        ]);

        return redirect()->route('DataKategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori: ' . $e->getMessage());
        }
    }
}
