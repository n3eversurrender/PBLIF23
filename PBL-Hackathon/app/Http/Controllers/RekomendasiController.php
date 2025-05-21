<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class RekomendasiController extends Controller
{

    public function getRecommendation(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'harga_maks' => 'required|numeric|min:0',
            'rating_min' => 'required|numeric|min:1|max:10',
            'pengalaman_min' => 'required|numeric|min:0',
            'tingkat_kesulitan' => 'required|string|in:Pemula,Menengah,Lanjutan',
            'lokasi' => 'required|string|max:255',
        ], [
            'harga_maks.required' => 'Harga wajib diisi.',
            'rating_min.required' => 'Rating wajib diisi',
            'pengalaman_min.required' => 'Pengalaman Pelatih wajib diisi',
            'lokasi.required' => "Lokasi wajib diisi",
            'numeric' => 'Harus berupa angka.',
            'string' => 'Harus berupa teks.',
            'in' => 'Kolom :attribute tidak valid.',
            'max' => 'Tidak boleh lebih dari :max',
            'min' => 'Tidak boleh kurang dari :min.',
        ]);

        // URL Flask API
        $apiUrl = 'http://127.0.0.1:9999/rekomendasi';

        // Ambil data dari formulir
        $formData = $request->all();

        // Kirim permintaan ke Flask API
        $response = Http::post($apiUrl, $validated);


        // Cek apakah respons berhasil
        if ($response->successful()) {
            // Ambil data hasil rekomendasi
            $data = $response->json();

            // Kirim data ke Blade view untuk ditampilkan
            return view('guest.recommendation', compact('data'));
        } else {
            // Jika ada error, kembali ke formulir dengan pesan error
            return back()->withErrors(['message' => 'Gagal mendapatkan rekomendasi. Coba lagi!']);
        }
    }
}
