<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RekomendasiController extends Controller
{
    public function getRecommendation(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'harga_maks' => 'required|numeric|min:0',
            'rating_min' => 'required|numeric|min:0|max:5',
            'rating_perusahaan_min' => 'required|numeric|min:0|max:5',
            'tingkat_kesulitan' => 'required|string|in:Pemula,Menengah,Lanjutan',
            'lokasi' => 'required|string|max:255',
        ], [
            'harga_maks.required' => 'Harga wajib diisi.',
            'rating_min.required' => 'Rating kursus wajib diisi.',
            'rating_perusahaan_min.required' => 'Rating perusahaan wajib diisi.',
            'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'in' => 'Kolom :attribute tidak valid.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max.',
            'min' => 'Kolom :attribute tidak boleh kurang dari :min.',
        ]);

        // URL Flask API
        $apiUrl = 'http://127.0.0.1:9999/rekomendasi';

        try {
            // Kirim permintaan ke Flask API
            $response = Http::post($apiUrl, $validated);

            if ($response->successful()) {
                $data = $response->json();

                // Nanti di sini kita bisa tambahkan query untuk ambil semua kursus (untuk visualisasi perbandingan)
                // Contoh placeholder:
                // $all_courses = Kursus::select('judul', 'avg_rating', 'harga')->get();

                return view('guest.recommendation', [
                    'data' => $data,
                    // 'all_courses' => $all_courses
                ]);
            } else {
                return back()->withErrors(['message' => 'Gagal mendapatkan rekomendasi. Coba lagi!']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Terjadi kesalahan saat menghubungi sistem rekomendasi.']);
        }
    }
}
