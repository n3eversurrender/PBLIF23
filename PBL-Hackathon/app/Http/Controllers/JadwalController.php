<?php

namespace App\Http\Controllers;

use App\Models\JadwalKursus;
use App\Models\Kursus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class JadwalController extends Controller
{
    // Method untuk menampilkan jadwal
    public function indexJadwal()
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Dapatkan ID pengguna yang sedang login
            $penggunaId = Auth::id();

            // Ambil data kursus yang dimiliki oleh pengguna yang sedang login
            $kursus = Kursus::where('pengguna_id', $penggunaId)
                ->withCount('jadwalKursus') // optional biar efisien
                ->orderBy('created_at', 'desc')
                ->paginate(10);


            // Jika tidak ada kursus yang ditemukan, redirect dengan pesan
            if ($kursus->isEmpty()) {
                return redirect()->route('KursusPerusahaan')->with('error', 'Anda belum memiliki kursus.');
            }

            // Ambil data jadwal yang terkait dengan kursus milik pengguna
            $jadwal = JadwalKursus::whereIn('kursus_id', $kursus->pluck('kursus_id'))->get();

            // Kirim data kursus dan jadwal ke view
            return view('Perusahaan.Jadwal', compact('kursus', 'jadwal'));
        } else {
            // Jika pengguna belum login, arahkan kembali ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    }

    public function kelolaJadwal($kursus_id)
    {
        // Cek apakah kursus yang diminta milik pengguna yang sedang login
        $kursus = Kursus::where('kursus_id', $kursus_id)
            ->where('pengguna_id', Auth::id()) // Pastikan kursus milik pengguna yang login
            ->firstOrFail();

        // Ambil data jadwal untuk kursus ini
        $jadwal = JadwalKursus::where('kursus_id', $kursus_id)->paginate(10);
        // Kirim data kursus dan jadwal ke view
        return view('Perusahaan.KelolaJadwal', compact('kursus', 'jadwal'));
    }

    public function simpanJadwal(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kursus_id' => 'required|exists:kursus,kursus_id',
            'sesi' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'lokasi' => 'required|string|max:255',
        ]);

        // Simpan jadwal
        JadwalKursus::create($validated);

        // Redirect ke halaman kelola jadwal kursus
        return redirect()->route('KelolaJadwal', ['kursus_id' => $validated['kursus_id']])
            ->with('success', 'Jadwal berhasil ditambahkan');
    }


    public function updateJadwal(Request $request, $jadwal_id)
    {
        $validated = $request->validate([
            'sesi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|string|max:8', // Karena sudah string
            'jam_selesai' => 'required|string|max:8',
            'lokasi' => 'required|string|max:255',
        ]);

        $jadwal = JadwalKursus::findOrFail($jadwal_id);

        $jadwal->update([
            'sesi' => $validated['sesi'],
            'tanggal' => $validated['tanggal'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'lokasi' => $validated['lokasi'],
        ]);

        return redirect()->route('KelolaJadwal', ['kursus_id' => $jadwal->kursus_id])
            ->with('success', 'Jadwal berhasil diperbarui.');
    }


    public function hapusJadwal($jadwal_id)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = JadwalKursus::findOrFail($jadwal_id);

        // Hapus jadwal
        $jadwal->delete();

        // Redirect ke halaman kelola jadwal
        return redirect()->route('KelolaJadwal', ['kursus_id' => $jadwal->kursus_id])->with('success', 'Jadwal berhasil dihapus.');
    }


    public function tambahJadwal()
    {
        return view('Perusahaan.TambahJadwal');
    }
}
