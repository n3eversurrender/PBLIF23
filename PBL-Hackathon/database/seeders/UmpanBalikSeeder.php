<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UmpanBalikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $feedback = [
            'Pelatihan sangat bermanfaat!',
            'Materi mudah dipahami.',
            'Instruktur sangat interaktif.',
            'Saya berharap ada lebih banyak contoh studi kasus.',
            'Tolong tambahkan fitur untuk diskusi peserta.',
            'Sistem sangat user-friendly.',
            'Video pelatihan sangat membantu.',
            'Koneksi sempat terputus, mohon perbaiki server.',
            'Tampilan platform sangat menarik.',
            'Sangat puas dengan materi dan penyampaian.',
            'Ada beberapa bug kecil saat mengakses modul.',
            'Saya suka format kuisnya.',
            'Fitur sertifikat sangat berguna.',
            'Materi terlalu singkat, tolong diperpanjang.',
            'Saya belajar banyak hal baru.',
            'Harapan saya: ada lebih banyak pelatihan lanjutan.',
            'Waktu sesi live terlalu pendek.',
            'Instruktur kurang interaktif, mohon ditingkatkan.',
            'Fitur progress tracker sangat membantu.',
            'Tolong tambahkan fitur catatan di setiap modul.',
            'Audio video sedikit kurang jernih.',
            'Saya suka adanya forum diskusi.',
            'Instruktur sangat profesional.',
            'Materi tidak sesuai ekspektasi saya.',
            'Pelatihan ini meningkatkan keterampilan saya.'
        ];

        for ($i = 1; $i <= 25; $i++) {
            $data[] = [
                'nama_komentar' => 'User ' . $i,
                'komentar' => $feedback[array_rand($feedback)], // Acak komentar
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('umpan_balik')->insert($data);
    }
}
