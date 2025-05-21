<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Sertifikat;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DaftarPelatihanController extends Controller
{
    public function daftarPelatihan()
    {
        $id = Auth::id(); // Ambil ID pengguna yang sedang login

        // Ambil pendaftaran yang terkait dengan pengguna yang sedang login
        $pendaftaran = Pendaftaran::with(['kursus.pengguna.peserta']) // Memuat relasi kursus dan pengguna (pelatih)
            ->where('pengguna_id', $id) // Filter berdasarkan peserta yang login
            ->paginate(10); // Paginate dengan ukuran 10 per halaman

        return view('peserta.DaftarPelatihan', [
            'pendaftaran' => $pendaftaran,
        ]);
    }

    public function downloadSertifikat($pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
    
        $sertifikat = Sertifikat::where('kursus_id', $pendaftaran->kursus_id)
            ->where('pendaftaran_id', $pendaftaran->pendaftaran_id)
            ->first();
    
        if (!$sertifikat) {
            dd("Sertifikat Tidak Ditemukan");
        }
    
        if (!$sertifikat->file_sertifikat) {
            dd("File path di database kosong");
        }
    
        $filePath = Storage::disk('public')->path($sertifikat->file_sertifikat);
    
        if (!Storage::disk('public')->exists($sertifikat->file_sertifikat)) {
            dd("File tidak ada: " . $filePath);
        }
    
        return response()->download($filePath);
    }
    

    public function destroy($pendaftaran_id)
    {
        // Temukan pendaftaran berdasarkan pendaftaran_id dan hapus
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
        $pendaftaran->delete();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
