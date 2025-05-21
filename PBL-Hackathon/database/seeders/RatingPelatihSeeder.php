<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingPelatihSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 0; $i < 200; $i++) {
            $data[] = [
                'pemberi_id' => rand(6, 100),
                'pengguna_id' => rand(3, 7),
                'rating' => round(rand(50, 100) / 10, 1), // Menghasilkan angka desimal antara 5.0 - 10.0
                'komentar' => null, // Kosong karena hanya menampilkan rating
            ];
        }

        DB::table('rating_pelatih')->insert($data);
    }
}
