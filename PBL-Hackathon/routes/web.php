<?php

use App\Http\Controllers\AnalisisKomentarController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ManajemenAkunController;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProsesAnalisisKomentarJob;


use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataPelatihController;
use App\Http\Controllers\DataPesertaController;
use App\Http\Controllers\DataRiwayatTransaksiController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\PesanAdminController;
use App\Http\Controllers\DaftarPelatihanController;
use App\Http\Controllers\DashboardPelatihController;
use App\Http\Controllers\DashboardPesertaController;
use App\Http\Controllers\DataKategoriController;
use App\Http\Controllers\DataKursusController;
use App\Http\Controllers\DataSertifikatController;
use App\Http\Controllers\DataUmpanBalikController;
use App\Http\Controllers\PengaturanPelatihController;
use App\Http\Controllers\PengaturanPesertaController;
use App\Http\Controllers\PengelolaanKursusController;
use App\Http\Controllers\PengelolaanPelatihanController;
use App\Http\Controllers\PengelolaanSertifikatController;
use App\Http\Controllers\PesanPelatihController;
use App\Http\Controllers\PesanPesertaController;
use App\Http\Controllers\TambahKursusController;
use App\Http\Controllers\PesertaKursusController;
use App\Http\Controllers\DetailPesertaKursusController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\LoginPenggunaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PengelolaanKurikulumController;
use App\Http\Controllers\PenilaianKursusController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\UmpanBalikController;
use App\Http\Middleware\PeranMiddleware;
use App\Http\Controllers\SkillMatchingController;
use App\Http\Controllers\BerandaTraineeController;
use App\Http\Controllers\DashboardRatingPerusahaanController;
use App\Http\Controllers\DataPerusahaanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DetailRiwayatController;

use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\ProfilPerusahaanController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KursusPerushaanController;
use App\Models\SkillMatching;

// Route Default
Route::get('/', function () {
    return redirect('/Home');
});

// Skill Matching
Route::get('/SkillMatching', function () {
    return view('SkillMatching');
});

// lupa kata sandi
Route::get('/lupasandi', function () {
    return view('guest.LupaKataSandi');
});


Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'reset'])->name('password.update');




// konfirmasi kata sandi
Route::get('/konfirmasi', function () {
    return view('guest.KonfirmasiKataSandi');
});



// perubahan end

// Route Layout
Route::get('/Main', [MainController::class, 'Main']);
Route::get('/MainAdmin', [MainAdminController::class, 'mainAdmin']);
Route::get('/MainPeserta', [MainController::class, 'mainPeserta']);
Route::get('/MainPelatih', [MainController::class, 'mainPelatih']);

// Route Web Skill Bridge
Route::get('/Home', [MainController::class, 'Home'])->name('home');;
Route::get('/DaftarKursus', [MainController::class, 'daftarKursus'])->name('daftarKursus');
Route::get('/TentangKami', [MainController::class, 'tentangKami']);
Route::get('/Daftar', [ManajemenAkunController::class, 'Daftar']);
Route::post('/pengguna/store', [ManajemenAkunController::class, 'store'])->name('pengguna.store');


Route::get('/Masuk', [ManajemenAkunController::class, 'Masuk'])->name('Masuk');
Route::get('/Masuk/google', [LoginPenggunaController::class, 'handleLoginGoogle'])->name('Masuk.google');
Route::get('/auth/google/callback', [LoginPenggunaController::class, 'handleLoginGoogleCalback'])->name('Masuk.google.callback');


Route::get('/CoursePage/{kursus_id}', [MainController::class, 'coursePage'])->name('coursePage');
Route::get('/DaftarTransaksi', [MainController::class, 'daftarTransaksi'])->name('daftarTransaksi');
Route::post('/DaftarPendaftaran', [MainController::class, 'store']);

Route::get('/PaymentPage/{id}', [MainController::class, 'paymentPage'])->name('PaymentPage');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');
Route::post('/payment/update-status', [PaymentController::class, 'updatePaymentStatus'])->name('updatePaymentStatus');
Route::post('/umpan-balik', [UmpanBalikController::class, 'store'])->name('umpan_balik.store');
Route::post('/rekomendasi', [RekomendasiController::class, 'getRecommendation'])->name('rekomendasi');
Route::get('/detailProfil/{id}', [GuestController::class, 'detailProfilPerusahaan'])->name('DetailProfilPerusahaan');
Route::post('/rating-perusahaan/{perusahaan}', [GuestController::class, 'store'])->name('ratingPerusahaan.store');


Route::post('/Masuk', [LoginPenggunaController::class, 'login'])->name('login');

// Route Peserta
Route::middleware(['auth', PeranMiddleware::class . ':Peserta'])->group(function () {
    Route::post('/logoutPeserta', [LoginPenggunaController::class, 'logoutPeserta'])->name('logoutPeserta');
    Route::get('/DashboardPeserta', [DashboardPesertaController::class, 'dashboardPeserta'])->name('DashboardPeserta');
    Route::get('/BerandaTrainee', [BerandaTraineeController::class, 'berandaTrainee'])->name('BerandaTrainee');
    Route::get('/Riwayat', [RiwayatController::class, 'riwayat'])->name('Riwayat');
    Route::get('/DetailRiwayat/{id}', [DetailRiwayatController::class, 'detailRiwayat'])->name('DetailRiwayat');
    Route::post('/ulasan/{id}', [DetailRiwayatController::class, 'submitUlasan'])->name('ulasan.submit');

    Route::get('/SkillMatching', [SkillMatchingController::class, 'view'])->name('SkillMatching');
    Route::get('/RekomendasiSaya', [SkillMatchingController::class, 'rekomendasiSaya'])->name('rekomendasiSaya');
    Route::post('/peserta/skillmatching', [SkillMatchingController::class, 'skillmatching'])->name('peserta.skillmatching');


    Route::get('/Profil', [ProfilController::class, 'profil'])->name('Profil');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profile.update');
    Route::get('/Kursus', [KursusController::class, 'Kursus']);
    Route::get('/KursusModul/{id_kursus}', [KursusController::class, 'kursusModul'])->name('kursusModul.show');
    Route::get('/KursusMateri', [KursusController::class, 'kursusMateri'])->name('kursusMateri');
    Route::get('/PenilaianKursus', [PenilaianKursusController::class, 'penilaianKursus']);
    Route::post('/submit-rating', [PenilaianKursusController::class, 'submitRating'])->name('submit.rating');


    Route::get('/PengaturanPeserta', [PengaturanPesertaController::class, 'pengaturanPeserta'])->name('PengaturanPeserta');
    Route::post('/peserta/store', [PengaturanPesertaController::class, 'storePeserta'])->name('peserta.store');
    Route::put('/peserta/update', [PengaturanPesertaController::class, 'updatePeserta'])->name('peserta.update');

    Route::put('/peserta/{peserta_id}', [PengaturanPesertaController::class, 'updatePesertaKeahlian'])->name('pesertaKeahlian.update');
    Route::delete('/peserta/{peserta_id}', [PengaturanPesertaController::class, 'destroyPeserta'])->name('peserta.destroy');

    Route::get('/DaftarPelatihan', [DaftarPelatihanController::class, 'daftarPelatihan']);
    Route::get('/daftar-pelatihan/{pendaftaran_id}/sertifikat', [DaftarPelatihanController::class, 'downloadSertifikat'])->name('DaftarPelatihan.sertifikat');
    Route::delete('/daftar-pelatihan/{pendaftaran_id}', [DaftarPelatihanController::class, 'destroy'])->name('DaftarPelatihan.destroy');

    Route::get('/DaftarPelatihan', [DaftarPelatihanController::class, 'daftarPelatihan']);
    Route::get('/daftar-pelatihan/sertifikat/{pendaftaran_id}', [DaftarPelatihanController::class, 'downloadSertifikat'])->name('DaftarPelatihan.sertifikat');
    Route::get('/daftar-pelatihan/{pendaftaran_id}/sertifikat', [DaftarPelatihanController::class, 'downloadSertifikat'])->name('DaftarPelatihan.sertifikat');
    Route::delete('/daftar-pelatihan/{pendaftaran_id}', [DaftarPelatihanController::class, 'destroy'])->name('DaftarPelatihan.destroy');
});


Route::middleware(['auth', PeranMiddleware::class . ':Perusahaan'])->group(function () {
    Route::post('/logoutPerusahaan', [LoginPenggunaController::class, 'logoutPerusahaan'])->name('logoutPerusahaan');

    //NEW
    Route::get('/statistik', [PerusahaanController::class, 'statistikPerusahaan'])->name('StatistikPerusahaan');
    Route::get('/perusahaan/analisis-komentar', [PerusahaanController::class, 'analisisKomentar'])->name('analisisKomentar');

    Route::post('/statistik/api/hasil-analisis', [AnalisisKomentarController::class, 'apiHasil']);



    // Beranda Perusahaan
    Route::get('/BerandaPerusahaan', [PerusahaanController::class, 'berandaPerusahaan'])->name('BerandaPerusahaan');
    // Route::get('/DashboardRating', [DashboardRatingPerusahaanController::class, 'dashboardRating'])->name('admin.dashboard.rating');


    // Landing Page
    Route::get('/LandingPage', [LandingPageController::class, 'landingPage'])->name('LandingPagePerusahaan');

    // Profil Perusahaan
    Route::get('/ProfilPerusahaan', [ProfilPerusahaanController::class, 'profilPerusahaan'])->name('ProfilPerusahaan');
    Route::get('/EditProfil', [ProfilPerusahaanController::class, 'editProfilPerusahaan'])->name('EditProfilPerusahaan');
    Route::put('/UpdateProfil', [ProfilPerusahaanController::class, 'updateProfil'])->name('UpdateProfilPerusahaan');
    Route::post('/perusahaan/kirim-verifikasi', [ProfilPerusahaanController::class, 'kirimVerifikasi'])->name('Perusahaan.kirimVerifikasi');



    // Kelola Galeri
    Route::get('/KelolaGaleri/{id}', [GaleriController::class, 'kelolaGaleri'])->name('KelolaGaleri');
    Route::post('/galeri/store', [GaleriController::class, 'store'])->name('galeri.store');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // Menampilkan halaman daftar kursus
    Route::get('/kursus', [KursusPerushaanController::class, 'indexKursus'])->name('KursusPerusahaan');
    Route::get('/tambahkursus', [KursusPerushaanController::class, 'tambahKursus'])->name('TambahKursus');
    Route::post('/tambahkursus', [KursusPerushaanController::class, 'simpanKursus'])->name('SimpanKursus');
    Route::get('/detailkursus/{id}', [KursusPerushaanController::class, 'detailKursus'])->name('DetailKursus');
    Route::delete('/hapuskursus/{id}', [KursusPerushaanController::class, 'hapusKursus'])->name('HapusKursus');
    Route::put('/kursus/{id}', [KursusPerushaanController::class, 'update'])->name('kursus.update');

    // Jadwal (semua)
    // Route untuk menampilkan jadwal kursus
    Route::get('/jadwal', [JadwalController::class, 'indexJadwal'])->name('JadwalPerusahaan');
    Route::get('/kelolajadwal/{kursus_id}', [JadwalController::class, 'kelolaJadwal'])->name('KelolaJadwal');
    Route::post('/kelolajadwal/update/{jadwal_id}', [JadwalController::class, 'updateJadwal'])->name('KelolaJadwal.update');
    Route::delete('/kelolajadwal/hapus/{jadwal_id}', [JadwalController::class, 'hapusJadwal'])->name('KelolaJadwal.hapus');
    Route::post('/kelolajadwal/simpan', [JadwalController::class, 'simpanJadwal'])->name('KelolaJadwal.simpan');


    // Ulasan
    Route::get('/ulasan', [UlasanController::class, 'indexUlasan'])->name('UlasanPerusahaan');
    Route::get('/detailulasan/{kursus_id}', [UlasanController::class, 'detailUlasan'])->name('DetailUlasan');
    Route::post('/ulasan/analisa/{kursus_id}', [UlasanController::class, 'analisaDSS'])->name('ulasan.analisa');
    Route::get('/ulasan/analisa/{kursus_id}', [UlasanController::class, 'analisaDistribusi'])->name('ulasan.analisa');
});

// Route Admin
Route::middleware(['auth', PeranMiddleware::class . ':Admin'])->group(function () {
    Route::post('/logoutAdmin', [LoginPenggunaController::class, 'logoutAdmin'])->name('logoutAdmin');
    Route::get('/DashboardAdmin', [DashboardAdminController::class, 'dashboardAdmin'])->name('dashboard');
    Route::get('/DataAdmin', [DataAdminController::class, 'dataAdmin'])->name('admin.index');
    Route::get('/TambahAdmin', [DataAdminController::class, 'tambahAdmin']);
    Route::post('/admin/store', [DataAdminController::class, 'store'])->name('admin.store');
    Route::put('/DataAdmin/{id}', [DataAdminController::class, 'update'])->name('PengelolaanAdmin.update');


    Route::get('/DataKategori', [DataKategoriController::class, 'dataKategori'])->name('DataKategori');
    Route::get('/TambahKategori', [DataKategoriController::class, 'tambahKategori'])->name('TambahKategori');
    Route::post('/TambahKategori/store', [DataKategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/TambahKategori/{kategori_id}', [DataKategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/DataKursus', [DataKursusController::class, 'dataKursus'])->name('DataKursus');
    Route::put('/DataKursus/{kursus_id}', [DataKursusController::class, 'update'])->name('kursus.update.admin');
    Route::delete('/kursus/{kursus_id}', [DataKursusController::class, 'destroy'])->name('kursus.destroy');

    Route::get('/DataPeserta', [DataPesertaController::class, 'dataPeserta'])->name('DataPeserta');
    Route::get('/DataPerusahaan', [DataPerusahaanController::class, 'dataPerusahaan'])->name('DataPerusahaan');
    Route::patch('/admin/verifikasi/konfirmasi/{pengguna_id}/{status}', [DataPerusahaanController::class, 'konfirmasiVerifikasi'])->name('admin.verifikasi.konfirmasi');
    Route::delete('/pengguna/{id}', [DataPerusahaanController::class, 'destroy'])->name('pengguna.destroy');

    Route::get('/TambahPerusahaan', [DataPerusahaanController::class, 'tambahPerusahaan'])->name('TambahPerusahaan');
    Route::post('/Perusahaan/store', [DataPerusahaanController::class, 'storePerusahaan'])->name('Perusahaan.store');


    Route::get('/DataRiwayatTransaksi', [DataRiwayatTransaksiController::class, 'dataRiwayatTransaksi'])->name('dataRiwayatTransaksi');
    Route::delete('/pembayaran/{pembayaran_id}', [DataRiwayatTransaksiController::class, 'destroy'])->name('pembayaran.destroy');

    Route::get('/DataSertifikat', [DataSertifikatController::class, 'dataSertifikat']);
    Route::delete('/deleteSertifikat/{sertifikat_id}', [DataSertifikatController::class, 'destroy'])->name('DataSertifikat.delete');
    Route::put('/update-sertifikat/{sertifikat_id}', [DataSertifikatController::class, 'update'])->name('sertifikatAdmin.update');

    Route::get('/DataUmpanBalik', [DataUmpanBalikController::class, 'dataUmpanBalik']);
    Route::delete('/DataUmpanBalik/{id}', [DataUmpanBalikController::class, 'destroy'])->name('UmpanBalik.destroy');
});
