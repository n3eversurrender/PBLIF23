<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Panggil semua seeder yang telah dibuat
        $this->call([
            PenggunaSeeder::class,
            PerusahaanSeeder::class,
            PesertaSeeder::class,
            KategoriSeeder::class,
            KursusSeeder::class,
            JadwalKursusSeeder::class,
            PendaftaranSeeder::class,
            RatingPerusahaanSeeder::class,
            RatingKursusSeeder::class,
            UmpanBalikSeeder::class,
            FotoPerusahaanSeeder::class,
        ]);
    }
}
