<?php

namespace Database\Factories;

use App\Models\Peserta;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesertaFactory extends Factory
{
    protected $model = Peserta::class;

    public function definition()
    {
        return [
            'pengguna_id' => Pengguna::factory(), // biar bisa langsung relasi ke pengguna
            'status' => 'Mahasiswa',
            'pendidikan' => 'S1',
            'minat_bidang' => $this->faker->word,
            'bidang_saat_ini' => json_encode([
                ['bidang' => 'IT Support', 'tahun' => 0, 'bulan' => 0],
            ]),
            'nama_keahlian' => 'Programming',
        ];
    }
}
