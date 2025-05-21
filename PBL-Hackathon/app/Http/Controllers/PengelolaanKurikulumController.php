<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use App\Models\Kursus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PengelolaanKurikulumController extends Controller
{
    public function pengelolaanKurikulum()
    {
        $id = Auth::id(); // Ambil ID pengguna yang sedang login
        // Ambil kursus yang terkait dengan pengguna yang sedang login
        $kursus = Kursus::where('pengguna_id', $id) // Filter berdasarkan ID pengguna
            ->paginate(10); // Paginate dengan ukuran 10 per halaman

        return view('pelatih.PengelolaanKurikulum', [
            'kursus' => $kursus,
        ]);
    }

    public function tambahKurikulum($kursus_id)
    {
        $kurikulum = Kurikulum::where('kursus_id', $kursus_id)->paginate(10); // Data kurikulum terkait dengan kursus_id
        $kursus = Kursus::findOrFail($kursus_id); // Ambil data kursus (opsional)

        return view('pelatih.TambahKurikulum', [
            'kursus_id' => $kursus_id,
            'kurikulum' => $kurikulum,
            'kursus' => $kursus,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'kursus_id' => 'required|exists:kursus,kursus_id',
            'nama_topik' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'durasi' => 'nullable|string',
            'materi' => 'nullable|string',
        ], [
            'nama_topik.required' => 'Nama topik wajib diisi',
            'nama_topik.max' => 'Nama topik maksimal 255 Karakter',
        ]);

        // Simpan ke database
        Kurikulum::create($validated);

        return redirect()->back()->with('success', 'Kurikulum berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_topik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi' => 'required|integer',
            'materi' => 'required|string',
        ]);

        // Temukan item kurikulum berdasarkan ID
        $kurikulum = Kurikulum::findOrFail($id);

        // Perbarui data kurikulum
        $kurikulum->update([
            'nama_topik' => $request->nama_topik,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,
            'materi' => $request->materi,
        ]);

        // Redirect ke halaman dengan pesan sukses
        return redirect()->back()->with('success', 'Kurikulum berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan item kurikulum berdasarkan ID
        $kurikulum = Kurikulum::findOrFail($id);

        // Hapus data kurikulum
        $kurikulum->delete();

        // Redirect ke halaman dengan pesan sukses
        return redirect()->back()->with('success', 'Kurikulum berhasil dihapus!');
    }
}
