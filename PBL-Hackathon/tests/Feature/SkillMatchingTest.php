<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use App\Models\Peserta;
use App\Models\Skill;
use App\Models\Pengguna; // <-- ini model pengguna yang kamu pakai
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SkillMatchingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Nonaktifkan middleware supaya tidak blocking test
        $this->withoutMiddleware();

        DB::statement('PRAGMA foreign_keys=ON;');
        // Pastikan route cache bersih saat testing (optional, kalau kamu pakai caching)
        // $this->artisan('route:clear');
    }

    public function test_skillmatching_success()
    {
        $user = Pengguna::factory()->create();
        $this->actingAs($user);

        // Buat peserta secara manual dengan semua field wajib
        Peserta::create([
            'pengguna_id' => $user->id,
            'status' => 'Mahasiswa',
            'pendidikan' => 'S1',
            'minat_bidang' => 'IT',
            'bidang_saat_ini' => 'IT Support',
            'nama_keahlian' => 'Programming',
        ]);

        // Cek apakah data peserta sudah tersimpan
        dd(Peserta::all()->toArray());

        // Buat kursus dummy supaya foreign key tidak gagal
        \App\Models\Kursus::factory()->count(2)->create();

        Http::fake([
            '127.0.0.1:9999/skillmatching' => Http::response([
                'skillmatching' => [
                    ['kursus_id' => 1, 'score' => 80],
                    ['kursus_id' => 2, 'score' => 75],
                ],
            ], 200),
        ]);

        $response = $this->post(route('peserta.skillmatching'), [
            'minat_bidang' => 'IT',
            'bidang_saat_ini' => 'IT Support',
            'tingkat_kesulitan' => 'Pemula',
            'pendidikan' => 'S1',
            'status' => 'Mahasiswa',
            'nama_keahlian' => 'Programming',
        ]);

        Log::info('Redirect Location:', ['location' => $response->headers->get('Location')]);
        Log::info('Expected route:', ['expected' => route('BerandaTrainee')]);

        $response->assertStatus(302);
        $this->assertEquals(url('/BerandaTrainee'), $response->headers->get('Location'));
        $response->assertSessionHas('success', 'Rekomendasi berhasil disimpan.');

        $this->assertDatabaseHas('peserta', [
            'pengguna_id' => $user->id,
            'minat_bidang' => 'IT',
        ]);

        $this->assertDatabaseHas('skills', [
            'kursus_id' => 1,
            'score' => 80,
        ]);
    }


    public function test_skillmatching_validation_error()
    {
        $user = Pengguna::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('peserta.skillmatching'), []);

        $response->assertSessionHasErrors([
            'minat_bidang',
            'bidang_saat_ini',
            'tingkat_kesulitan',
            'pendidikan',
            'status',
            'nama_keahlian',
        ]);
    }

    public function test_skillmatching_no_recommendation_error()
    {
        $user = Pengguna::factory()->create();
        $this->actingAs($user);
        Peserta::factory()->create(['pengguna_id' => $user->id]);

        Http::fake([
            '127.0.0.1:9999/skillmatching' => Http::response(['skillmatching' => []], 200)
        ]);

        $response = $this->post(route('peserta.skillmatching'), [
            'minat_bidang' => 'IT',
            'bidang_saat_ini' => 'IT Support',
            'tingkat_kesulitan' => 'Pemula',
            'pendidikan' => 'S1',
            'status' => 'Mahasiswa',
            'nama_keahlian' => 'Programming',
        ]);

        $response->assertSessionHas('error', 'Tidak ada rekomendasi yang ditemukan.');
    }

    public function test_skillmatching_exception_handling()
    {
        $user = Pengguna::factory()->create();
        $this->actingAs($user);
        Peserta::factory()->create(['pengguna_id' => $user->id]);

        Http::fake([
            '127.0.0.1:9999/skillmatching' => function () {
                throw new \Exception('API down');
            }
        ]);

        $response = $this->post(route('peserta.skillmatching'), [
            'minat_bidang' => 'IT',
            'bidang_saat_ini' => 'IT Support',
            'tingkat_kesulitan' => 'Pemula',
            'pendidikan' => 'S1',
            'status' => 'Mahasiswa',
            'nama_keahlian' => 'Programming',
        ]);

        $response->assertSessionHas('error');
        $this->assertStringContainsString('API down', session('error'));
    }
}
