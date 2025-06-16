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

        $combinations = [];
        $data = [];

        $maxEntries = min(200, count($perusahaanIds) * count($pemberiIds)); // batas maksimal kombinasi unik

        while (count($data) < $maxEntries) {
            $perusahaan_id = collect($perusahaanIds)->random();
            $pemberi_id = collect($pemberiIds)->random();

            $key = $perusahaan_id . '-' . $pemberi_id;

            if (!isset($combinations[$key])) {
                $combinations[$key] = true;

                $data[] = [
                    'pemberi_id' => $pemberi_id,
                    'perusahaan_id' => $perusahaan_id,
                    'rating' => round(rand(10, 50) / 10, 1), // 1.0 - 5.0
                    'komentar' => 'Seeder komentar ' . count($data),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('rating_perusahaan')->insert($data);
    }
}
