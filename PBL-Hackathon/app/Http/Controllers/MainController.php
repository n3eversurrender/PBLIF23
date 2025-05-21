<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use App\Models\Pengguna;
use App\Models\UmpanBalik;
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
        // Ambil maksimal 3 data dari tabel 'umpan_balik'
        $data = UmpanBalik::paginate(3);

        // Ambil data pelatih dengan rata-rata rating tertinggi
        $dataPelatih = Pengguna::where('peran', 'Pelatih')
            ->withAvg('ratingsPelatih', 'rating') // Menghitung rata-rata rating menggunakan relasi
            ->orderBy('ratings_pelatih_avg_rating', 'desc') // Urutkan berdasarkan rata-rata rating tertinggi
            ->take(5)
            ->get();

        // Kirim data ke view
        return view('guest.Home', compact('data', 'dataPelatih'));
    }

    public function daftarKursus(Request $request)
    {
        $kategori_id = $request->input('kategori_id'); // Ambil kategori yang dipilih
        $tingkat_kesulitan = $request->input('tingkat_kesulitan'); // Ambil tingkat kesulitan yang dipilih

        // Query dasar untuk mengambil kursus
        $query = Kursus::with(['kategori', 'ratingKursus']) // Pastikan nama relasi sesuai
            ->withAvg('ratingKursus as average_rating', 'rating') // Ambil rata-rata rating
            ->where('status', 'Aktif'); // Filter berdasarkan status

        // Filter berdasarkan kategori jika ada
        if ($kategori_id) {
            $query->where('kategori_id', $kategori_id);
        }

        // Filter berdasarkan tingkat kesulitan jika ada dan tidak default "-"
        if ($tingkat_kesulitan && $tingkat_kesulitan !== '-') {
            $query->where('tingkat_kesulitan', $tingkat_kesulitan);
        }

        // Paginate hasil query
        $kursus = $query->paginate(9);

        // Ambil daftar tingkat kesulitan unik dari data kursus yang ada
        $uniqueTingkatKesulitan = Kursus::select('tingkat_kesulitan')
            ->whereIn('kursus_id', $kursus->pluck('kursus_id')) // Hanya ambil tingkat kesulitan yang relevan dengan kursus yang dipilih
            ->distinct()
            ->get();

        // Ambil data kategori untuk ditampilkan di filter
        $kategori = Kategori::all();

        // Kirim data ke view
        return view('guest.DaftarKursus', [
            'kursus' => $kursus,
            'kategori' => $kategori,
            'uniqueTingkatKesulitan' => $uniqueTingkatKesulitan,
        ]);
    }

    public function tentangKami()
    {
        return view('guest/TentangKami', []);
    }

    public function coursePage($id)
    {
        // Fetch kursus berdasarkan ID dengan relasi kurikulum dan rating
        $kursus = Kursus::with(['kurikulum', 'ratingKursus.pengguna'])
            ->findOrFail($id);

        // Ambil rating yang diacak secara acak dari database dan lakukan pagination
        $ratings = $kursus->ratingKursus()->inRandomOrder()->paginate(4); // Mengacak rating dan melakukan pagination

        // Ambil kursus terkait secara acak
        $relatedCourses = Kursus::inRandomOrder()->take(4)->get();

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
            'status_pendaftaran' => 'Menunggu', // Default status
        ]);

        // Redirect dengan pesan sukses
        return redirect('/DaftarTransaksi')->with('success', 'Pendaftaran berhasil dilakukan!');
    }
}
