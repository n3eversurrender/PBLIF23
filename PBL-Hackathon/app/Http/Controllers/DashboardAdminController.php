<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Pengguna;
use App\Models\Pembayaran;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function dashboardAdmin()
    {
        // Hitung total pengguna
        $totalPengguna = Pengguna::count();

        // Hitung total perusahaan
        $totalPerusahaan = Pengguna::where('peran', 'Perusahaan')->count();

        // Hitung total peserta
        $totalPeserta = Pengguna::where('peran', 'Peserta')->count();

        // Hitung total pemasukan hari ini
        $totalPemasukanHariIni = Pembayaran::whereDate('tgl_pembayaran', Carbon::today())->sum('jumlah');

        // Hitung total pemasukan kemarin
        $totalPemasukanKemarin = Pembayaran::whereDate('tgl_pembayaran', Carbon::yesterday())->sum('jumlah');

        // Hitung total pembayaran berhasil
        $totalPembayaran = Pembayaran::where('status', 'Berhasil')->sum('jumlah');

        // Hitung status verifikasi perusahaan
        $verifikasiMenunggu = Pengguna::where('peran', 'Perusahaan')
            ->where('status_verifikasi', 'Belum Diverifikasi')
            ->count();

        $verifikasiDisetujui = Pengguna::where('peran', 'Perusahaan')
            ->where('status_verifikasi', 'Sudah Diverifikasi')
            ->count();

        $verifikasiDitolak = Pengguna::where('peran', 'Perusahaan')
            ->where('status_verifikasi', 'Ditolak')
            ->count();

        // Hitung status verifikasi peserta
        $totalPerusahaanAktif = $verifikasiDisetujui;
        $totalPerusahaanTidakAktif = $verifikasiMenunggu;

        $totalPesertaAktif = Pengguna::where('peran', 'Peserta')
            ->where('status_verifikasi', 'Sudah Diverifikasi')
            ->count();

        $totalPesertaTidakAktif = Pengguna::where('peran', 'Peserta')
            ->where('status_verifikasi', 'Belum Diverifikasi')
            ->count();

        // Hitung pemasukan bulan ini dan bulan lalu
        $pemasukanBulanIni = Pembayaran::whereMonth('tgl_pembayaran', Carbon::now()->month)
            ->whereYear('tgl_pembayaran', Carbon::now()->year)
            ->sum('jumlah');

        $pemasukanBulanLalu = Pembayaran::whereMonth('tgl_pembayaran', Carbon::now()->subMonth()->month)
            ->whereYear('tgl_pembayaran', Carbon::now()->subMonth()->year)
            ->sum('jumlah');

        // Hitung growth
        $growth = 0;

        if ($pemasukanBulanLalu > 0) {
            $growth = (($pemasukanBulanIni - $pemasukanBulanLalu) / $pemasukanBulanLalu) * 100;
            $growth = $growth > 100 ? 100 : $growth;
        } elseif ($pemasukanBulanLalu == 0 && $pemasukanBulanIni > 0) {
            $growth = 100;
        } elseif ($pemasukanBulanLalu == 0 && $pemasukanBulanIni == 0) {
            $growth = 0;
        } elseif ($pemasukanBulanIni == 0) {
            $growth = -100;
        }

        $growth = round($growth, 2);

        // Hitung kursus
        $totalKursus = Kursus::count();
        $totalKursusAktif = Kursus::where('status', 'Aktif')->count();
        $totalKursusTidakAktif = Kursus::where('status', 'Tidak Aktif')->count();

        // Return view
        return view('Admin/DashboardAdmin', [
            'totalPengguna' => $totalPengguna,
            'totalPelatih' => $totalPerusahaan,
            'totalPeserta' => $totalPeserta,
            'totalPemasukanKemarin' => $totalPemasukanKemarin,
            'totalPemasukanHariIni' => $totalPemasukanHariIni,
            'totalPembayaran' => $totalPembayaran,
            'growth' => $growth,
            'verifikasiMenunggu' => $verifikasiMenunggu,
            'verifikasiDisetujui' => $verifikasiDisetujui,
            'verifikasiDitolak' => $verifikasiDitolak,
            'totalPelatihAktif' => $totalPerusahaanAktif,
            'totalPelatihTidakAktif' => $totalPerusahaanTidakAktif,
            'totalPesertaAktif' => $totalPesertaAktif,
            'totalPesertaTidakAktif' => $totalPesertaTidakAktif,
            'totalKursus' => $totalKursus,
            'totalKursusAktif' => $totalKursusAktif,
            'totalKursusTidakAktif' => $totalKursusTidakAktif,
        ]);
    }
}
