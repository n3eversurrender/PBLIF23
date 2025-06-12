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
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Dapatkan ID pengguna yang sedang login
            $penggunaId = Auth::id();

            // Ambil data kursus yang dimiliki oleh pengguna yang sedang login
            $kursus = Kursus::where('pengguna_id', $penggunaId)
                ->with('kategori', 'pendaftaran') // Eager load relasi kategori dan pendaftaran
                ->get();

            // Ambil data kategori untuk digunakan di dropdown edit
            $kategori = Kategori::all();

            // Kirim data kursus dan kategori ke view
            return view('Perusahaan.Kursus', compact('kursus', 'kategori'));
        } else {
            // Jika pengguna belum login, arahkan kembali ke halaman login atau tampilkan pesan error
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
            'mentor' => 'nullable|string',
            'tingkat_kesulitan' => 'required',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'harga' => 'required|numeric',
            'kapasitas' => 'required|integer',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'lokasi' => 'required|string',
            'foto_kursus' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'status' => 'Tidak Aktif',
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
