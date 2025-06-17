<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $users = [
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'no_telepon' => '08123456789',
                'alamat' => 'Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'kata_sandi' => bcrypt('123123123'),
                'foto_profil' => null,
                'peran' => 'Admin',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Admin2',
                'email' => 'admin2@gmail.com',
                'no_telepon' => '08123456789',
                'alamat' => 'Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'kata_sandi' => bcrypt('123123123'),
                'foto_profil' => null,
                'peran' => 'Admin',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'M Zaini Ridha',
                'email' => 'zaini@gmail.com',
                'no_telepon' => '08123456789',
                'alamat' => 'Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'kata_sandi' => bcrypt('123123123'),
                'foto_profil' => null,
                'peran' => 'Perusahaan',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Niati',
                'email' => 'niati@gmail.com',
                'no_telepon' => '08123456788',
                'alamat' => 'Bandung',
                'jenis_kelamin' => 'Perempuan',
                'kata_sandi' => bcrypt('123123123'),
                'foto_profil' => null,
                'peran' => 'Perusahaan',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Aiko',
                'email' => 'aiko@gmail.com',
                'no_telepon' => '08123456787',
                'alamat' => 'Surabaya',
                'jenis_kelamin' => 'Perempuan',
                'kata_sandi' => bcrypt('123123123'),
                'foto_profil' => null,
                'peran' => 'Perusahaan',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Dina',
                'email' => 'dina@gmail.com',
                'no_telepon' => '08123456786',
                'alamat' => 'Yogyakarta',
                'jenis_kelamin' => 'Perempuan',
                'kata_sandi' => bcrypt('123123123'),
                'foto_profil' => null,
                'peran' => 'Perusahaan',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Aziz',
                'email' => 'aziz@gmail.com',
                'no_telepon' => '08123456785',
                'alamat' => 'Semarang',
                'jenis_kelamin' => 'Laki-laki',
                'kata_sandi' => bcrypt('123123123'),
                'foto_profil' => null,
                'peran' => 'Perusahaan',
                'status_verifikasi' => 'Sudah Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ozed',
                'email' => 'ozed@gmail.com',
                'no_telepon' => '08123456784',
                'alamat' => 'Semarang',
                'jenis_kelamin' => 'Laki-laki',
                'kata_sandi' => bcrypt('123123123'),
                'foto_profil' => null,
                'peran' => 'Peserta',
                'status_verifikasi' => 'Belum Diverifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        // Tambahkan 192 pengguna dummy
        for ($i = 0; $i < 192; $i++) {
            $users[] = [
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'no_telepon' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'kata_sandi' => bcrypt('password'),
                'foto_profil' => null,
                'peran' => $faker->randomElement(['Peserta']),
                'status_verifikasi' => $faker->randomElement(['Sudah Diverifikasi']),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('pengguna')->insert($users);
    }
}
