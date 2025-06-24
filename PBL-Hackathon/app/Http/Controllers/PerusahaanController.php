<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use App\Models\Perusahaan;
use App\Models\RatingKursus;
use App\Models\RatingPerusahaan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProsesAnalisisKomentarJob;


class PerusahaanController extends Controller
{
    public function statistikPerusahaan()
    {
        $pengguna = Auth::user();
        $penggunaId = $pengguna->pengguna_id;

        $kursusIdSaya = Kursus::where('pengguna_id', $penggunaId)->pluck('kursus_id');
        $perusahaanIdSaya = Perusahaan::where('pengguna_id', $penggunaId)->pluck('perusahaan_id');

        if ($kursusIdSaya->isEmpty()) {
            return view('Perusahaan.Statistik', [
                'jumlahKursusAktif' => 0,
                'totalPeserta' => 0,
                'ratingRataRata' => 0,
                'ratingRataRataPerusahaan' => 0,
                'pendapatanBulanIni' => 0,
                'pendapatanTahunIni' => 0,
                'growth' => 0,
                'kursusTerbaru' => collect(),
                'transaksiTerakhir' => collect()
            ]);
        }

        $now = Carbon::now();
        $bulanIni = $now->month;
        $tahunIni = $now->year;
        $bulanLalu = $now->copy()->subMonth();

        $pendaftaranBerhasil = Pendaftaran::whereIn('kursus_id', $kursusIdSaya)
            ->where('status_pembayaran', 'Berhasil');

        $pendapatanBulanIni = (clone $pendaftaranBerhasil)
            ->whereMonth('tgl_pendaftaran', $bulanIni)
            ->whereYear('tgl_pendaftaran', $tahunIni)
            ->with('kursus')
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        $pendapatanBulanLalu = (clone $pendaftaranBerhasil)
            ->whereMonth('tgl_pendaftaran', $bulanLalu->month)
            ->whereYear('tgl_pendaftaran', $bulanLalu->year)
            ->with('kursus')
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        $pendapatanTahunIni = (clone $pendaftaranBerhasil)
            ->whereYear('tgl_pendaftaran', $tahunIni)
            ->with('kursus')
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        $growth = ($pendapatanBulanLalu == 0)
            ? ($pendapatanBulanIni > 0 ? 100 : 0)
            : (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100;

        $jumlahKursusAktif = Kursus::where('pengguna_id', $penggunaId)->where('status', 'Aktif')->count();
        $totalPeserta = Pendaftaran::whereIn('kursus_id', $kursusIdSaya)->count();
        $ratingRataRata = RatingKursus::whereIn('kursus_id', $kursusIdSaya)->avg('rating') ?? 0;
        $ratingRataRataPerusahaan = $perusahaanIdSaya->isNotEmpty()
            ? RatingPerusahaan::whereIn('perusahaan_id', $perusahaanIdSaya)->avg('rating') ?? 0
            : 0;

        $kursusTerbaru = Kursus::where('pengguna_id', $penggunaId)->latest()->take(3)->get();
        $transaksiTerakhir = Pendaftaran::with('kursus')
            ->whereIn('kursus_id', $kursusIdSaya)
            ->where('status_pembayaran', 'Berhasil')
            ->latest()
            ->take(5)
            ->get();

        return view('Perusahaan.Statistik', compact(
            'jumlahKursusAktif',
            'totalPeserta',
            'ratingRataRata',
            'ratingRataRataPerusahaan',
            'pendapatanBulanIni',
            'pendapatanTahunIni',
            'growth',
            'kursusTerbaru',
            'transaksiTerakhir',
        ));
    }


    public function berandaPerusahaan()
    {
        return view('Perusahaan.BerandaPerusahaan');
    }

    // public function analisisKomentar()
    // {
    //     $pengguna_id = Auth::user()->pengguna_id;

    //     // Panggil Python API langsung kirim pengguna_id
    //     $response = Http::timeout(120)->post('http://127.0.0.1:9999/proses-ulasan-realtime', [
    //         'pengguna_id' => $pengguna_id
    //     ]);

    //     if ($response->successful()) {
    //         $hasilAnalisis = $response->json();
    //         return view('Perusahaan.AnalisisKomentar', [
    //             'hasilAnalisis' => $hasilAnalisis,
    //             'message' => null
    //         ]);
    //     } else {
    //         return view('Perusahaan.AnalisisKomentar', [
    //             'hasilAnalisis' => [],
    //             'message' => 'Gagal memproses analisis komentar. Silakan coba lagi.'
    //         ]);
    //     }
    // }
}
