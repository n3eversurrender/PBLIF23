<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PesertaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Membuat 10 data peserta
        foreach (range(1, 10) as $index) {
            DB::table('peserta')->insert([
                'pengguna_id' => $faker->numberBetween(1, 10), // Asumsikan ada pengguna dengan ID 1-10
                'tahun_pengalaman' => $faker->numberBetween(1, 10), // Tahun pengalaman antara 1 hingga 10 tahun
                'bulan_pengalaman' => $faker->numberBetween(1, 12), // Bulan pengalaman antara 1 hingga 12 bulan
                'nama_keahlian' => $faker->word, // Nama keahlian acak
            ]);
        }
    }
}
