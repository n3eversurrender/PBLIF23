<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');  // Menentukan lokal ID untuk Faker

        // Data pengguna dengan ID 1-6 yang sudah ada
        $users = [
            ['nama' => 'Admin', 'email' => 'admin@gmail.com', 'no_telepon' => '08123456789', 'alamat' => 'Jakarta', 'jenis_kelamin' => 'Laki-laki', 'kata_sandi' => bcrypt('123123123'), 'foto_profil' => null, 'peran' => 'Admin', 'status' => 'Aktif'],
            ['nama' => 'Admin2', 'email' => 'admin2@gmail.com', 'no_telepon' => '08123456789', 'alamat' => 'Jakarta', 'jenis_kelamin' => 'Laki-laki', 'kata_sandi' => bcrypt('123123123'), 'foto_profil' => null, 'peran' => 'Admin', 'status' => 'Aktif'],
            ['nama' => 'M Zaini Ridha', 'email' => 'zaini@gmail.com', 'no_telepon' => '08123456789', 'alamat' => 'Jakarta', 'jenis_kelamin' => 'Laki-laki', 'kata_sandi' => bcrypt('123123123'), 'foto_profil' => null, 'peran' => 'Pelatih', 'status' => 'Aktif'],
            ['nama' => 'Niati', 'email' => 'niati@gmail.com', 'no_telepon' => '08123456788', 'alamat' => 'Bandung', 'jenis_kelamin' => 'Perempuan', 'kata_sandi' => bcrypt('123123123'), 'foto_profil' => null, 'peran' => 'Pelatih', 'status' => 'Aktif'],
            ['nama' => 'Aiko', 'email' => 'aiko@gmail.com', 'no_telepon' => '08123456787', 'alamat' => 'Surabaya', 'jenis_kelamin' => 'Perempuan', 'kata_sandi' => bcrypt('123123123'), 'foto_profil' => null, 'peran' => 'Pelatih', 'status' => 'Aktif'],
            ['nama' => 'Dina', 'email' => 'dina@gmail.com', 'no_telepon' => '08123456786', 'alamat' => 'Yogyakarta', 'jenis_kelamin' => 'Perempuan', 'kata_sandi' => bcrypt('123123123'), 'foto_profil' => null, 'peran' => 'Pelatih', 'status' => 'Aktif'],
            ['nama' => 'Aziz', 'email' => 'aziz@gmail.com', 'no_telepon' => '08123456785', 'alamat' => 'Semarang', 'jenis_kelamin' => 'Laki-laki', 'kata_sandi' => bcrypt('123123123'), 'foto_profil' => null, 'peran' => 'Pelatih', 'status' => 'Aktif'],
            ['nama' => 'Ozed', 'email' => 'ozed@gmail.com', 'no_telepon' => '08123456785', 'alamat' => 'Semarang', 'jenis_kelamin' => 'Laki-laki', 'kata_sandi' => bcrypt('123123123'), 'foto_profil' => null, 'peran' => 'Peserta', 'status' => 'Aktif'],
        ];

        // Menambahkan 200 data pengguna dummy menggunakan Faker
        for ($i = 0; $i < 194; $i++) {
            $users[] = [
                'nama' => $faker->name,  // Nama acak
                'email' => $faker->unique()->safeEmail,  // Email unik
                'no_telepon' => $faker->phoneNumber,  // Nomor telepon acak
                'alamat' => $faker->address,  // Alamat acak
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),  // Jenis kelamin acak
                'kata_sandi' => bcrypt('password'),  // Kata sandi default
                'foto_profil' => null,  // Foto profil null
                'peran' => $faker->randomElement(['Peserta', 'Pelatih']),  // Pilih peran acak
                'status' => $faker->randomElement(['Aktif', 'Tidak Aktif']),  // Status aktif atau tidak
            ];
        }

        // Sisipkan data ke dalam tabel pengguna
        DB::table('pengguna')->insert($users);
    }
}
