<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JadwalKursusSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Loop untuk kursus ID 1 hingga 50
        foreach (range(1, 50) as $kursus_id) {
            // Tentukan jumlah sesi antara 4 hingga 10
            $jumlah_sesi = rand(4, 10);

            // Loop untuk menambah sesi pada kursus tertentu
            foreach (range(1, $jumlah_sesi) as $sesi) {
                DB::table('jadwal_kursus')->insert([
                    'kursus_id' => $kursus_id,  // ID kursus
                    'sesi' => "Sesi " . $sesi,  // Nama sesi (Sesi 1, Sesi 2, dst)
                    'tanggal' => $faker->date(), // Tanggal sesi acak
                    'jam_mulai' => '09:00:00',  // Jam mulai tetap (bisa diubah sesuai kebutuhan)
                    'jam_selesai' => '12:00:00', // Jam selesai tetap (bisa diubah sesuai kebutuhan)
                    'lokasi' => $faker->address, // Lokasi sesi acak
                    'created_at' => now(), // Waktu dibuat
                    'updated_at' => now(), // Waktu diperbarui
                ]);
            }
        }
    }
}
