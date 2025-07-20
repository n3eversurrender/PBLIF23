<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RekomendasiTest extends TestCase
{
    // pakai RefreshDatabase kalau memang butuh migrasi, 
    // kalau gak ada database interaksi bisa dihapus ini
    // use RefreshDatabase;

    public function test_get_recommendation_success()
    {
        // Mock HTTP response dari API Flask
        Http::fake([
            '127.0.0.1:9999/rekomendasi' => Http::response([
                'result' => [
                    ['kursus' => 'Kursus A', 'score' => 0.9],
                    ['kursus' => 'Kursus B', 'score' => 0.8],
                ]
            ], 200),
        ]);

        $response = $this->post(route('rekomendasi'), [
            'harga_maks' => 5000000,
            'rating_min' => 4.5,
            'rating_perusahaan_min' => 4.2,
            'tingkat_kesulitan' => 'Menengah',
            'lokasi' => 'Batam Center',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('guest.recommendation');
        $response->assertViewHas('data');

        // Kamu juga bisa assert isi data hasil mock-nya
        $responseData = $response->viewData('data');
        $this->assertIsArray($responseData['result']);
        $this->assertCount(2, $responseData['result']);
    }

    public function test_get_recommendation_validation_error()
    {
        $response = $this->post(route('rekomendasi'), [
            // kosongin harga_maks supaya validasi gagal
            'rating_min' => 4.5,
            'rating_perusahaan_min' => 4.2,
            'tingkat_kesulitan' => 'Menengah',
            'lokasi' => 'Batam Center',
        ]);

        $response->assertSessionHasErrors('harga_maks');
    }

    public function test_get_recommendation_api_failure()
    {
        // Mock API Flask respons gagal (misal 500 error)
        Http::fake([
            '127.0.0.1:9999/rekomendasi' => Http::response([], 500),
        ]);

        $response = $this->post(route('rekomendasi'), [
            'harga_maks' => 5000000,
            'rating_min' => 4.5,
            'rating_perusahaan_min' => 4.2,
            'tingkat_kesulitan' => 'Menengah',
            'lokasi' => 'Batam Center',
        ]);

        $response->assertSessionHasErrors('message');
    }

    public function test_get_recommendation_api_exception()
    {
        // Mock supaya HTTP Client lempar exception
        Http::fake(function () {
            throw new \Exception("Server down");
        });

        $response = $this->post(route('rekomendasi'), [
            'harga_maks' => 5000000,
            'rating_min' => 4.5,
            'rating_perusahaan_min' => 4.2,
            'tingkat_kesulitan' => 'Menengah',
            'lokasi' => 'Batam Center',
        ]);

        $response->assertSessionHasErrors('message');
    }
}
