<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KurikulumSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Daftar kursus dengan nama kursus
        $kursus_titles = [
            'Pelatihan Pengelasan Listrik untuk Pemula',
            'Pelatihan Pemrograman Mesin CNC di Dunia Fabrikasi',
            'Desain dan Prototyping 3D dalam Proses Fabrikasi',
            'Pengenalan Mesin Pemotong Laser untuk Fabrikasi',
            'Pembuatan Mold dan Die untuk Produksi Massal',
            'Teknik Pengelasan MIG dan TIG untuk Fabrikasi',
            'Manajemen Proyek di Industri Fabrikasi',
            'Teknik Pemrograman Robot Industri di Batam',
            'Pelatihan Pengoperasian Mesin Milling untuk Fabrikasi',
            'Pembuatan Prototipe dengan Teknologi Additive Manufacturing'
        ];

        // Loop untuk kursus 1 sampai 10
        foreach ($kursus_titles as $kursusId => $kursusTitle) {
            // Menghasilkan 5 topik kurikulum untuk setiap kursus
            foreach (range(1, 5) as $index) {
                DB::table('kurikulum')->insert([
                    'kursus_id' => $kursusId + 1,  // Menyesuaikan ID kursus
                    'nama_topik' => $this->generateTopik($kursusTitle, $index),  // Menyesuaikan nama topik dengan kursus
                    'deskripsi' => $this->generateDeskripsi($kursusTitle, $index), // Deskripsi disesuaikan dengan topik
                    'durasi' => $faker->numberBetween(2, 5),  // Durasi antara 2 hingga 5 jam
                    'materi' => 'https://www.youtube.com/embed/' . $faker->lexify('????????????????????')  // Link YouTube acak
                ]);
            }
        }
    }

    // Fungsi untuk mengenerate nama topik berdasarkan judul kursus
    private function generateTopik($kursusTitle, $index)
    {
        switch ($kursusTitle) {
            case 'Pelatihan Pengelasan Listrik untuk Pemula':
                return match ($index) {
                    1 => 'Pengenalan Alat Las Listrik',
                    2 => 'Teknik Dasar Pengelasan Listrik',
                    3 => 'Pengelasan dengan Bahan Logam',
                    4 => 'Pengujian Kekuatan Hasil Las',
                    5 => 'Praktik Pengelasan Listrik',
                    default => 'Topik Lainnya',
                };
            case 'Pelatihan Pemrograman Mesin CNC di Dunia Fabrikasi':
                return match ($index) {
                    1 => 'Pengenalan Mesin CNC dan Fungsinya',
                    2 => 'Dasar-Dasar Pemrograman CNC',
                    3 => 'Pengoperasian Mesin CNC',
                    4 => 'Pemrograman untuk Pembuatan Komponen Presisi',
                    5 => 'Praktik Pemrograman CNC',
                    default => 'Topik Lainnya',
                };
            case 'Desain dan Prototyping 3D dalam Proses Fabrikasi':
                return match ($index) {
                    1 => 'Pengenalan Desain CAD untuk Fabrikasi',
                    2 => 'Mendesain Produk untuk Prototyping 3D',
                    3 => 'Pembuatan Prototipe dengan Printer 3D',
                    4 => 'Evaluasi Prototipe 3D',
                    5 => 'Perbaikan Desain Berdasarkan Hasil Uji Prototipe',
                    default => 'Topik Lainnya',
                };
            case 'Pengenalan Mesin Pemotong Laser untuk Fabrikasi':
                return match ($index) {
                    1 => 'Pengenalan Mesin Pemotong Laser',
                    2 => 'Fungsi Mesin Pemotong Laser dalam Fabrikasi',
                    3 => 'Pengoperasian Mesin Pemotong Laser',
                    4 => 'Pemrograman Mesin Pemotong Laser',
                    5 => 'Penyetelan dan Perawatan Mesin Pemotong Laser',
                    default => 'Topik Lainnya',
                };
            case 'Pembuatan Mold dan Die untuk Produksi Massal':
                return match ($index) {
                    1 => 'Pengenalan Mold dan Die dalam Produksi Massal',
                    2 => 'Desain Mold dan Die',
                    3 => 'Bahan yang Digunakan untuk Mold dan Die',
                    4 => 'Proses Pembuatan Mold dan Die',
                    5 => 'Evaluasi dan Uji Kualitas Mold dan Die',
                    default => 'Topik Lainnya',
                };
            case 'Teknik Pengelasan MIG dan TIG untuk Fabrikasi':
                return match ($index) {
                    1 => 'Pengenalan Teknik Pengelasan MIG dan TIG',
                    2 => 'Perbedaan Pengelasan MIG dan TIG',
                    3 => 'Pemilihan Mesin Las MIG dan TIG',
                    4 => 'Teknik Pengelasan dengan Mesin MIG dan TIG',
                    5 => 'Praktik Pengelasan MIG dan TIG',
                    default => 'Topik Lainnya',
                };
            case 'Manajemen Proyek di Industri Fabrikasi':
                return match ($index) {
                    1 => 'Pengenalan Manajemen Proyek dalam Fabrikasi',
                    2 => 'Perencanaan dan Pengorganisasian Proyek Fabrikasi',
                    3 => 'Pengendalian Anggaran dan Sumber Daya',
                    4 => 'Manajemen Risiko dalam Proyek Fabrikasi',
                    5 => 'Evaluasi dan Penyelesaian Proyek Fabrikasi',
                    default => 'Topik Lainnya',
                };
            case 'Teknik Pemrograman Robot Industri di Batam':
                return match ($index) {
                    1 => 'Pengenalan Robot Industri',
                    2 => 'Dasar-Dasar Pemrograman Robot',
                    3 => 'Pemrograman Robot untuk Proses Fabrikasi',
                    4 => 'Pengoperasian Robot Industri di Batam',
                    5 => 'Pemeliharaan dan Perawatan Robot Industri',
                    default => 'Topik Lainnya',
                };
            case 'Pelatihan Pengoperasian Mesin Milling untuk Fabrikasi':
                return match ($index) {
                    1 => 'Pengenalan Mesin Milling dalam Fabrikasi',
                    2 => 'Pengoperasian Mesin Milling',
                    3 => 'Pemrograman Mesin Milling',
                    4 => 'Penyetelan Mesin Milling',
                    5 => 'Perawatan Mesin Milling',
                    default => 'Topik Lainnya',
                };
            case 'Pembuatan Prototipe dengan Teknologi Additive Manufacturing':
                return match ($index) {
                    1 => 'Pengenalan Teknologi Additive Manufacturing',
                    2 => 'Desain untuk Additive Manufacturing',
                    3 => 'Proses Cetak 3D untuk Prototipe',
                    4 => 'Material untuk Additive Manufacturing',
                    5 => 'Evaluasi dan Perbaikan Prototipe 3D',
                    default => 'Topik Lainnya',
                };
            default:
                return "Topik Umum " . $index;  // Jika kursus tidak sesuai, gunakan topik umum
        }
    }

    // Fungsi untuk mengenerate deskripsi berdasarkan topik
    private function generateDeskripsi($kursusTitle, $index)
    {
        switch ($kursusTitle) {
            case 'Pelatihan Pengelasan Listrik untuk Pemula':
                return match ($index) {
                    1 => 'Mempelajari alat dasar pengelasan listrik dan fungsinya.',
                    2 => 'Dasar-dasar pengelasan listrik dengan teknik yang mudah dipahami pemula.',
                    3 => 'Menggunakan teknik pengelasan dengan bahan logam untuk menghasilkan pengelasan yang kuat.',
                    4 => 'Melakukan pengujian kekuatan pengelasan untuk memastikan kualitasnya.',
                    5 => 'Praktik langsung dalam melakukan pengelasan listrik untuk pemula.',
                    default => 'Deskripsi Lainnya',
                };
            case 'Pelatihan Pemrograman Mesin CNC di Dunia Fabrikasi':
                return match ($index) {
                    1 => 'Pengenalan tentang mesin CNC dan berbagai fungsinya dalam industri fabrikasi.',
                    2 => 'Dasar-dasar pemrograman CNC untuk memulai penggunaan mesin.',
                    3 => 'Cara mengoperasikan mesin CNC untuk menghasilkan produk presisi.',
                    4 => 'Pemrograman mesin CNC untuk menghasilkan komponen dengan tingkat presisi yang tinggi.',
                    5 => 'Praktik langsung dalam pemrograman dan pengoperasian mesin CNC.',
                    default => 'Deskripsi Lainnya',
                };
            case 'Desain dan Prototyping 3D dalam Proses Fabrikasi':
                return match ($index) {
                    1 => 'Pengenalan desain CAD sebagai dasar dalam proses fabrikasi produk.',
                    2 => 'Teknik mendesain produk yang akan diproduksi menggunakan teknologi prototyping 3D.',
                    3 => 'Proses pembuatan prototipe dengan printer 3D untuk melihat hasil desain sebelum produksi massal.',
                    4 => 'Evaluasi hasil prototipe 3D untuk perbaikan desain lebih lanjut.',
                    5 => 'Perbaikan desain berdasarkan evaluasi hasil uji prototipe untuk mendapatkan produk final.',
                    default => 'Deskripsi Lainnya',
                };
            // Tambahkan case deskripsi lainnya sesuai dengan topik kursus lainnya
            default:
                return "Deskripsi untuk topik ini";  // Deskripsi default
        }
    }
}
