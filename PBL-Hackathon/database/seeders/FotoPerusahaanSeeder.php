<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FotoPerusahaanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($perusahaan_id = 1; $perusahaan_id <= 10; $perusahaan_id++) {
            $usedImages = [];

            for ($i = 0; $i < 8; $i++) {
                // Random kursus foto 1-50
                do {
                    $random_kursus = rand(1, 50);
                } while (in_array($random_kursus, $usedImages)); 

                $usedImages[] = $random_kursus;

                DB::table('foto_perusahaan')->insert([
                    'perusahaan_id' => $perusahaan_id,
                    'file_path' => "foto_perusahaan/kursus{$random_kursus}.jpg",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
