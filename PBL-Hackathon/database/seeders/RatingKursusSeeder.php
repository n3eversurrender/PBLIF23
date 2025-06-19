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

        // Set untuk komentar positif dan negatif
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

        // Kursus ID 1-15, rating antara 4.5 dan 5.0, 50-70 ulasan per kursus
        for ($kursus_id = 1; $kursus_id <= 15; $kursus_id++) {
            $ulasan_count = rand(50, 70); // Ulasan untuk kursus 1-15
            for ($i = 0; $i < $ulasan_count; $i++) {
                $rating = rand(45, 50) / 10; // Rating antara 4.5 hingga 5.0
                $komentar = $faker->randomElement($positifKomentar);

                DB::table('rating_kursus')->insert([
                    'kursus_id' => $kursus_id,
                    'pengguna_id' => rand(13, 312), // Random pengguna ID
                    'rating' => $rating, // Rating antara 4.5-5.0
                    'komentar' => $komentar, // Komentar positif
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Kursus ID 16-30, rating antara 3.5 dan 4.4, 50-70 ulasan per kursus
        for ($kursus_id = 16; $kursus_id <= 30; $kursus_id++) {
            $ulasan_count = rand(50, 70); // Ulasan untuk kursus 16-30
            for ($i = 0; $i < $ulasan_count; $i++) {
                $rating = rand(35, 44) / 10; // Rating antara 3.5 hingga 4.4
                $komentar = $faker->randomElement($positifKomentar);

                DB::table('rating_kursus')->insert([
                    'kursus_id' => $kursus_id,
                    'pengguna_id' => rand(13, 312), // Random pengguna ID
                    'rating' => $rating, // Rating antara 3.5-4.4
                    'komentar' => $komentar, // Komentar positif
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Kursus ID 31-50, rating antara 1.5 dan 3.4, 70-90 ulasan per kursus
        for ($kursus_id = 31; $kursus_id <= 50; $kursus_id++) {
            $ulasan_count = rand(70, 90); // Ulasan untuk kursus 31-50
            for ($i = 0; $i < $ulasan_count; $i++) {
                $rating = rand(15, 34) / 10; // Rating antara 1.5 hingga 3.4
                $komentar = $faker->randomElement($negatifKomentar);

                DB::table('rating_kursus')->insert([
                    'kursus_id' => $kursus_id,
                    'pengguna_id' => rand(13, 312), // Random pengguna ID
                    'rating' => $rating, // Rating antara 1.5-3.4
                    'komentar' => $komentar, // Komentar negatif
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
