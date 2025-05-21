<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PengaturanPesertaController extends Controller
{
    public function pengaturanPeserta()
    {
        // Mendapatkan ID pengguna yang sedang login
        $id = Auth::id();

        $pengguna = Pengguna::with('peserta')->find($id);

        if (!$pengguna) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Ambil daftar pelatih (jika ada)
        $pesertaList = Peserta::where('pengguna_id', $id)->paginate(10); // Gunakan paginate jika diperlukan

        return view('peserta.PengaturanPeserta', [
            'pengguna' => $pengguna,
            'peserta' => $pengguna->peserta, // Relasi pelatih dari pengguna
            'pesertaList' => $pesertaList, // Tambahkan variabel $pelatihList ke view
        ]);
    }

    public function updatePeserta(Request $request)
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

    public function storePeserta(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tahun_pengalaman' => 'nullable|integer|min:0',
            'bulan_pengalaman' => 'nullable|integer|min:0|max:11',
            'nama_keahlian' => 'nullable|string|max:255',
        ]);

        $pengguna_id = Auth::id();

        // Default pengalaman_kerja ke 0 jika tidak diberikan
        $pengalaman_kerja = $validatedData['pengalaman_kerja'] ?? 0;

        // Membuat instance peserta baru
        $peserta = new Peserta();
        $peserta->pengguna_id = $pengguna_id;
        $peserta->tahun_pengalaman = $validatedData['tahun_pengalaman'] ?? 0;
        $peserta->bulan_pengalaman = $validatedData['bulan_pengalaman'] ?? 0;
        $peserta->nama_keahlian = $validatedData['nama_keahlian'] ?? null; // Mengganti field nama_spesialisasi menjadi nama_keahlian
        $peserta->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function updatePesertaKeahlian(Request $request, $peserta_id)
    {
        $request->validate([
            'tahun_pengalaman' => 'required|integer|min:0', 
            'bulan_pengalaman' => 'required|integer|min:0|max:11',
            'nama_keahlian' => 'required|string|max:255', 
        ]);

        // Cari peserta berdasarkan ID
        $peserta = Peserta::findOrFail($peserta_id);

        // Update pengalaman kerja dan nama keahlian
        $peserta->tahun_pengalaman = $request->input('tahun_pengalaman');
        $peserta->bulan_pengalaman = $request->input('bulan_pengalaman');
        $peserta->nama_keahlian = $request->input('nama_keahlian');

        // Simpan perubahan ke database
        $peserta->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroyPeserta($peserta_id)
    {
        $peserta = Peserta::findOrFail($peserta_id);

        $peserta->delete();

        return redirect()->back()->with('success', 'Peserta berhasil dihapus.');
    }
}
