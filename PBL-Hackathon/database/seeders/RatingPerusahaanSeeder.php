<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingPerusahaanSeeder extends Seeder
{
    public function run()
    {
        $perusahaanIds = DB::table('perusahaan')->pluck('perusahaan_id')->toArray();
        $pemberiIds = DB::table('pengguna')->pluck('pengguna_id')->toArray();

        $data = [];

        for ($i = 0; $i < 200; $i++) {
            $data[] = [
                'pemberi_id' => collect($pemberiIds)->random(),
                'perusahaan_id' => collect($perusahaanIds)->random(),
                'rating' => round(rand(10, 50) / 10, 1), // 1.0 - 5.0
                'komentar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('rating_perusahaan')->insert($data);
    }
}
