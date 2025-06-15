<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    public function run()
    {
        DB::table('perusahaan')->insert([
            [
                'pengguna_id' => 3,
                'deskripsi' => 'Perusahaan teknologi yang fokus pada solusi digital.',
                'visi' => 'Menjadi perusahaan teknologi terdepan di Asia.',
                'misi' => 'Memberikan solusi inovatif untuk meningkatkan kualitas hidup.',
                'layanan' => 'Pengembangan aplikasi, konsultasi IT, pelatihan digital',
                'npwp' => '01.234.567.8-912.345',
                'akta_pendirian' => 'No. 123/XYZ/2010',
                'izin_operasional' => 'No. 456/DIKTI/2011',
                'sertifikasi_bnsp' => 'No. 789/BNSP/2015',
                'file_npwp' => 'npwp_3.pdf',
                'file_akta_pendirian' => 'akta_3.pdf',
                'file_izin_operasional' => 'izin_3.pdf',
                'file_sertifikasi_bnsp' => 'bnsp_3.pdf',
            ],
            [
                'pengguna_id' => 4,
                'deskripsi' => 'Perusahaan pelatihan kebugaran profesional.',
                'visi' => 'Mencetak generasi sehat dan kuat.',
                'misi' => 'Memberikan pelatihan kebugaran berkualitas.',
                'layanan' => 'Pelatihan gym, personal trainer, kelas yoga',
                'npwp' => '02.345.678.9-123.456',
                'akta_pendirian' => 'No. 124/ABC/2012',
                'izin_operasional' => 'No. 457/DIKTI/2012',
                'sertifikasi_bnsp' => 'No. 790/BNSP/2016',
                'file_npwp' => 'npwp_4.pdf',
                'file_akta_pendirian' => 'akta_4.pdf',
                'file_izin_operasional' => 'izin_4.pdf',
                'file_sertifikasi_bnsp' => 'bnsp_4.pdf',
            ],
            [
                'pengguna_id' => 5,
                'deskripsi' => 'Startup yang bergerak di bidang edutech.',
                'visi' => 'Menyediakan pendidikan yang terjangkau dan berkualitas.',
                'misi' => 'Mengembangkan platform belajar online.',
                'layanan' => 'E-learning, webinar, kursus online',
                'npwp' => '03.456.789.0-234.567',
                'akta_pendirian' => 'No. 125/DEF/2015',
                'izin_operasional' => 'No. 458/DIKTI/2015',
                'sertifikasi_bnsp' => 'No. 791/BNSP/2018',
                'file_npwp' => 'npwp_5.pdf',
                'file_akta_pendirian' => 'akta_5.pdf',
                'file_izin_operasional' => 'izin_5.pdf',
                'file_sertifikasi_bnsp' => 'bnsp_5.pdf',
            ],
             [
                'pengguna_id' => 6,
                'deskripsi' => 'Startup yang bergerak di bidang edutech.',
                'visi' => 'Menyediakan pendidikan yang terjangkau dan berkualitas.',
                'misi' => 'Mengembangkan platform belajar online.',
                'layanan' => 'E-learning, webinar, kursus online',
                'npwp' => '03.456.789.0-234.567',
                'akta_pendirian' => 'No. 125/DEF/2015',
                'izin_operasional' => 'No. 458/DIKTI/2015',
                'sertifikasi_bnsp' => 'No. 791/BNSP/2018',
                'file_npwp' => 'npwp_5.pdf',
                'file_akta_pendirian' => 'akta_5.pdf',
                'file_izin_operasional' => 'izin_5.pdf',
                'file_sertifikasi_bnsp' => 'bnsp_5.pdf',
            ],
             [
                'pengguna_id' => 7,
                'deskripsi' => 'Startup yang bergerak di bidang edutech.',
                'visi' => 'Menyediakan pendidikan yang terjangkau dan berkualitas.',
                'misi' => 'Mengembangkan platform belajar online.',
                'layanan' => 'E-learning, webinar, kursus online',
                'npwp' => '03.456.789.0-234.567',
                'akta_pendirian' => 'No. 125/DEF/2015',
                'izin_operasional' => 'No. 458/DIKTI/2015',
                'sertifikasi_bnsp' => 'No. 791/BNSP/2018',
                'file_npwp' => 'npwp_5.pdf',
                'file_akta_pendirian' => 'akta_5.pdf',
                'file_izin_operasional' => 'izin_5.pdf',
                'file_sertifikasi_bnsp' => 'bnsp_5.pdf',
            ],
        ]);
    }
}
