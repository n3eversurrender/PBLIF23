<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Kursus; // tambahkan ini di atas jika belum
use Illuminate\Support\Facades\Log; // Import facade Log untuk logging error\



class SkillMatchingController extends Controller
{

    public function view()
    {
        return view('SkillMatching');
    }

    public function skillmatching(Request $request)
    {
        $id = Auth::id();

        $messages = [
            'minat_bidang.required' => 'Bidang yang diminati wajib diisi.',
            'minat_bidang.string' => 'Bidang yang diminati harus berupa teks.',
            'minat_bidang.max' => 'Bidang yang diminati maksimal 255 karakter.',

            'bidang_saat_ini.required' => 'Bidang saat ini wajib diisi.',
            'bidang_saat_ini.string' => 'Bidang saat ini harus berupa teks.',
            'bidang_saat_ini.max' => 'Bidang saat ini maksimal 255 karakter.',

            'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib dipilih.',
            'tingkat_kesulitan.string' => 'Tingkat kesulitan harus berupa teks.',
            'tingkat_kesulitan.in' => 'Tingkat kesulitan harus salah satu dari: Pemula, Menengah, atau Lanjutan.',

            'pendidikan.required' => 'Riwayat pendidikan wajib diisi.',
            'pendidikan.string' => 'Riwayat pendidikan harus berupa teks.',
            'pendidikan.in' => 'Pendidikan harus salah satu dari: SD, SMP, SMA, D3, S1, S2, S3.',

            'status.required' => 'Status wajib dipilih.',
            'status.string' => 'Status harus berupa teks.',
            'status.in' => 'Status harus salah satu dari: Mahasiswa, Pekerja, Dosen, Lainnya.',

            'nama_keahlian.required' => 'Keahlian wajib diisi.',
            'nama_keahlian.string' => 'Keahlian harus berupa teks.',
        ];

        // ✅ Validasi input
        $request->validate([
            'minat_bidang' => 'required|string|max:255',
            'bidang_saat_ini' => 'required|string|max:255',
            'tingkat_kesulitan' => 'required|string|in:Pemula,Menengah,Lanjutan',
            'pendidikan' => 'required|string|in:SD,SMP,SMA,D3,S1,S2,S3',
            'status' => 'required|string|in:Mahasiswa,Pekerja,Dosen,Lainnya',
            'nama_keahlian' => 'required|string|max:255',
        ], $messages);

        $bidangSaatIni = [[
            'bidang' => $request->bidang_saat_ini,
            'tahun' => 0,
            'bulan' => 0,
        ]];

        // ✅ Simpan/update peserta
        Peserta::updateOrCreate(
            ['pengguna_id' => $id],
            [
                'status' => $request->status,
                'pendidikan' => $request->pendidikan,
                'minat_bidang' => $request->minat_bidang,
                'bidang_saat_ini' => json_encode($bidangSaatIni),
                'nama_keahlian' => $request->nama_keahlian,
            ]
        );

        try {
            $peserta = Peserta::where('pengguna_id', $id)->first();

            if (!$peserta) {
                return back()->with('error', 'Peserta tidak ditemukan.');
            }

            $pesertaId = $peserta->peserta_id;

            // ✅ Kirim request ke Flask
            $response = Http::post('http://127.0.0.1:9999/skillmatching', [
                'pengguna_id' => $id,
                'tingkat_kesulitan' => $request->tingkat_kesulitan
            ]);

            $result = $response->json();

            if (empty($result['skillmatching'])) {
                return back()->with('error', 'Tidak ada rekomendasi yang ditemukan.');
            }

            // ✅ Simpan rekomendasi
            foreach ($result['skillmatching'] as $item) {
                Skill::create([
                    'peserta_id' => $pesertaId,
                    'kursus_id' => $item['kursus_id'],
                    'score' => $item['score'],
                ]);
            }

            return redirect()->route('BerandaTrainee')->with('success', 'Rekomendasi berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Skillmatching Error', [
                'user_id' => $id,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

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
