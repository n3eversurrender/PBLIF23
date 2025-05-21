<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SertifikatSeeder extends Seeder
{
    public function run()
    {
        DB::table('sertifikat')->insert([
            ['pendaftaran_id' => 1, 'nama_kursus' => 'Kursus Bahasa Inggris', 'file_sertifikat' => 'sertifikat-001.pdf', 'nomor_sertifikat' => 'SERTIFIKAT-001', 'tanggal_terbit' => '2025-01-02'],
            ['pendaftaran_id' => 2, 'nama_kursus' => 'Kursus Public Speaking', 'file_sertifikat' => 'sertifikat-002.pdf', 'nomor_sertifikat' => 'SERTIFIKAT-002', 'tanggal_terbit' => '2025-01-03'],
            ['pendaftaran_id' => 3, 'nama_kursus' => 'Kursus Desain Grafis', 'file_sertifikat' => 'sertifikat-003.pdf', 'nomor_sertifikat' => 'SERTIFIKAT-003', 'tanggal_terbit' => '2025-01-04'],
            ['pendaftaran_id' => 4, 'nama_kursus' => 'Kursus Pemrograman Web', 'file_sertifikat' => 'sertifikat-004.pdf', 'nomor_sertifikat' => 'SERTIFIKAT-004', 'tanggal_terbit' => '2025-01-05'],
            ['pendaftaran_id' => 5, 'nama_kursus' => 'Kursus Digital Marketing', 'file_sertifikat' => 'sertifikat-005.pdf', 'nomor_sertifikat' => 'SERTIFIKAT-005', 'tanggal_terbit' => '2025-01-06'],
        ]);
    }
}
