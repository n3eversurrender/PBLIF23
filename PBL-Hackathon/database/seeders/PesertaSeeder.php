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

        $statusOptions = ['Mahasiswa', 'Pekerja', 'Dosen', 'Lainnya'];
        $pendidikanOptions = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
        $bidangOptions = ['Welding', 'Fitting', 'PLC', 'Automation', 'HVAC', 'Electrical'];
        $kemampuanOptions = ['AutoCAD', 'SolidWorks', 'CNC', 'Python', 'MATLAB', 'MS Project'];

        foreach (range(1, 10) as $index) {
            $minatBidang = $faker->randomElements($bidangOptions, rand(1, 3));

            // Membuat bidang_saat_ini berupa array object
            $bidangSaatIni = collect($faker->randomElements($bidangOptions, rand(1, 2)))->map(function ($item) use ($faker) {
                return [
                    'bidang' => $item,
                    'tahun' => $faker->numberBetween(0, 5),
                    'bulan' => $faker->numberBetween(0, 11),
                ];
            })->toArray();

            DB::table('peserta')->insert([
                'pengguna_id'        => $faker->numberBetween(1, 10),
                'status'             => $faker->randomElement($statusOptions),
                'pendidikan'         => $faker->randomElement($pendidikanOptions),
                'minat_bidang'       => json_encode($minatBidang),
                'bidang_saat_ini'    => json_encode($bidangSaatIni),
                'kemampuan'          => json_encode($faker->randomElements($kemampuanOptions, rand(1, 4))),
                'tahun_pengalaman'   => $faker->numberBetween(0, 10),
                'bulan_pengalaman'   => $faker->numberBetween(0, 11),
                'nama_keahlian'      => $faker->word,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
    }
}
