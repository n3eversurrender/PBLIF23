<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use App\Models\RatingKursus; // Model untuk rating kursus
use App\Models\RatingPelatih; // Model untuk rating pelatih
use Illuminate\Support\Facades\Auth;

class DashboardPelatihController extends Controller
{
    public function dashboardPelatih()
    {
        $id = Auth::id();

        // Ambil kursus milik pelatih yang sedang login dengan status "Aktif"
        $kursusAktif = Kursus::where('pengguna_id', $id)
            ->where('status', 'Aktif')
            ->paginate(10);

        // Hitung jumlah kursus "Tidak Aktif"
        $kursusTidakAktif = Kursus::where('pengguna_id', $id)
            ->where('status', 'Tidak Aktif')
            ->count();

        // Ambil status pendaftaran peserta (menunggu, aktif, selesai) dalam satu query
        $pendaftaranStatus = Pendaftaran::whereHas('kursus', function ($query) use ($id) {
            $query->where('pengguna_id', $id);
        })->selectRaw('status_pendaftaran, COUNT(*) as total')
            ->groupBy('status_pendaftaran')
            ->pluck('total', 'status_pendaftaran');

        $menunggu = $pendaftaranStatus['Menunggu'] ?? 0;
        $aktif = $pendaftaranStatus['Aktif'] ?? 0;
        $selesai = $pendaftaranStatus['Selesai'] ?? 0;

        // Ambil 2 kursus secara acak yang dimiliki oleh pelatih yang sedang login
        $kursusRandom = Kursus::where('pengguna_id', $id)
            ->inRandomOrder()  // Ambil kursus secara acak
            ->limit(2)         // Batasi hanya 2 kursus
            ->get();           // Ambil data tanpa paginate

        // Tambahkan hitung jumlah peserta yang terdaftar dan rata-rata rating pada setiap kursus
        foreach ($kursusRandom as $kursus) {
            // Menghitung jumlah peserta yang terdaftar
            $kursus->jumlah_pendaftar = Pendaftaran::where('kursus_id', $kursus->kursus_id)
                ->where('status_pendaftaran', '!=', 'Dibatalkan')
                ->count();

            // Menghitung rata-rata rating kursus
            $kursus->rating_avg = RatingKursus::where('kursus_id', $kursus->kursus_id)
                ->avg('rating') ?: 0;  // Jika tidak ada rating, set ke 0
        }


        // Menghitung rata-rata rating kursus
        $ratingPengguna = RatingKursus::whereHas('kursus', function ($query) use ($id) {
            $query->where('pengguna_id', $id); // Menyaring kursus yang dibuat oleh pengguna dengan ID tertentu
        })->avg('rating');  // Mengambil rata-rata rating untuk kursus

        // Menghitung rata-rata rating pelatih
        $ratingPelatih = RatingPelatih::where('pemberi_id', $id)->avg('rating');  // Mengambil rata-rata rating untuk pelatih

        // Return data ke view
        return view('pelatih.DashboardPelatih', [
            'kursusAktif' => $kursusAktif,
            'kursusTidakAktif' => $kursusTidakAktif,
            'menunggu' => $menunggu,
            'aktif' => $aktif,
            'selesai' => $selesai,
            'kursusRandom' => $kursusRandom,
            'ratingKursus' => $ratingPengguna,
            'ratingPelatih' => $ratingPelatih,
        ]);
    }
}
