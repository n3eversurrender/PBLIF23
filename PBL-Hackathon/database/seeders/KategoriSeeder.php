<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'Pengelasan dan Logam'],
            ['nama_kategori' => 'Pemrograman dan Otomasi'],
            ['nama_kategori' => 'Desain dan Prototyping'],
            ['nama_kategori' => 'Konstruksi dan Infrastruktur'],
            ['nama_kategori' => 'Manufaktur dan Mesin'],
        ]);
    }
}
    