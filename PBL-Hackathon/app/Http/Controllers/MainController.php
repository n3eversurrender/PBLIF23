<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use App\Models\Pengguna;
use App\Models\UmpanBalik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function Main()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Mengirimkan data pengguna ke view
        return view('layouts.main', compact('user'));
    }

    public function mainPeserta()
    {
        return view('layouts/mainPeserta', []);
    }
    public function mainPelatih()
    {
        return view('layouts/mainPelatih', []);
    }

    public function Home()
    {
        // Ambil kursus terpopuler: paling banyak pendaftar + rating bagus
        $kursus = \App\Models\Kursus::with(['kategori', 'pengguna'])
            ->withCount('pendaftaran')                // Hitung jumlah pendaftar
            ->withAvg('ratingKursus', 'rating')       // Hitung rata-rata rating
            ->where('status', 'Aktif')
            ->orderByDesc('pendaftaran_count')        // Prioritas banyak pendaftar
            ->orderByDesc('rating_kursus_avg_rating') // Lalu rating
            ->limit(4)
            ->get();

        return view('guest.Home', compact('kursus'));
    }



    public function daftarKursus(Request $request)
    {
        $kategori_id = $request->input('kategori_id');
        $tingkat_kesulitan = $request->input('tingkat_kesulitan');

        // Query awal: ambil kursus aktif dengan relasi & data rating
        $query = Kursus::with(['kategori', 'ratingKursus'])
            ->withCount('ratingKursus as total_ratings')  // jumlah rating
            ->withSum('ratingKursus as total_rating_sum', 'rating') // total nilai rating
            ->where('status', 'Aktif')
            ->whereDate('tgl_mulai', '<=', Carbon::today()) // Sudah dimulai
            ->whereDate('tgl_selesai', '>=', Carbon::today()); // Belum selesai

        // Filter jika kategori dipilih
        if (!empty($kategori_id)) {
            $query->where('kategori_id', $kategori_id);
        }

        // Filter jika tingkat kesulitan dipilih (selain tanda '-')
        if (!empty($tingkat_kesulitan) && $tingkat_kesulitan !== '-') {
            $query->where('tingkat_kesulitan', $tingkat_kesulitan);
        }

        // Ambil hasil dengan pagination
        $kursus = $query->paginate(9);


        // Ambil tingkat kesulitan unik dari hasil kursus
        $uniqueTingkatKesulitan = Kursus::select('tingkat_kesulitan')
            ->whereIn('kursus_id', $kursus->pluck('kursus_id'))
            ->distinct()
            ->get();

        // Hitung rata-rata rating yang ternormalisasi
        foreach ($kursus as $item) {
            $totalRatings = $item->total_ratings ?? 0;
            $totalRatingSum = $item->total_rating_sum ?? 0;

            if ($totalRatings > 0) {
                $averageRating = $totalRatingSum / $totalRatings;
            } else {
                $averageRating = 0;
            }

            $normalizedRating = max(1, min(5, $averageRating));
            $item->average_rating = round($normalizedRating, 1);
        }

        // Ambil semua kategori untuk filter
        $kategori = Kategori::all();

        // Ambil daftar perusahaan
        $perusahaan = Pengguna::where('peran', 'Perusahaan')
            ->limit(10)
            ->get();


        return view('guest.DaftarKursus', [
            'kursus' => $kursus,
            'kategori' => $kategori,
            'uniqueTingkatKesulitan' => $uniqueTingkatKesulitan,
            'perusahaan' => $perusahaan,
        ]);
    }




    public function tentangKami()
    {
        return view('guest/TentangKami', []);
    }

    public function coursePage($id)
    {
        $kursus = Kursus::with(['jadwalKursus', 'pengguna', 'ratingKursus.pengguna'])
            ->findOrFail($id);

        $ratings = $kursus->ratingKursus()->inRandomOrder()->take(4)->get();

        $relatedCourses = Kursus::withAvg('ratingKursus', 'rating')
            ->withCount('ratingKursus')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('guest.CoursePage', compact('kursus', 'relatedCourses', 'ratings'));
    }



    public function paymentPage($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Ambil kursus yang terkait dengan pendaftaran
        $kursus = $pendaftaran->kursus;

        return view('guest.PaymentPage', [
            'pendaftaran_id' => $pendaftaran->pendaftaran_id,
            'total_pembayaran' => $kursus->harga ?? 0, // Harga kursus terkait
            'kursus' => $kursus, // Kirim data kursus ke view
            'pendaftaran' => $pendaftaran,
        ]);
    }


    public function daftarTransaksi()
    {
        $id = Auth::id(); // Ambil ID pengguna yang sedang login

        // Ambil pendaftaran yang terkait dengan pengguna yang sedang login
        $pendaftaran = Pendaftaran::with(['kursus.pengguna']) // Memuat relasi kursus dan pengguna (pelatih)
            ->where('pengguna_id', $id) // Filter berdasarkan peserta yang login
            ->paginate(10); // Paginate dengan ukuran 10 per halaman

        return view('guest.DaftarTransaksi', [
            'pendaftaran' => $pendaftaran,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'kursus_id' => 'required|exists:kursus,kursus_id',
        ]);

        // Cek apakah pengguna sudah pernah mendaftar di kursus ini
        $pendaftaranSebelumnya = Pendaftaran::where('pengguna_id', auth()->id())
            ->where('kursus_id', $validated['kursus_id'])
            ->where('status_pendaftaran', '!=', 'Selesai') // Hanya cek jika status belum "Selesai"
            ->first();

        if ($pendaftaranSebelumnya) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        // Cek apakah kapasitas kursus sudah penuh
        $kursus = Kursus::find($validated['kursus_id']);
        if ($kursus->pendaftaran->count() >= $kursus->kapasitas) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Kapasitas kursus telah penuh.');
        }

        // Jika lolos validasi, buat pendaftaran baru
        Pendaftaran::create([
            'pengguna_id' => auth()->id(),
            'kursus_id' => $validated['kursus_id'],
            'tgl_pendaftaran' => now(),
            'status_pendaftaran' => 'Aktif', // Default status
        ]);

        // Redirect dengan pesan sukses
        return redirect('/DaftarTransaksi')->with('success', 'Pendaftaran berhasil dilakukan!');
    }
}
