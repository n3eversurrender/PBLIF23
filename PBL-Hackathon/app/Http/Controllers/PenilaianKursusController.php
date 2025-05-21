<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Pengguna;
use App\Models\RatingKursus;
use App\Models\RatingPelatih;

class PenilaianKursusController extends Controller
{
    public function penilaianKursus()
    {
        $id = Auth::id(); // ID pengguna yang sedang login

        // Ambil data pendaftaran dengan relasi kursus dan pelatih
        $pendaftaran = Pendaftaran::with([
            'kursus.ratingKursus' => function ($query) use ($id) {
                $query->where('pengguna_id', $id);
            },
            'kursus.pengguna.ratingsPelatih' => function ($query) use ($id) {
                $query->where('pemberi_id', $id); // Filter rating oleh pemberi yang sedang login
            },
        ])->where('pengguna_id', $id)->paginate(10);

        // Ambil daftar pelatih yang mengajar kursus
        $pelatihs = Pengguna::whereIn('pengguna_id', $pendaftaran->pluck('kursus.pengguna_id'))->get();

        // Ambil daftar kursus yang diikuti oleh pengguna
        $kursus = $pendaftaran->pluck('kursus');

        return view('peserta.PenilaianKursus', compact('pendaftaran', 'pelatihs', 'kursus'));
    }


    public function submitRating(Request $request)
    {
        // Validasi data input
        $request->validate([
            'rating_pelatih' => 'required|numeric|min:1|max:10',
            'komentar_pelatih' => 'nullable|string',
            'rating_kursus' => 'required|numeric|min:1|max:10',
            'komentar_kursus' => 'nullable|string',
        ], [
            'rating_pelatih.required' => 'Rating wajib diisi',
            'rating_pelatih.min' => 'Rating minimal harus bernilai 1',
            'rating_pelatih.max' => 'Rating maksimal harus bernilai 10',

            'rating_kursus.required' => 'Rating wajib diisi',
            'rating_kursus.min' => 'Rating minimal harus bernilai 1',
            'rating_kursus.max' => 'Rating maksimal harus bernilai 10',
        ]);

        // Cek apakah pengguna sudah memberikan rating pada kursus yang sama
        $existingKursusRating = RatingKursus::where('kursus_id', $request->kursus_id)
            ->where('pengguna_id', Auth::id())
            ->first();

        if ($existingKursusRating) {
            // Jika sudah ada rating untuk kursus yang sama, tampilkan pesan
            return redirect()->back()->with('error', 'Anda sudah memberikan rating untuk kursus ini.');
        }

        // Menyimpan rating pelatih
        RatingPelatih::create([
            'pemberi_id' => Auth::id(),
            'pengguna_id' => $request->pengguna_id, // ID pelatih
            'rating' => $request->rating_pelatih,
            'komentar' => $request->komentar_pelatih,
        ]);

        // Menyimpan rating kursus
        RatingKursus::create([
            'kursus_id' => $request->kursus_id, // ID kursus
            'pengguna_id' => Auth::id(), // ID pengguna yang memberikan rating
            'rating' => $request->rating_kursus,
            'komentar' => $request->komentar_kursus,
        ]);

        return redirect()->back()->with('success', 'Rating berhasil diberikan');
    }
}
