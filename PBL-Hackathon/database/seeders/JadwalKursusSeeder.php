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

        foreach (range(1, 10) as $i) {
            DB::table('jadwal_kursus')->insert([
                'kursus_id' => $faker->numberBetween(1, 10),
                'sesi' => "Sesi " . $i,
                'tanggal' => $faker->date(),
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '12:00:00',
                'lokasi' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
