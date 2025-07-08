<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Kursus;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna; // Pastikan model Pengguna diimpor jika diperlukan untuk Auth::user()
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class KursusPerushaanController extends Controller
{
    public function indexKursus()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $kursus = Kursus::where('pengguna_id', $user->pengguna_id)
                ->with('kategori', 'pendaftaran')
                ->orderBy('created_at', 'desc') // opsional untuk urutan
                ->paginate(10); // tampilkan 5 per halaman

            $kategori = Kategori::all();

            return view('Perusahaan.Kursus', compact('kursus', 'kategori', 'user'));
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat kursus Anda.');
        }
    }


    public function tambahKursus()
    {
        $kategori = Kategori::all();
        return view('Perusahaan.TambahKursus', compact('kategori'));
    }

    public function simpanKursus(Request $request)
    {
        Log::info('Masuk ke simpanKursus');

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tingkat_kesulitan' => 'required',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|integer',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'lokasi' => 'required|string',
            'foto_kursus' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'judul.required' => 'Nama wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib diisi',
            'kategori_id.required' => 'Kategori wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'tgl_mulai.required' => 'Tanggal mulai wajib diisi',
            'tgl_selesai.required' => 'Tanggal selesai wajib diisi',
            'lokasi.required' => 'Lokasi wajib diisi',
            'foto_kursus.image' => 'Format gambar tidak sesuai',
            'foto_kursus.mimes' => 'Format gambar tidak sesuai',
            'foto_kursus.max' => 'Foto kursus tidak boleh lebih dari 2MB',
        ]);

        Log::info('Validasi berhasil', $validated);

        $fotoPath = null;
        if ($request->hasFile('foto_kursus')) {
            $fotoPath = $request->file('foto_kursus')->store('kursus', 'public');
            Log::info('Foto disimpan di: ' . $fotoPath);
        }

        $kursus = Kursus::create([
            'pengguna_id' => auth()->user()->pengguna_id,
            'kategori_id' => $validated['kategori_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'lokasi' => $validated['lokasi'],
            'harga' => $validated['harga'],
            'tingkat_kesulitan' => $validated['tingkat_kesulitan'],
            'kapasitas' => $validated['kapasitas'],
            'tgl_mulai' => $validated['tgl_mulai'],
            'tgl_selesai' => $validated['tgl_selesai'],
            'status' => 'Aktif',
            'foto_kursus' => $fotoPath,
        ]);

        Log::info('Kursus berhasil disimpan: ', $kursus->toArray());

        return redirect()->route('KursusPerusahaan')->with('success', 'Kursus berhasil ditambahkan.');
        
    }

    public function detailKursus($id)
    {
        // Ambil kursus dengan relasi kategori, pengguna, pendaftaran, dan jadwal kursus
        $kursus = Kursus::with([
            'kategori',
            'pengguna',
            'pendaftaran.pengguna',
            'jadwalKursus'
        ])->find($id);

        if (!$kursus) {
            abort(404, 'Kursus tidak ditemukan.');
        }

        if (Auth::check() && $kursus->pengguna_id !== Auth::user()->pengguna_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke kursus ini.');
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('Perusahaan.DetailKursus', compact('kursus'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'harga' => 'required|numeric',
            'tingkat_kesulitan' => 'required',
            'kapasitas' => 'required|integer',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'foto_kursus' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'judul.required' => 'Nama wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib diisi',
            'kategori_id.required' => 'Kategori wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'tgl_mulai.required' => 'Tanggal mulai wajib diisi',
            'tgl_selesai.required' => 'Tanggal selesai wajib diisi',
            'lokasi.required' => 'Lokasi wajib diisi',
            'foto_kursus.image' => 'Format gambar tidak sesuai',
            'foto_kursus.mimes' => 'Format gambar tidak sesuai',
            'foto_kursus.max' => 'Foto kursus tidak boleh lebih dari 2MB',
        ]);

        // Cari kursus berdasarkan ID
        $kursus = Kursus::findOrFail($id);

        // Ambil semua kategori
        $kategori = Kategori::all();

        // Update kolom-kolom yang diinginkan (menghindari pengubahan pengguna_id, status, rating)
        $kursus->kategori_id = $validated['kategori_id'];
        $kursus->judul = $validated['judul'];
        $kursus->deskripsi = $validated['deskripsi'];
        $kursus->lokasi = $validated['lokasi'];
        $kursus->harga = $validated['harga'];
        $kursus->tingkat_kesulitan = $validated['tingkat_kesulitan'];
        $kursus->kapasitas = $validated['kapasitas'];
        $kursus->tgl_mulai = $validated['tgl_mulai'];
        $kursus->tgl_selesai = $validated['tgl_selesai'];

        // Jika ada foto kursus yang diupload, update foto
        if ($request->hasFile('foto_kursus')) {
            $fotoPath = $request->file('foto_kursus')->store('kursus', 'public');
            $kursus->foto_kursus = $fotoPath;
        }

        // Simpan perubahan
        $kursus->save();

        // Redirect ke halaman daftar kursus dengan pesan sukses
        return redirect()->route('KursusPerusahaan')->with('success', 'Kursus berhasil diperbarui');
    }


    public function hapusKursus($id)
    {
        // Cari kursus berdasarkan ID
        $kursus = Kursus::findOrFail($id);  // Mengambil kursus berdasarkan ID

        // Hapus kursus
        $kursus->delete();

        // Redirect ke halaman daftar kursus setelah berhasil dihapus
        return redirect()->route('KursusPerusahaan')->with('success', 'Kursus berhasil dihapus');
    }
}
