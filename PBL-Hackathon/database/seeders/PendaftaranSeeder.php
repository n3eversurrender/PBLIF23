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

        $pendaftaran = [];
        for ($i = 8; $i <= 200; $i++) {
            $kursus_id = rand(1, 30); // Kursus ID acak antara 1 dan 30
            $tgl_pendaftaran = $faker->date(); // Tanggal pendaftaran acak
            $status_pendaftaran = 'Aktif';
            $status_pembayaran = 'Berhasil';

            // Pastikan pengguna yang sama tidak mendaftar kursus yang sama lebih dari sekali
            if (!in_array(['pengguna_id' => $i, 'kursus_id' => $kursus_id], $pendaftaran)) {
                $pendaftaran[] = [
                    'pengguna_id' => $i,
                    'kursus_id' => $kursus_id,
                    'tgl_pendaftaran' => $tgl_pendaftaran,
                    'status_pendaftaran' => $status_pendaftaran,
                    'status_pembayaran' => $status_pembayaran,
                ];
            }
        }

        DB::table('pendaftaran')->insert($pendaftaran);
    }
}
