<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Pendaftaran;
use App\Models\RatingKursus;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PerusahaanController extends Controller
{
    public function statistikPerusahaan()
    {
        $penggunaId = Auth::user()->pengguna_id;

        $kursusIdSaya = Kursus::where('pengguna_id', $penggunaId)->pluck('kursus_id');

        // Pendaftaran dengan status "Berhasil"
        $pendaftaranBerhasil = Pendaftaran::with('kursus')
            ->whereIn('kursus_id', $kursusIdSaya)
            ->where('status_pembayaran', 'Berhasil');

        $now = Carbon::now();
        $bulanIni = $now->month;
        $tahunIni = $now->year;

        // 💰 Pendapatan Bulan Ini
        $pendapatanBulanIni = (clone $pendaftaranBerhasil)
            ->whereMonth('tgl_pendaftaran', $bulanIni)
            ->whereYear('tgl_pendaftaran', $tahunIni)
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        // 💰 Pendapatan Tahun Ini
        $pendapatanTahunIni = (clone $pendaftaranBerhasil)
            ->whereYear('tgl_pendaftaran', $tahunIni)
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        // 📈 Pendapatan Bulan Lalu
        $bulanLalu = $now->copy()->subMonth();
        $pendapatanBulanLalu = (clone $pendaftaranBerhasil)
            ->whereMonth('tgl_pendaftaran', $bulanLalu->month)
            ->whereYear('tgl_pendaftaran', $bulanLalu->year)
            ->get()
            ->sum(fn($item) => $item->kursus->harga ?? 0);

        // 📊 Growth %
        if ($pendapatanBulanLalu == 0) {
            $growth = $pendapatanBulanIni > 0 ? 100 : 0;
        } else {
            $growth = (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100;
        }

        // Data statistik lain...
        $jumlahKursusAktif = Kursus::where('status', 'Aktif')
            ->where('pengguna_id', $penggunaId)->count();

        $totalPeserta = Pendaftaran::whereIn('kursus_id', $kursusIdSaya)->count();

        $ratingRataRata = RatingKursus::whereIn('kursus_id', $kursusIdSaya)->avg('rating') ?? 0;

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
