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
            PelatihSeeder::class,
            PesertaSeeder::class,
            KategoriSeeder::class,
            KursusSeeder::class,
            KurikulumSeeder::class,
            PendaftaranSeeder::class,
            SertifikatSeeder::class,
            RatingPelatihSeeder::class,
            RatingKursusSeeder::class,
            UmpanBalikSeeder::class,
        ]);
    }
}
