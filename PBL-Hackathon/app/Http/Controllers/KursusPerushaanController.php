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
            // Asumsi Auth::id() mengembalikan primary key dari model Pengguna Anda.
            // Jika primary key tabel 'pengguna' adalah 'pengguna_id' dan Anda menggunakan fitur autentikasi default Laravel,
            // maka Auth::id() sudah sesuai. Jika tidak, Anda mungkin perlu Auth::user()->pengguna_id.
            $penggunaId = Auth::id();

            // Ambil data kursus yang dimiliki oleh pengguna yang sedang login
            // Lakukan eager loading relasi 'kategori' dan 'pendaftaran'
            $kursus = Kursus::where('pengguna_id', $penggunaId)
                ->with('kategori', 'pendaftaran') // Eager load relasi kategori dan pendaftaran
                ->get();

            // Kirim data kursus ke view
            return view('Perusahaan.Kursus', compact('kursus'));
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
}
