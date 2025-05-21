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
            $table->string('no_telepon');
            $table->text('alamat')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('kata_sandi');
            $table->string('foto_profil')->nullable();
            $table->enum('peran', ['Pelatih', 'Peserta', 'Admin'])->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable();
            $table->timestamps();
        });

        Schema::create('verifikasi', function (Blueprint $table) {
            $table->id('verifikasi_id');
            $table->unsignedBigInteger('pengguna_id'); // Gunakan unsignedBigInteger untuk foreign key
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->enum('status_verifikasi', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });

        // Tabel pelatih
        Schema::create('pelatih', function (Blueprint $table) {
            $table->id('pelatih_id');
            $table->unsignedBigInteger('pengguna_id')->nullable();
            $table->integer('tahun_pengalaman')->nullable();
            $table->integer('bulan_pengalaman')->nullable();
            $table->string('nama_spesialisasi')->nullable();
            $table->string('file_sertifikasi')->nullable();
            $table->timestamps();
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
        });

        // Tabel peserta
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('peserta_id');
            $table->unsignedBigInteger('pengguna_id')->nullable();
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
            $table->foreign('kursus_id')->references('kursus_id')->on('kursus')->onDelete('cascade');
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->timestamps();
        });


        // Tabel kurikulum
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->id('kurikulum_id');
            $table->unsignedBigInteger('kursus_id')->nullable();
            $table->string('nama_topik');
            $table->text('deskripsi');
            $table->integer('durasi');
            $table->string('materi')->nullable();
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

        Schema::create('rating_pelatih', function (Blueprint $table) {
            $table->id('rating_pelatih_id');
            $table->unsignedBigInteger('pemberi_id'); // Kolom untuk pemberi penilaian
            $table->unsignedBigInteger('pengguna_id'); // Kolom untuk penerima penilaian
            $table->float('rating');
            $table->text('komentar')->nullable();
            $table->foreign('pemberi_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna')->onDelete('cascade');
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
