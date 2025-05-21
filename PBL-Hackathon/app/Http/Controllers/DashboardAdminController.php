<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Pembayaran;
use App\Models\Verifikasi; // Pastikan model Verifikasi diimport
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function dashboardAdmin()
    {
        // Hitung total pengguna
        $totalPengguna = Pengguna::count();

        // Hitung total pelatih
        $totalPelatih = Pengguna::where('peran', 'Pelatih')->count();

        // Hitung total peserta
        $totalPeserta = Pengguna::where('peran', 'Peserta')->count();

        // Hitung total pemasukan berdasarkan tanggal hari ini
        $totalPemasukanHariIni = Pembayaran::whereDate('tgl_pembayaran', Carbon::today())->sum('jumlah');

        // Hitung total pemasukan kemarin
        $totalPemasukanKemarin = Pembayaran::whereDate('tgl_pembayaran', Carbon::yesterday())->sum('jumlah');

        // Hitung total pembayaran berhasil
        $totalPembayaran = Pembayaran::where('status', 'Berhasil')->sum('jumlah'); // Jumlah pembayaran berhasil

        // Hitung verifikasi pelatih
        $verifikasiMenunggu = Verifikasi::whereHas('pengguna', function ($query) {
            $query->where('peran', 'Pelatih');
        })->where('status_verifikasi', 'Menunggu')->count();

        $verifikasiDisetujui = Verifikasi::whereHas('pengguna', function ($query) {
            $query->where('peran', 'Pelatih');
        })->where('status_verifikasi', 'Disetujui')->count();

        $verifikasiDitolak = Verifikasi::whereHas('pengguna', function ($query) {
            $query->where('peran', 'Pelatih');
        })->where('status_verifikasi', 'Ditolak')->count();

        // Hitung total Pelatih Aktif
        $totalPelatihAktif = Pengguna::where('peran', 'Pelatih')
            ->where('status', 'Aktif')
            ->count();

        // Hitung total Peserta Aktif
        $totalPesertaAktif = Pengguna::where('peran', 'Peserta')
            ->where('status', 'Aktif')
            ->count();

        // Hitung total Pelatih Tidak Aktif
        $totalPelatihTidakAktif = Pengguna::where('peran', 'Pelatih')
            ->where('status', 'Tidak Aktif')
            ->count();

        // Hitung total Peserta Tidak Aktif
        $totalPesertaTidakAktif = Pengguna::where('peran', 'Peserta')
            ->where('status', 'Tidak Aktif')
            ->count();

        // Hitung pemasukan bulan ini dan bulan lalu
        $pemasukanBulanIni = Pembayaran::whereMonth('tgl_pembayaran', Carbon::now()->month)
            ->whereYear('tgl_pembayaran', Carbon::now()->year)
            ->sum('jumlah');

        $pemasukanBulanLalu = Pembayaran::whereMonth('tgl_pembayaran', Carbon::now()->subMonth()->month)
            ->whereYear('tgl_pembayaran', Carbon::now()->subMonth()->year)
            ->sum('jumlah');

        // Default growth
        $growth = 0;

        if ($pemasukanBulanLalu > 0) {
            // Jika ada pemasukan bulan lalu, hitung growth seperti biasa
            $growth = (($pemasukanBulanIni - $pemasukanBulanLalu) / $pemasukanBulanLalu) * 100;

            // Batasi growth maksimal 100% untuk presentasi
            $growth = $growth > 100 ? 100 : $growth;
        } elseif ($pemasukanBulanLalu == 0 && $pemasukanBulanIni > 0) {
            // Jika bulan lalu 0 dan bulan ini ada pemasukan, growth dianggap 100%
            $growth = 100;
        } elseif ($pemasukanBulanLalu == 0 && $pemasukanBulanIni == 0) {
            // Jika bulan lalu dan bulan ini sama-sama 0, growth = 0%
            $growth = 0;
        } elseif ($pemasukanBulanIni == 0) {
            // Jika bulan ini 0 tetapi bulan lalu ada pemasukan, growth = -100%
            $growth = -100;
        }

        $growth = round($growth, 2); // Pembulatan ke 2 desimal

        $totalKursus = Kursus::count();
        $totalKursusAktif = Kursus::where('status', 'Aktif')->count();
        $totalKursusTidakAktif = Kursus::where('status', 'Tidak Aktif')->count();

        // Kirim data ke view
        return view('Admin/DashboardAdmin', [
            'totalPengguna' => $totalPengguna,
            'totalPelatih' => $totalPelatih,
            'totalPeserta' => $totalPeserta,
            'totalPemasukanKemarin' => $totalPemasukanKemarin,
            'totalPemasukanHariIni' => $totalPemasukanHariIni,
            'totalPembayaran' => $totalPembayaran,
            'growth' => $growth, // Mengirimkan persentase growth
            'verifikasiMenunggu' => $verifikasiMenunggu,
            'verifikasiDisetujui' => $verifikasiDisetujui,
            'verifikasiDitolak' => $verifikasiDitolak,
            'totalPelatihAktif' => $totalPelatihAktif,
            'totalPesertaAktif' => $totalPesertaAktif,
            'totalPelatihTidakAktif' => $totalPelatihTidakAktif,
            'totalPesertaTidakAktif' => $totalPesertaTidakAktif,
            'totalKursus' => $totalKursus,
            'totalKursusAktif' => $totalKursusAktif,
            'totalKursusTidakAktif' => $totalKursusTidakAktif,
        ]);
    }
}
