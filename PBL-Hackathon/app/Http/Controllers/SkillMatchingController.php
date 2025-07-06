<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use App\Models\skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SkillMatchingController extends Controller
{

    public function view(){
        return view('SkillMatching');
    }


public function skillmatching(Request $request)
{
    $id = Auth::id();

    // Validasi data
    $request->validate([
        'minat_bidang' => 'required|string|max:255',
        'bidang' => 'required|string|max:255',
        'level' => 'required|string|in:Pemula,Menengah,Lanjutan',
        'pendidikan' => 'nullable|string|max:255',
        'status' => 'nullable|string|in:Siswa,Mahasiswa,Pekerja',
        'nama_keahlian' => 'nullable|string',
    ]);

    // Simpan data trainee ke database
    Peserta::updateOrCreate(
        ['pengguna_id' => $id], // update jika sudah ada
        [
            'status' => $request->status,
            'pendidikan' => $request->pendidikan,
            'minat_bidang' => $request->minat_bidang,
            'bidang' => $request->bidang, // pastikan sesuai nama kolom di DB kamu
            'nama_keahlian' => $request->nama_keahlian,
            'level' => $request->level,
        ]
    );

    try {
    $penggunaId = Auth::id();

    // Ambil peserta_id yang sesuai dengan pengguna_id
    $peserta = Peserta::where('pengguna_id', $penggunaId)->first();

    if (!$peserta) {
        return back()->with('error', 'Peserta tidak ditemukan.');
    }

    $pesertaId = $peserta->peserta_id;

    // Panggil API Flask
    $response = Http::post('http://127.0.0.1:9999/skillmatching', [
        'pengguna_id' => $penggunaId // API Flask tetap pakai pengguna_id
    ]);

    $result = $response->json();

    if (empty($result['skillmatching  '])) {
        return back()->with('error', 'Tidak ada rekomendasi yang ditemukan.');
    }

    // Simpan hasil rekomendasi
    foreach ($result['skillmatching'] as $skillmatching) {
        Skill::create([
            'peserta_id' => $pesertaId, // yang disimpan ID peserta
            'kursus_id' => $skillmatching['kursus_id'],
            'score' => $skillmatching['score'],
        ]);
    }

    return redirect()->route('BerandaTrainee')->with('success', 'Rekomendasi berhasil disimpan.');

} catch (\Exception $e) {
    return redirect()->route('BerandaTrainee')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
}


}

public function rekomendasiSaya()
{
    $penggunaId = Auth::id();

    // Cari peserta dari pengguna yang login
    $peserta = \App\Models\Peserta::where('pengguna_id', $penggunaId)->first();

    if (!$peserta) {
        return back()->with('error', 'Data peserta tidak ditemukan.');
    }

    // Ambil 3 skill tertinggi dengan relasi kursus
    $skills = $peserta->skills()
                ->with('kursus') // eager load biar hemat query
                ->orderByDesc('score')
                ->take(3)
                ->get();

    return view('BerandaTrainee', compact('skills'));
}


}
