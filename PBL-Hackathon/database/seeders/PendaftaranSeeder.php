<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PendaftaranSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Untuk menyimpan data pendaftaran
        $pendaftaran = [];

        // Loop untuk pengguna ID 3 sampai 312
        foreach (range(3, 312) as $pengguna_id) {
            // Pilih jumlah kursus yang akan diikuti oleh pengguna (antara 4 hingga 7 kursus)
            $kursus_count = rand(4, 7);

            // Ambil kursus ID acak
            $kursus_ids = $faker->unique()->randomElements(range(1, 50), $kursus_count);

            // Generate pendaftaran untuk setiap kursus yang dipilih
            foreach ($kursus_ids as $kursus_id) {
                $tgl_pendaftaran = $faker->date(); // Tanggal pendaftaran acak
                $status_pendaftaran = 'Aktif';
                $status_pembayaran = 'Berhasil';

                // Pastikan pengguna yang sama tidak mendaftar kursus yang sama lebih dari sekali
                if (!in_array(['pengguna_id' => $pengguna_id, 'kursus_id' => $kursus_id], $pendaftaran)) {
                    $pendaftaran[] = [
                        'pengguna_id' => $pengguna_id,
                        'kursus_id' => $kursus_id,
                        'tgl_pendaftaran' => $tgl_pendaftaran,
                        'status_pendaftaran' => $status_pendaftaran,
                        'status_pembayaran' => $status_pembayaran,
                    ];
                }
            }
        }

        // Insert pendaftaran ke tabel
        DB::table('pendaftaran')->insert($pendaftaran);
    }
}
