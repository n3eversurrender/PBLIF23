<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaPelatihPesertaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Tabel pengguna
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('pengguna_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('kata_sandi');
            $table->string('foto_profil')->nullable();
            $table->enum('peran', ['Perusahaan', 'Peserta', 'Admin'])->nullable();
            $table->enum('status_verifikasi', ['Belum Diverifikasi', 'Sudah Diverifikasi', 'Ditolak'])
                ->default('Belum Diverifikasi')
                ->nullable();
            $table->timestamps();
        });

        // Tabel Perusahaa
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('perusahaan_id');
            $table->unsignedBigInteger('pengguna_id');  // FK ke pengguna (peran = Perusahaan)

            // Informasi umum spesifik
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('layanan')->nullable();  // Bisa JSON/text untuk daftar service

            // Informasi legal
            $table->string('npwp')->nullable();
            $table->string('akta_pendirian')->nullable();
            $table->string('izin_operasional')->nullable();
            $table->string('sertifikasi_bnsp')->nullable();

            // File dokumen pendukung (opsional)
            $table->string('file_npwp')->nullable();
            $table->string('file_akta_pendirian')->nullable();
            $table->string('file_izin_operasional')->nullable();
            $table->string('file_sertifikasi_bnsp')->nullable();

            $table->timestamps();

            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
        });

        Schema::create('foto_perusahaan', function (Blueprint $table) {
            $table->id('foto_id');
            $table->unsignedBigInteger('perusahaan_id');
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('perusahaan_id')->references('perusahaan_id')->on('perusahaan')->onDelete('cascade');
        });

        Schema::create('rating_perusahaan', function (Blueprint $table) {
            $table->id('rating_perusahaan_id');

            $table->unsignedBigInteger('pemberi_id')->nullable(); // pengguna yang memberi rating (misal peserta)
            $table->unsignedBigInteger('perusahaan_id'); // perusahaan yang dinilai

            $table->float('rating');
            $table->text('komentar')->nullable();
            $table->text('pred_label')->nullable();
            $table->string('ip_address')->nullable(); // untuk simpan IP reviewer

            $table->foreign('pemberi_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->foreign('perusahaan_id')->references('perusahaan_id')->on('perusahaan')->onDelete('cascade');

            // UNIQUE untuk mencegah double review
            $table->unique(['perusahaan_id', 'pemberi_id'], 'unique_review_user');
            $table->unique(['perusahaan_id', 'ip_address'], 'unique_review_ip');

            $table->timestamps();
        });

        // Tabel peserta
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('peserta_id');
            $table->unsignedBigInteger('pengguna_id')->nullable();

            $table->enum('status', ['Mahasiswa', 'Pekerja', 'Dosen', 'Lainnya'])->nullable();
            $table->enum('pendidikan', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])->nullable();

            $table->string('minat_bidang')->nullable();
            $table->json('bidang_saat_ini')->nullable();
            $table->json('kemampuan')->nullable(); 

            $table->integer('tahun_pengalaman')->nullable();
            $table->integer('bulan_pengalaman')->nullable();
            $table->string('nama_keahlian')->nullable();

            
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel kategori
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('nama_kategori')->unique();
            $table->timestamps();
        });

        // Tabel kursus dengan relasi ke kategori
        Schema::create('kursus', function (Blueprint $table) {
            $table->id('kursus_id');
            $table->unsignedBigInteger('pengguna_id');  // Jika pengguna_id harus ada
            $table->unsignedBigInteger('kategori_id');  // Tidak nullable jika ingin memastikan setiap kursus memiliki kategori
            $table->string('judul');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->enum('tingkat_kesulitan', ['-', 'Pemula', 'Menengah', 'Lanjutan'])->default('-');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Tidak Aktif');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('kapasitas');
            $table->string('lokasi');
            $table->string('foto_kursus')->nullable();
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori')->onDelete('cascade'); // Relasi ke kategori
            $table->timestamps();
        });

        Schema::create('rating_kursus', function (Blueprint $table) {
            $table->id('rating_kursus_id');
            $table->unsignedBigInteger('kursus_id')->nullable();
            $table->unsignedBigInteger('pengguna_id')->nullable();
            $table->float('rating')->nullable();
            $table->text('komentar')->nullable();
            $table->text('pred_label')->nullable();
            $table->foreign('kursus_id')->references('kursus_id')->on('kursus')->onDelete('cascade');
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peserta_id');
            $table->unsignedBigInteger('kursus_id');
            $table->float('score')->default(0);
            $table->timestamps();

            $table->foreign('peserta_id')->references('peserta_id')->on('peserta')->onDelete('cascade');
            $table->foreign('kursus_id')->references('kursus_id')->on('kursus')->onDelete('cascade');
        });


        // Tabel jadwal
        Schema::create('jadwal_kursus', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->unsignedBigInteger('kursus_id')->nullable();

            $table->string('sesi');
            $table->date('tanggal');
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->string('lokasi');

            $table->foreign('kursus_id')->references('kursus_id')->on('kursus')->onDelete('cascade');
            $table->timestamps();
        });


        // Tabel pendaftaran
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('pendaftaran_id');
            $table->unsignedBigInteger('pengguna_id')->nullable();
            $table->unsignedBigInteger('kursus_id')->nullable();
            $table->date('tgl_pendaftaran');
            $table->enum('status_pendaftaran', ['Menunggu', 'Aktif', 'Selesai', 'Dibatalkan'])->default('Menunggu');
            $table->enum('status_pembayaran', ['Pending', 'Berhasil', 'Gagal']);
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->foreign('kursus_id')->references('kursus_id')->on('kursus')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel pembayaran
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('pembayaran_id');
            $table->unsignedBigInteger('pendaftaran_id')->nullable();
            $table->date('tgl_pembayaran');
            $table->enum('metode_pembayaran', ['Bank Transfer', 'Credit Card', 'E-Wallet', 'Midtrans']);
            $table->decimal('jumlah', 10, 2);
            $table->enum('status', ['Pending', 'Berhasil', 'Gagal']); // Status dari transaksi lokal
            $table->string('midtrans_order_id')->nullable(); // ID pesanan unik dari Midtrans
            $table->string('midtrans_transaction_id')->nullable(); // ID transaksi unik dari Midtrans
            $table->string('midtrans_status')->nullable(); // Status transaksi dari Midtrans
            $table->text('midtrans_response')->nullable(); // JSON response dari Midtrans
            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel sertifikat
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id('sertifikat_id');
            $table->unsignedBigInteger('pendaftaran_id')->nullable();
            $table->unsignedBigInteger('kursus_id')->nullable();
            $table->string('nama_kursus');
            $table->string('file_sertifikat');
            $table->string('nomor_sertifikat');
            $table->date('tanggal_terbit');
            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran')->onDelete('cascade')->nullable();
            $table->foreign('kursus_id')->references('kursus_id')->on('kursus')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel umpan balik
        Schema::create('umpan_balik', function (Blueprint $table) {
            $table->id('umpan_balik_id');
            $table->string('nama_komentar');
            $table->text('komentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifikasi');
        Schema::dropIfExists('umpan_balik');
        Schema::dropIfExists('sertifikat');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('pendaftaran');
        Schema::dropIfExists('kurikulum');
        Schema::dropIfExists('kursus');
        Schema::dropIfExists('keahlian');
        Schema::dropIfExists('spesialisasi');
        Schema::dropIfExists('peserta');
        Schema::dropIfExists('pelatih');
        Schema::dropIfExists('rating_pelatih');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('sub_kategori');
        Schema::dropIfExists('kategori');
    }
}
