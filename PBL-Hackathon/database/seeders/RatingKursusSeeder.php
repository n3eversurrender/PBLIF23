<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RatingKursusSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $positifKomentar = [
            'Pelatihan ini sangat bermanfaat, instruktur sangat ahli di bidangnya.',
            'Materi yang diberikan sangat lengkap dan aplikatif.',
            'Saya merasa sangat puas dengan kualitas pelatihannya.',
            'Proses pelatihan berjalan lancar dan saya bisa langsung menerapkan ilmu yang saya dapat.',
            'Tempat pelatihan nyaman dan fasilitasnya sangat mendukung.',
            'Pengalaman pelatihan yang sangat memuaskan!',
            'Sangat rekomendasi untuk teman-teman yang ingin mendalami bidang ini.',
            'Pelatihan ini memberikan banyak wawasan baru yang sangat berguna.',
            'Kursus yang sangat bermanfaat dan aplikatif untuk pekerjaan saya.',
            'Instruktur sangat berpengalaman dan sabar dalam menjelaskan materi.'
        ];

        $negatifKomentar = [
            'Pelatihan terlalu cepat dan tidak ada cukup waktu untuk praktik.',
            'Materi yang diberikan sangat membingungkan dan kurang terstruktur.',
            'Pelayanan yang buruk, tidak ada tindak lanjut setelah pelatihan.',
            'Fasilitas yang disediakan tidak memadai, sangat mengecewakan.',
            'Pelatihan terlalu teoritis dan tidak ada cukup aplikasi di lapangan.',
            'Saya merasa pelatihan ini kurang memberikan nilai tambah.',
            'Proses administrasi sangat lambat, banyak kesalahan.',
            'Tempat pelatihan tidak nyaman dan kurang mendukung.',
            'Pengajaran kurang jelas, instruktur tidak cukup membantu.',
            'Saya tidak merasa puas dengan kualitas pelatihan ini.'
        ];

        $netralKomentar = [
            'Pelatihannya cukup baik, tidak ada yang terlalu menonjol.',
            'Materi yang diberikan sesuai ekspektasi standar.',
            'Pengalaman yang biasa saja, tidak buruk tapi juga tidak istimewa.',
            'Fasilitas cukup memadai meskipun ada ruang untuk perbaikan.',
            'Kursus berjalan sesuai jadwal tanpa kendala berarti.',
            'Instruktur cukup komunikatif, meski ada yang kurang jelas.',
            'Pelatihan ini sesuai dengan yang dijanjikan.',
            'Tidak ada yang istimewa, tapi cukup untuk kebutuhan saya.',
            'Cocok untuk pemula, tapi mungkin kurang menantang untuk lanjutan.',
            'Kualitas pelatihan rata-rata.'
        ];
        $data = [];

        for ($i = 0; $i < 1000; $i++) {
            $kursus_id = rand(1, 50);
            $pengguna_id = rand(13, 312);

            $randType = rand(1, 3);
            if ($randType === 1) {
                $komentar = $faker->randomElement($positifKomentar);
                $pred_label = 'positif';
                $rating = rand(45, 50) / 10;
            } elseif ($randType === 2) {
                $komentar = $faker->randomElement($netralKomentar);
                $pred_label = 'netral';
                $rating = rand(30, 40) / 10;
            } else {
                $komentar = $faker->randomElement($negatifKomentar);
                $pred_label = 'negatif';
                $rating = rand(15, 34) / 10;
            }

            $data[] = [
                'kursus_id' => $kursus_id,
                'pengguna_id' => $pengguna_id,
                'rating' => $rating,
                'komentar' => $komentar,
                'pred_label' => $pred_label,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert batch 100
        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('rating_kursus')->insert($chunk);
        }
    }
}
