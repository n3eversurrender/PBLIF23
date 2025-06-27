<?php

namespace App\Http\Controllers;

use App\Models\FotoPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // ✅ Tambahkan ini


class GaleriController extends Controller
{
    public function kelolaGaleri($id)
    {
        // Ambil data galeri berdasarkan perusahaan_id
        $galeri = FotoPerusahaan::where('perusahaan_id', $id)->get();

        return view('perusahaan.KelolaGaleri', compact('galeri'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = auth()->user();
        $perusahaan = $user->perusahaan()->first();

        if (!$perusahaan) {
            return back()->with('error', 'Data perusahaan tidak ditemukan.');
        }

        // Simpan file ke folder 'foto_perusahaan' di public storage
        $filePath = $request->file('file_path')->store('foto_perusahaan', 'public');

        FotoPerusahaan::create([
            'perusahaan_id' => $perusahaan->perusahaan_id,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function update(Request $request, $id)
    {
        $galeri = FotoPerusahaan::findOrFail($id);

        if ($request->hasFile('file_path')) {
            // Hapus file lama
            Storage::disk('public')->delete($galeri->file_path);

            // Simpan file baru
            $filePath = $request->file('file_path')->store('foto_perusahaan', 'public');
            $galeri->file_path = $filePath;
        }

        $galeri->save();

        return redirect()->back()->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = FotoPerusahaan::findOrFail($id);

        // Hapus file fisik
        Storage::disk('public')->delete($galeri->file_path);

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}
