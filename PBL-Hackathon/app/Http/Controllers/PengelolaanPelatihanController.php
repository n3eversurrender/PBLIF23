<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Pendaftaran;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class PengelolaanPelatihanController extends Controller
{
    public function pengelolaanPelatihan()
    {
        $id = Auth::id(); // Ambil ID pengguna yang sedang login

        // Ambil data kursus yang hanya terkait dengan pengguna yang sedang login
        $kursus = Kursus::where('pengguna_id', $id)
            ->paginate(10); // Sesuaikan jumlah per halaman jika diperlukan

        return view('pelatih.PengelolaanPelatihan', [
            'kursus' => $kursus,
        ]);
    }

    public function pengelolaanPelatihanDetail($kursus_id)
    {
        $id = Auth::id(); // Ambil ID pengguna yang sedang login

        // Pastikan kursus yang diminta terkait dengan pelatih yang sedang login
        $kursus = Kursus::where('kursus_id', $kursus_id)
            ->where('pengguna_id', $id)
            ->first();

        if (!$kursus) {
            // Redirect jika kursus tidak ditemukan atau bukan milik pelatih
            return redirect()->route('pelatih.PengelolaanPelatihan')->withErrors('Kursus tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Ambil pengguna yang mendaftar untuk kursus tertentu
        $pengguna = Pengguna::whereHas('pendaftaran', function ($query) use ($kursus_id) {
            $query->where('kursus_id', $kursus_id);
        })->get();

        // Ambil data pendaftaran dengan paginasi
        $pendaftaran = Pendaftaran::where('kursus_id', $kursus_id)
            ->whereIn('pengguna_id', $pengguna->pluck('pengguna_id'))
            ->paginate(10); // Sesuaikan jumlah per halaman jika diperlukan

        return view('pelatih.PengelolaanPelatihanDetail', compact('kursus', 'pengguna', 'pendaftaran'));
    }

    public function destroy($pendaftaran_id)
    {
        // Temukan data pendaftaran berdasarkan pendaftaran_id
        $pendaftaran = Pendaftaran::find($pendaftaran_id);

        // Jika data ditemukan, hapus
        if ($pendaftaran) {
            $pendaftaran->delete();
        }

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Pendaftaran berhasil dihapus.');
    }

    public function update(Request $request, $pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::find($pendaftaran_id);

        if (!$pendaftaran) {
            return back()->with('error', 'Pendaftaran tidak ditemukan.');
        }

        // Validasi dan update status pendaftaran
        $request->validate([
            'status_pendaftaran' => 'required|in:Aktif,Selesai,Dibatalkan',
        ]);

        $pendaftaran->status_pendaftaran = $request->status_pendaftaran;
        $pendaftaran->save();

        return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
