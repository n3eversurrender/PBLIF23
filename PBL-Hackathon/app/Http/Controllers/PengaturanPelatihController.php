<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PengaturanPelatihController extends Controller
{
    public function pengaturanPelatih()
    {
        $id = Auth::id();

        $pengguna = Pengguna::with('pelatih')->find($id);

        if (!$pengguna) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Ambil daftar pelatih (jika ada)
        $pelatihList = Pelatih::where('pengguna_id', $id)->paginate(10);

        return view('pelatih.PengaturanPelatih', [
            'pengguna' => $pengguna,
            'pelatih' => $pengguna->pelatih,
            'pelatihList' => $pelatihList,
        ]);
    }

    public function ajukanVerifikasi()
    {
        $penggunaId = Auth::id(); // Ambil ID pengguna yang sedang login

        // Pastikan pengguna login
        if (!$penggunaId) {
            return redirect()->back()->with('error', 'Anda tidak terautentikasi.');
        }

        // Cek apakah pengguna sudah pernah mengajukan verifikasi sebelumnya
        $existingVerifikasi = Verifikasi::where('pengguna_id', $penggunaId)->first();

        if ($existingVerifikasi) {
            // Jika status verifikasi sebelumnya Ditolak, update status menjadi Menunggu
            if ($existingVerifikasi->status_verifikasi == 'Ditolak') {
                $existingVerifikasi->status_verifikasi = 'Menunggu';
                $existingVerifikasi->save();

                return redirect()->back()->with('success', 'Pengajuan verifikasi telah diperbarui. Harap tunggu konfirmasi admin.');
            }

            // Jika status verifikasi sebelumnya Menunggu, tampilkan pesan error
            if ($existingVerifikasi->status_verifikasi == 'Menunggu') {
                return redirect()->back()->with('error', 'Anda sudah mengajukan verifikasi. Harap tunggu konfirmasi admin.');
            }
        }

        try {
            // Jika belum pernah mengajukan atau status sebelumnya tidak Ditolak, buat pengajuan baru
            Verifikasi::create([
                'pengguna_id' => $penggunaId,
                'status_verifikasi' => 'Menunggu',
            ]);

            return redirect()->back()->with('success', 'Pengajuan verifikasi berhasil diajukan. Harap tunggu konfirmasi admin.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba lagi nanti.');
        }
    }


    public function updatePelatih(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|digits_between:10,15',
            'alamat' => 'required|string|max:255',
            'kata_sandi' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'no_telepon.required' => 'Nomor Telepone wajib diisi',
            'no_telepon.digits_between' => 'Nomor telepon harus antara 10 hingga 15 digit.',

            'alamat.required' => 'Alamat wajib diisi',
            
            'kata_sandi.string' => 'Kata sandi harus berupa teks.',
            'kata_sandi.min' => 'Kata sandi minimal 8 karakter.',
            'kata_sandi.regex' => 'Kata sandi harus mengandung huruf besar, huruf kecil, dan angka.',

            'foto_profil.image' => 'Format gambar tidak sesuai',
            'foto_profil.mimes' => 'Format gambar tidak sesuai',
            'foto_profil.max' => 'Ukuran gambar melebihi kapasitas, Maksimal 5MB'
        ]);

        $id = Auth::id();

        $pengguna = Pengguna::find($id);

        $pengguna->nama = $request->nama;
        $pengguna->no_telepon = $request->no_telepon;
        $pengguna->alamat = $request->alamat;
        $pengguna->jenis_kelamin = $request->jenis_kelamin;

        if (!empty($request->kata_sandi)) {
            $pengguna->kata_sandi = bcrypt($request->kata_sandi);
        }

        if ($request->hasFile('foto_profil')) {
            try {
                $photo = $request->file('foto_profil');


                $photoPath = $photo->store('foto_profil', 'public');
                $pengguna->foto_profil = basename($photoPath);

                Log::info("Profile photo uploaded successfully for user ID: {$id}. Photo path: {$photoPath}");
            } catch (\Exception $e) {
                Log::error("Error uploading profile photo for user ID: {$id}. Error: {$e->getMessage()}");
            }
        }

        $pengguna->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }


    public function storePelatih(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tahun_pengalaman' => 'nullable|integer|min:0',
            'bulan_pengalaman' => 'nullable|integer|min:0|max:11',
            'nama_spesialisasi' => 'nullable|string|max:255',
            'file_sertifikasi' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $pengguna_id = Auth::id();

        // Jika file sertifikasi diunggah
        $file_sertifikasi = null;
        if ($request->hasFile('file_sertifikasi')) {
            $file = $request->file('file_sertifikasi');
            $namaFile = $file->getClientOriginalName();

            // Simpan file ke storage public
            $file_sertifikasi = $file->storeAs('sertifikasi_pdfs', $namaFile, 'public');
        }

        // Buat data pelatih baru
        $pelatih = new Pelatih();
        $pelatih->pengguna_id = $pengguna_id;
        $pelatih->tahun_pengalaman = $validatedData['tahun_pengalaman'] ?? 0;
        $pelatih->bulan_pengalaman = $validatedData['bulan_pengalaman'] ?? 0;
        $pelatih->nama_spesialisasi = $validatedData['nama_spesialisasi'] ?? null;
        $pelatih->file_sertifikasi = $file_sertifikasi;
        $pelatih->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function updatePelatihSpesialisasi(Request $request, $pelatih_id)
    {
        // Validasi input
        $request->validate([
            'tahun_pengalaman' => 'required|integer|min:0', // Validasi tahun pengalaman
            'bulan_pengalaman' => 'required|integer|min:0|max:11', // Validasi bulan pengalaman
            'nama_spesialisasi' => 'required|string|max:255',
            'file_sertifikasi' => 'nullable|file|mimes:pdf|max:5120', // Validasi file PDF
        ]);

        // Cari pelatih berdasarkan ID
        $pelatih = Pelatih::findOrFail($pelatih_id);

        // Update pengalaman kerja dan spesialisasi
        $pelatih->tahun_pengalaman = $request->input('tahun_pengalaman');
        $pelatih->bulan_pengalaman = $request->input('bulan_pengalaman');
        $pelatih->nama_spesialisasi = $request->input('nama_spesialisasi');

        // Periksa apakah ada file sertifikasi yang diupload
        if ($request->hasFile('file_sertifikasi')) {
            // Hapus file lama jika ada
            if ($pelatih->file_sertifikasi) {
                Storage::delete('public/' . $pelatih->file_sertifikasi);
            }

            // Simpan file sertifikasi baru
            $file = $request->file('file_sertifikasi');
            $filePath = $file->storeAs('sertifikasi_pdfs', $file->getClientOriginalName(), 'public');
            $pelatih->file_sertifikasi = $filePath;
        }

        // Simpan perubahan ke database
        $pelatih->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data spesialisasi pelatih berhasil diperbarui.');
    }

    public function destroyPelatih($pelatih_id)
    {
        $pelatih = Pelatih::findOrFail($pelatih_id);

        if ($pelatih->file_sertifikasi) {
            Storage::delete('public/' . $pelatih->file_sertifikasi);
        }

        $pelatih->delete();

        return redirect()->back()->with('success', 'Pelatih berhasil dihapus.');
    }
}
