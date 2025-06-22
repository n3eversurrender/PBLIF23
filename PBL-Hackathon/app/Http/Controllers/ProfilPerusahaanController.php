<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use App\Models\Perusahaan;

use Illuminate\Http\Request;

class ProfilPerusahaanController extends Controller
{
    public function profilPerusahaan()
    {
        $user = Auth::user();

        if ($user->peran !== 'Perusahaan') {
            abort(403, 'Akses hanya untuk perusahaan');
        }

        // Eager load perusahaan + foto_perusahaan
        $perusahaan = $user->perusahaan()->with('fotoPerusahaan')->first();

        // Kalau tidak ada perusahaan, galeri = collection kosong
        $galeri = $perusahaan ? $perusahaan->fotoPerusahaan()->paginate(4) : collect([]);

        return view('Perusahaan.Profil', compact('user', 'perusahaan', 'galeri'));
    }



    public function editProfilPerusahaan()
    {
        $user = auth()->user();
        $perusahaan = auth()->user()->perusahaan;
        // Jika kamu sudah set relasi di model
        return view('perusahaan.editProfil', compact('user', 'perusahaan'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user(); // User yang sedang login
        $perusahaan = $user->perusahaan; // Relasi perusahaan (pastikan ada relasinya di model)

        // Validasi sederhana (boleh kamu tambah)
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'layanan' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'npwp' => 'nullable|string',
            'akta_pendirian' => 'nullable|string',
            'izin_operasional' => 'nullable|string',
            'sertifikasi_bnsp' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_npwp' => 'nullable|mimes:pdf|max:2048',
            'file_akta_pendirian' => 'nullable|mimes:pdf|max:2048',
            'file_izin_operasional' => 'nullable|mimes:pdf|max:2048',
            'file_sertifikasi_bnsp' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Update user
        $user->nama = $request->nama;
        $user->no_telepon = $request->no_telepon;
        $user->alamat = $request->alamat;

        if ($request->hasFile('foto_profil')) {
            $fotoPath = $request->file('foto_profil')->store('foto_profil', 'public');
            $user->foto_profil = $fotoPath;
        }
        $user->save();

        // Update perusahaan
        $perusahaan->deskripsi = $request->deskripsi;
        $perusahaan->layanan = $request->layanan;
        $perusahaan->visi = $request->visi;
        $perusahaan->misi = $request->misi;
        $perusahaan->npwp = $request->npwp;
        $perusahaan->akta_pendirian = $request->akta_pendirian;
        $perusahaan->izin_operasional = $request->izin_operasional;
        $perusahaan->sertifikasi_bnsp = $request->sertifikasi_bnsp;

        if ($request->hasFile('file_npwp')) {
            $filePath = $request->file('file_npwp')->store('dokumen_legal', 'public');
            $perusahaan->file_npwp = $filePath;
        }
        if ($request->hasFile('file_akta_pendirian')) {
            $filePath = $request->file('file_akta_pendirian')->store('dokumen_legal', 'public');
            $perusahaan->file_akta_pendirian = $filePath;
        }
        if ($request->hasFile('file_izin_operasional')) {
            $filePath = $request->file('file_izin_operasional')->store('dokumen_legal', 'public');
            $perusahaan->file_izin_operasional = $filePath;
        }
        if ($request->hasFile('file_sertifikasi_bnsp')) {
            $filePath = $request->file('file_sertifikasi_bnsp')->store('dokumen_legal', 'public');
            $perusahaan->file_sertifikasi_bnsp = $filePath;
        }

        $perusahaan->save();

        return redirect()->route('ProfilPerusahaan')->with('success', 'Profil berhasil diperbarui.');
    }

    public function kirimVerifikasi()
    {
        $user = Auth::user();

        if ($user->status_verifikasi === 'Sudah Diverifikasi') {
            return redirect()->back()->with('info', 'Akun Anda sudah diverifikasi.');
        }

        // Update status verifikasi
        $user->status_verifikasi = 'Belum Diverifikasi';
        $user->save();

        // Tambahkan logic notifikasi admin / log / dsb jika diperlukan

        return redirect()->back()->with('success', 'Permintaan verifikasi berhasil dikirim. Mohon tunggu persetujuan admin.');
    }
}
