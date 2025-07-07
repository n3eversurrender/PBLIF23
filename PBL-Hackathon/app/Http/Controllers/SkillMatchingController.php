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


    $messages = [
    'minat_bidang.required' => 'Bidang yang diminati wajib diisi.',
    'minat_bidang.string' => 'Bidang yang diminati harus berupa teks.',
    'minat_bidang.max' => 'Bidang yang diminati maksimal 255 karakter.',

    'bidang.required' => 'Bidang saat ini wajib diisi.',
    'bidang.string' => 'Bidang saat ini harus berupa teks.',
    'bidang.max' => 'Bidang saat ini maksimal 255 karakter.',

    'level.required' => 'Level kursus wajib dipilih.',
    'level.string' => 'Level kursus harus berupa teks.',
    'level.in' => 'Level kursus harus salah satu dari: Pemula, Menengah, atau Lanjutan.',

    'pendidikan.required' => 'Riwayat pendidikan wajib diisi.',
    'pendidikan.string' => 'Riwayat pendidikan harus berupa teks.',
    'pendidikan.max' => 'Riwayat pendidikan maksimal 255 karakter.',

    'status.required' => 'Status wajib dipilih.',
    'status.string' => 'Status harus berupa teks.',
    'status.in' => 'Status harus salah satu dari: Siswa, Mahasiswa, atau Pekerja.',

    'nama_keahlian.required' => 'Keahlian wajib diisi.',
    'nama_keahlian.string' => 'Keahlian harus berupa teks.',
];

    // Validasi data
    $request->validate([
        'minat_bidang' => 'required|string|max:255',
        'bidang' => 'required|string|max:255',
        'level' => 'required|string|in:Pemula,Menengah,Lanjutan',
        'pendidikan' => 'required|string|max:255',
        'status' => 'required|string|in:Siswa,Mahasiswa,Pekerja',
        'nama_keahlian' => 'required|string',
    ], $messages);

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
        Skill::Create([
            'peserta_id' => $pesertaId, // yang disimpan ID peserta
            'kursus_id' => $skillmatching['kursus_id'],
            'score' => $skillmatching['score'],
        ]);
    }

    return redirect()->route('BerandaTrainee')->with('success', 'Rekomendasi berhasil disimpan.');

} catch (\Exception $e) {
    return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
