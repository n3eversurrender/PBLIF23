<?php

namespace Database\Factories;

use App\Models\Kursus;
use App\Models\Pengguna;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class KursusFactory extends Factory
{
    protected $model = Kursus::class;

    public function definition()
    {
        return [
            'pengguna_id' => Pengguna::factory(), // otomatis buat pengguna
            'kategori_id' => Kategori::factory(), // otomatis buat kategori
            'judul' => $this->faker->sentence,
            'deskripsi' => $this->faker->paragraph,
            'harga' => $this->faker->numberBetween(50000, 2000000),
            'tingkat_kesulitan' => $this->faker->randomElement(['Pemula', 'Menengah', 'Lanjutan']),
            'status' => 'Aktif',
            'tgl_mulai' => now()->addDays(1),
            'tgl_selesai' => now()->addDays(30),
            'kapasitas' => $this->faker->numberBetween(10, 100),
            'lokasi' => $this->faker->city,
            'foto_kursus' => null,
        ];
    }
}
