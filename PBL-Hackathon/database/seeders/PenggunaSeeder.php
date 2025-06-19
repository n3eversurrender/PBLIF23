<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = [];

        // 2 Admin
        $users[] = [
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'no_telepon' => '08123456789',
            'alamat' => 'Jl. Jendral Sudirman No. 1, Jakarta Pusat',
            'jenis_kelamin' => 'Laki-laki',
            'kata_sandi' => Hash::make('123123123'),
            'foto_profil' => null,
            'peran' => 'Admin',
            'status_verifikasi' => 'Sudah Diverifikasi',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $users[] = [
            'nama' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'no_telepon' => '08123456788',
            'alamat' => 'Jl. MH Thamrin No. 10, Jakarta Pusat',
            'jenis_kelamin' => 'Laki-laki',
            'kata_sandi' => Hash::make('123123123'),
            'foto_profil' => null,
            'peran' => 'Admin',
            'status_verifikasi' => 'Sudah Diverifikasi',
            'created_at' => now(),
            'updated_at' => now()
        ];

        // 10 Perusahaan
        $perusahaan = [
            ['Batam Steel Works', 'batamsteel@gmail.com', '08123456781', 'Kawasan Industri Batamindo, Jl. Beringin No.10, Muka Kuning, Batam'],
            ['Mega Baja Utama', 'megabaja@gmail.com', '08123456782', 'Jl. Brigjen Katamso No.88, Tanjung Uncang, Batu Aji, Batam'],
            ['PT Fabrikasi Prima', 'fabrikasi@gmail.com', '08123456783', 'Kawasan Industri Panbil, Jl. Ahmad Yani Blok B No.5, Mukakuning, Batam'],
            ['Batam Metal Engineering', 'batammetal@gmail.com', '08123456784', 'Jl. Trans Barelang KM 10, Galang, Batam'],
            ['Sei Beduk Steel Fabricators', 'seisteel@gmail.com', '08123456785', 'Jl. Sei Beduk Raya No.25, Sei Beduk, Batam'],
            ['PT Galang Fabrikasi', 'galangfab@gmail.com', '08123456786', 'Jl. Lintas Barelang, Galang Industrial Zone, Batam'],
            ['Lubuk Baja Industrial', 'lubukbaja@gmail.com', '08123456787', 'Jl. Lubuk Baja No.88, Lubuk Baja, Batam'],
            ['Bengkong Steel Fabricators', 'bengkongsteel@gmail.com', '08123456788', 'Jl. Bengkong Laut No.15, Bengkong, Batam'],
            ['Nongsa Metal Works', 'nongsametal@gmail.com', '08123456789', 'Jl. Hang Lekiu KM 4, Nongsa, Batam'],
            ['Barelang Fabrication Tech', 'barelangfab@gmail.com', '08123456790', 'Jl. Barelang Industrial Estate No.99, Barelang, Batam'],
        ];

        foreach ($perusahaan as $index => $p) {
            $users[] = [
                'nama' => $p[0],
                'email' => $p[1],
                'no_telepon' => $p[2],
                'alamat' => $p[3],
                'jenis_kelamin' => null,
                'kata_sandi' => Hash::make('123123123'),
                'foto_profil' => 'foto_profil/Perusahaan' . ($index + 1) . '.png',
                'peran' => 'Perusahaan',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // 10 Peserta (atau bisa diperbanyak)
        for ($i = 0; $i < 300; $i++) {
            $users[] = [
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'no_telepon' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'kata_sandi' => Hash::make('123123123'),
                'foto_profil' => null, // atau kalau punya avatar random, bisa isi
                'peran' => 'Peserta',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('pengguna')->insert($users);
    }
}
