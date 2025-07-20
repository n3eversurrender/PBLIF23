<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PenggunaFactory extends Factory
{
    protected $model = \App\Models\Pengguna::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'no_telepon' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'kata_sandi' => Hash::make('password123'), // default password
            'foto_profil' => null,
            'peran' => 'Peserta',
            'status_verifikasi' => 'Sudah Diverifikasi',
        ];
    }
}
