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

        // Daftar status, pendidikan, bidang, dan kemampuan
        $statusOptions = ['Mahasiswa', 'Pekerja', 'Dosen', 'Lainnya'];
        $pendidikanOptions = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
        $bidangOptions = ['Welding', 'Fitting', 'PLC', 'Automation', 'HVAC', 'Electrical'];
        $kemampuanOptions = ['AutoCAD', 'SolidWorks', 'CNC', 'Python', 'MATLAB', 'MS Project'];

        // Loop untuk membuat 300 data peserta dengan ID dari 13 sampai 312
        foreach (range(13, 312) as $index) {
            // Pilih beberapa bidang minat secara acak
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
                'pengguna_id'        => $index,  // Pengguna ID dimulai dari 13 hingga 312
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
