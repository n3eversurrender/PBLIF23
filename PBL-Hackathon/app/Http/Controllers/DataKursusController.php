<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Pengguna;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataKursusController extends Controller
{
    // Menampilkan daftar kursus dengan pagination
    public function dataKursus()
    {
        try {
            $kursusList = Kursus::paginate(10);
            return view('Admin.DataKursus', ['kursusList' => $kursusList]);
        } catch (\Exception $e) {
            Log::error('Error fetching kursus data: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat data kursus.');
        }
    }

    // Mengonfirmasi status verifikasi
    public function konfirmasiVerifikasi($verifikasi_id, $status)
    {
        try {
            // Validasi status
            if (!in_array($status, ['Disetujui', 'Ditolak'])) {
                return redirect()->back()->with('error', 'Status tidak valid.');
            }

            // Cari data verifikasi berdasarkan ID
            $verifikasi = Verifikasi::findOrFail($verifikasi_id);

            // Update status verifikasi
            $verifikasi->update(['status_verifikasi' => $status]);

            // Perbarui status pengguna
            $pengguna = Pengguna::findOrFail($verifikasi->pengguna_id);
            $pengguna->status = ($status === 'Disetujui') ? 'Aktif' : 'Tidak Aktif';
            $pengguna->save();

            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating verification status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba lagi nanti.');
        }
    }

    // Mengupdate status kursus (Aktif/Tidak Aktif)
    public function update(Request $request, $kursus_id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'status_pendaftaran' => 'required|in:Aktif,Tidak Aktif',
            ]);

            // Update status kursus
            $kursus = Kursus::findOrFail($kursus_id);
            $kursus->update(['status' => $validated['status_pendaftaran']]);

            return redirect()->back()->with('success', 'Status kursus berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating kursus status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui status kursus.');
        }
    }

    // Menghapus kursus
    public function destroy($id)
    {
        try {
            $kursus = Kursus::findOrFail($id);
            $kursus->delete();

            return redirect()->route('DataKursus')->with('success', 'Kursus berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting kursus: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus kursus.');
        }
    }
}
