<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelatihSeeder extends Seeder
{
    public function run()
    {
        DB::table('pelatih')->insert([
            [
                'pengguna_id' => 3,
                'tahun_pengalaman' => 5,
                'bulan_pengalaman' => 5,
                'nama_spesialisasi' => 'Personal Trainer',
                'file_sertifikasi' => 'sertifikasi_pt.pdf',
            ],
            [
                'pengguna_id' => 4,
                'tahun_pengalaman' => 10,
                'bulan_pengalaman' => 3,
                'nama_spesialisasi' => 'Yoga Instructor',
                'file_sertifikasi' => 'sertifikasi_yoga.pdf',
            ],
            [
                'pengguna_id' => 5,
                'tahun_pengalaman' => 2,
                'bulan_pengalaman' => 7,
                'nama_spesialisasi' => 'Strength Coach',
                'file_sertifikasi' => 'sertifikasi_strength.pdf',
            ],
            [
                'pengguna_id' => 6,
                'tahun_pengalaman' => 3,
                'bulan_pengalaman' => 2,
                'nama_spesialisasi' => 'Nutrition Specialist',
                'file_sertifikasi' => 'sertifikasi_nutrition.pdf',
            ],
            [
                'pengguna_id' => 7,
                'tahun_pengalaman' => 7,
                'bulan_pengalaman' => 1,
                'nama_spesialisasi' => 'CrossFit Coach',
                'file_sertifikasi' => 'sertifikasi_crossfit.pdf',
            ],
        ]);
    }
}
