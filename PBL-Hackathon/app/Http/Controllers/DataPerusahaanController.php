<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\Log;

class DataPerusahaanController extends Controller
{
    public function dataPerusahaan()
    {
        $penggunaList = Pengguna::where('peran', 'Perusahaan')
            ->paginate(10);

        return view('Admin.DataPerusahaan', [
            'penggunaList' => $penggunaList,
        ]);
    }


    public function konfirmasiVerifikasi($pengguna_id, $status)
    {
        try {
            // Validasi status hanya boleh 2 ini
            if (!in_array($status, ['Sudah Diverifikasi', 'Ditolak'])) {
                return redirect()->back()->with('error', 'Status tidak valid.');
            }

            // Cari pengguna
            $pengguna = Pengguna::findOrFail($pengguna_id);

            // Update status verifikasi
            $pengguna->status_verifikasi = $status;
            $pengguna->save();

            return redirect()->back()->with('success', "Status verifikasi berhasil diubah menjadi $status.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }
    // Menghapus pelatih
    public function destroy($id)
    {
        try {
            $pengguna = Pengguna::findOrFail($id);
            $pengguna->delete();

            return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus pengguna.');
        }
    }

    public function tambahPerusahaan()
    {
        return view('admin/TambahPerusahaan', []);
    }

    public function storePerusahaan(Request $request)
    {
        Log::info('Masuk ke storePerusahaan dengan data:', $request->all());

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna',
            'no_telepon' => 'required|string|max:20',
            'kata_sandi' => 'required|min:8',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email ini sudah terdaftar',
            'no_telepon.required' => 'Nomor telepon wajib diisi',
            'no_telepon.max' => 'Nomor telepon maksimal 20',
            'kata_sandi.required' => 'Kata sandi wajib diisi',
            'kata_sandi.min' => 'Kata sandi minimal 8 karakter',
        ]);

        try {
            $pengguna = Pengguna::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telepon' => $request->no_telepon,
                'kata_sandi' => bcrypt($request->kata_sandi),
                'peran' => 'Perusahaan',
                'status_verifikasi' => 'Ditolak',
            ]);

            Log::info('Data perusahaan berhasil disimpan:', $pengguna->toArray());

            return redirect()->route('DataPerusahaan')->with('success', 'Data Perusahaan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal insert data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal simpan data. ' . $e->getMessage());
        }
    }
}
