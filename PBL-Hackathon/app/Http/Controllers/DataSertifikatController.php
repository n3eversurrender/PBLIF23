<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Untuk logging

use Illuminate\Support\Facades\Storage;


class DataSertifikatController extends Controller
{
    public function dataSertifikat()
    {
        // Ambil semua sertifikat tanpa eager loading
        $sertifikat = Sertifikat::paginate(10);

        return view('Admin.DataSertifikat', [
            'sertifikat' => $sertifikat,
        ]);
    }

    // Menghapus sertifikat dari database
    public function destroy($sertifikat_id)
    {
        // Mengambil data sertifikat berdasarkan id
        $sertifikat = Sertifikat::findOrFail($sertifikat_id);

        // Hapus file sertifikat jika ada
        if (file_exists(storage_path('app/sertifikat_pdfs/' . $sertifikat->file_sertifikat))) {
            unlink(storage_path('app/sertifikat_pdfs/' . $sertifikat->file_sertifikat));  // Hapus file sertifikat
        }

        // Hapus sertifikat dari database
        $sertifikat->delete();

        // Redirect kembali ke halaman pengelolaan sertifikat dengan pesan sukses
        return redirect()->back()->with('success', 'Sertifikat berhasil dihapus.');
    }

    public function update(Request $request, $sertifikat_id)
    {
        // Debugging log untuk memantau request data
        Log::info('Request Data:', $request->all());

        // Validasi input, semua kolom opsional kecuali file harus sesuai format
        $validatedData = $request->validate([
            'pendaftaran_id' => 'nullable|exists:peserta,pendaftaran_id',
            'file_sertifikat' => 'nullable|file|mimes:pdf|max:10240', // Maksimum 10MB
            'nomor_sertifikat' => 'nullable|string',
            'tanggal_terbit' => 'nullable|date',
        ], [
            'pendaftaran_id.required' => 'Peserta wajib diisi',
            'file_sertifikat.required' => 'Sertifikat wajib diisi',
            'nomor_sertifikat.required' => 'Nomor sertifikat wajib diisi',
            'tanggal_terbit.required' => 'Tanggal terbit wajib diisi',
            'file_sertifikat.mimes' => 'Format sertifikat harus PDF',
            'file_sertifikat.max' => 'Ukuran sertifikat tidak boleh lebih dari 10MB',
        ]);

        // Ambil data sertifikat berdasarkan ID
        $sertifikat = Sertifikat::findOrFail($sertifikat_id);

        // Jika ada file baru, hapus file lama dan simpan yang baru
        if ($request->hasFile('file_sertifikat')) {
            if (Storage::disk('public')->exists($sertifikat->file_sertifikat)) {
                Storage::disk('public')->delete($sertifikat->file_sertifikat);
            }
            $file = $request->file('file_sertifikat');
            $filePath = $file->store('sertifikat_pdfs', 'public');
            $sertifikat->file_sertifikat = $filePath;
        }

        // Update data lain jika ada input
        if (!empty($validatedData['pendaftaran_id'])) {
            $sertifikat->pendaftaran_id = $validatedData['pendaftaran_id'];
        }
        if (!empty($validatedData['nomor_sertifikat'])) {
            $sertifikat->nomor_sertifikat = $validatedData['nomor_sertifikat'];
        }
        if (!empty($validatedData['tanggal_terbit'])) {
            $sertifikat->tanggal_terbit = $validatedData['tanggal_terbit'];
        }

        // Simpan perubahan ke database
        $success = $sertifikat->save();

        // Logging hasil penyimpanan
        if ($success) {
            Log::info('Sertifikat berhasil diperbarui:', $sertifikat->toArray());
        } else {
            Log::error('Gagal menyimpan perubahan pada sertifikat ID: ' . $sertifikat_id);
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Sertifikat berhasil diperbarui.');
    }
}
