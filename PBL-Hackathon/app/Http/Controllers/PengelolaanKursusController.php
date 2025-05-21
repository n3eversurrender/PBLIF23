<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PengelolaanKursusController extends Controller
{
    public function pengelolaanKursus()
    {
        $id = Auth::id();
        $kursus = Kursus::where('pengguna_id', $id)->paginate(10);

        $kategori = Kategori::all();

        return view('pelatih.PengelolaanKursus', [
            'kursus' => $kursus,
            'kategori' => $kategori,
        ]);
    }

    // Tambahkan fungsi penyimpanan untuk menambah kursus baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'tingkat_kesulitan' => 'required|in:Pemula,Menengah,Lanjutan',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'lokasi' => 'required|string',
            'kapasitas' => 'required|integer',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'foto_kursus' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'judul.required' => 'Judul Wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib diisi',
            'tgl_mulai.required' => 'Tanggal mulai wajib diisi',
            'tgl_selesai.required' => 'Tanggal selesai wajib diisi',
            'lokasi.required' => 'Lokasi wajib diisi',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kategori_id.required' => 'Kategori wajib disi',

            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'foto_kursus.image' => 'Format gambar tidak sesuai',
            'foto_kursus.mimes' => 'Format gambar tidak sesuai',
            'foto_kursus.max' => 'Foto kursus tidak boleh lebih dari 5MB',
        ]);


        $kursus = new Kursus();
        $kursus->judul = $validated['judul'];
        $kursus->deskripsi = $validated['deskripsi'];
        $kursus->harga = $validated['harga'];
        $kursus->tingkat_kesulitan = $validated['tingkat_kesulitan'];
        $kursus->lokasi = $validated['lokasi'];
        $kursus->tgl_mulai = $validated['tgl_mulai'];
        $kursus->tgl_selesai = $validated['tgl_selesai'];
        $kursus->kapasitas = $validated['kapasitas'];
        $kursus->kategori_id = $validated['kategori_id'];

        // Menambahkan pengguna_id (ID pengguna yang sedang login)
        $kursus->pengguna_id = Auth::id();  // Mengambil ID pengguna yang sedang login

        if ($request->hasFile('foto_kursus')) {
            $file = $request->file('foto_kursus');
            $path = $file->store('kursus_fotos', 'public');
            $kursus->foto_kursus = $path;
        }

        $kursus->save();

        return redirect()->route('PengelolaanKursus')->with('success', 'Kursus berhasil ditambahkan.');
    }


    public function update(Request $request, $kursus_id)
    {
        // Validasi data yang diperlukan saja
        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric',
            'tingkat_kesulitan' => 'nullable|string',
            'tgl_mulai' => 'nullable|date',
            'tgl_selesai' => 'nullable|date',
            'kapasitas' => 'nullable|integer',
            'kategori_id' => 'nullable|exists:kategori,kategori_id',
            'foto_kursus' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Validation for image
        ], [
            'judul.required' => 'Judul Wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib diisi',
            'tgl_mulai.required' => 'Tanggal mulai wajib diisi',
            'tgl_selesai.required' => 'Tanggal selesai wajib diisi',
            'lokasi.required' => 'Lokasi wajib diisi',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kategori_id.required' => 'Kategori wajib disi',

            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'foto_kursus.image' => 'Format gambar tidak sesuai',
            'foto_kursus.mimes' => 'Format gambar tidak sesuai',
            'foto_kursus.max' => 'Foto kursus tidak boleh lebih dari 5MB',
        ]);

        // Temukan kursus berdasarkan ID
        $kursus = Kursus::findOrFail($kursus_id);

        // Update hanya field yang ada di request
        if (isset($validated['judul'])) {
            $kursus->judul = $validated['judul'];
        }
        if (isset($validated['deskripsi'])) {
            $kursus->deskripsi = $validated['deskripsi'];
        }
        if (isset($validated['harga'])) {
            $kursus->harga = $validated['harga'];
        }
        if (isset($validated['tingkat_kesulitan'])) {
            $kursus->tingkat_kesulitan = $validated['tingkat_kesulitan'];
        }
        if (isset($validated['tgl_mulai'])) {
            $kursus->tgl_mulai = $validated['tgl_mulai'];
        }
        if (isset($validated['tgl_selesai'])) {
            $kursus->tgl_selesai = $validated['tgl_selesai'];
        }
        if (isset($validated['kapasitas'])) {
            $kursus->kapasitas = $validated['kapasitas'];
        }
        if (isset($validated['kategori_id'])) {
            $kursus->kategori_id = $validated['kategori_id'];
        }

        // Handle file upload for foto_kursus
        if ($request->hasFile('foto_kursus')) {
            // Hapus foto lama jika ada
            if ($kursus->foto_kursus) {
                Storage::delete('public/' . $kursus->foto_kursus);
            }
            // Simpan foto baru
            $file = $request->file('foto_kursus');
            $path = $file->store('kursus_fotos', 'public');
            $kursus->foto_kursus = $path;
        }

        // Simpan perubahan
        $kursus->save();

        return redirect()->route('PengelolaanKursus')->with('success', 'Kursus berhasil diperbarui.');
    }

    public function destroy($kursusId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $kursus->delete();

        return redirect()->back()->with('success', 'Pelatihan berhasil dihapus');
    }

    public function show($kursusId)
    {
        $kursus = Kursus::findOrFail($kursusId);

        return view('pelatih.ShowKursus', compact('kursus'));
    }
}
