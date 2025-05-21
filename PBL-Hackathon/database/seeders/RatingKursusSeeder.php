<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RatingKursusSeeder extends Seeder
{
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Create 200 ratings
        for ($i = 0; $i < 300; $i++) {
            DB::table('rating_kursus')->insert([
                'kursus_id' => rand(1, 30), // Randomly select course ID between 1 and 30
                'pengguna_id' => rand(6, 30), // Randomly assign a user ID between 6 and 30
                'rating' => rand(5, 10), // Random rating between 1 and 10
                'komentar' => $faker->sentence(), // Generate a random comment
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
