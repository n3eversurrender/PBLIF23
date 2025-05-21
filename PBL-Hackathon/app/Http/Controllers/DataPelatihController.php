<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\Log;

class DataPelatihController extends Controller
{
    public function dataPelatih()
    {
        $penggunaList = Pengguna::where('peran', 'Pelatih')
            ->with('verifikasi') // Pastikan relasi verifikasi dimuat
            ->paginate(10);

        return view('Admin.DataPelatih', [
            'penggunaList' => $penggunaList,
        ]);
    }


    public function konfirmasiVerifikasi($verifikasi_id, $status)
    {
        Log::info("Verifikasi ID: $verifikasi_id, Status: $status");

        try {
            // Validasi status
            if (!in_array($status, ['Disetujui', 'Ditolak'])) {
                return redirect()->back()->with('error', 'Status tidak valid.');
            }

            // Cari data verifikasi berdasarkan ID
            $verifikasi = Verifikasi::findOrFail($verifikasi_id);
            Log::info("Verifikasi ditemukan: ", $verifikasi->toArray());

            // Update status verifikasi
            $verifikasi->update(['status_verifikasi' => $status]);

            // Perbarui status pengguna berdasarkan hasil verifikasi
            $pengguna = Pengguna::findOrFail($verifikasi->pengguna_id);
            Log::info("Pengguna ditemukan: ", $pengguna->toArray());

            // Pembaruan status pengguna
            if ($status === 'Disetujui') {
                $pengguna->status = 'Aktif'; // Set status aktif
            } elseif ($status === 'Ditolak') {
                $pengguna->status = 'Tidak Aktif'; // Set status tidak aktif
            }

            $pengguna->save(); // Simpan perubahan ke database
            Log::info("Status pengguna setelah update: " . $pengguna->status); // Cek status setelah update

            return redirect()->back()->with('success', 'Status verifikasi dan status pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error memperbarui status verifikasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba lagi nanti.');
        }
    }


    public function update($pengguna_id, Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // Cari pengguna berdasarkan pengguna_id
        $pengguna = Pengguna::findOrFail($pengguna_id);

        // Update status pengguna
        $pengguna->status = $validated['status'];
        $pengguna->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Status pelatih berhasil diupdate');
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
}
