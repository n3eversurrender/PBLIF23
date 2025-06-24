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

class PerusahaanController extends Controller
{
    public function statistikPerusahaan()
    {
        $pengguna = Auth::user();
        $penggunaId = $pengguna->pengguna_id;

        // Ambil ID kursus yang dimiliki perusahaan ini
        $kursusIdSaya = Kursus::where('pengguna_id', $penggunaId)->pluck('kursus_id');

        // Ambil ID perusahaan
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
                'transaksiTerakhir' => collect(),
            ]);
        }

        $now = Carbon::now();
        $bulanIni = $now->month;
        $tahunIni = $now->year;
        $bulanLalu = $now->copy()->subMonth();

        $pendaftaranBerhasil = Pendaftaran::whereIn('kursus_id', $kursusIdSaya)
            ->where('status_pembayaran', 'Berhasil');

        // Pendapatan bulan ini
        $pendapatanBulanIni = (clone $pendaftaranBerhasil)
            ->whereMonth('tgl_pendaftaran', $bulanIni)
            ->whereYear('tgl_pendaftaran', $tahunIni)
            ->with('kursus')
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        // Pendapatan bulan lalu
        $pendapatanBulanLalu = (clone $pendaftaranBerhasil)
            ->whereMonth('tgl_pendaftaran', $bulanLalu->month)
            ->whereYear('tgl_pendaftaran', $bulanLalu->year)
            ->with('kursus')
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        // Pendapatan tahun ini
        $pendapatanTahunIni = (clone $pendaftaranBerhasil)
            ->whereYear('tgl_pendaftaran', $tahunIni)
            ->with('kursus')
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        // Growth % dibanding bulan lalu
        if ($pendapatanBulanLalu == 0) {
            $growth = $pendapatanBulanIni > 0 ? 100 : 0;
        } else {
            $growth = (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100;
        }

        // Statistik lainnya
        $jumlahKursusAktif = Kursus::where('pengguna_id', $penggunaId)
            ->where('status', 'Aktif')
            ->count();

        $totalPeserta = Pendaftaran::whereIn('kursus_id', $kursusIdSaya)->count();

        $ratingRataRata = RatingKursus::whereIn('kursus_id', $kursusIdSaya)->avg('rating') ?? 0;

        $ratingRataRataPerusahaan = 0;
        if ($perusahaanIdSaya->isNotEmpty()) {
            $ratingRataRataPerusahaan = RatingPerusahaan::whereIn('perusahaan_id', $perusahaanIdSaya)->avg('rating') ?? 0;
        }

        $kursusTerbaru = Kursus::where('pengguna_id', $penggunaId)
            ->latest()
            ->take(3)
            ->get();

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
            'transaksiTerakhir'
        ));
    }

    public function berandaPerusahaan()
    {
        return view('Perusahaan.BerandaPerusahaan');
    }
}
