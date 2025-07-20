<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Pengguna;

class PenggunaTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengguna_baru_berhasil_didaftarkan()
    {
        $response = $this->post(route('pengguna.store'), [  // pakai route name
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'kata_sandi' => 'Password123',   // password valid sesuai aturan
            'kata_sandi_confirmation' => 'Password123',
            'status' => 'Aktif',
        ]);

        $response->assertRedirect('/Masuk');  // sesuaikan dengan redirect controller
        $this->assertDatabaseHas('pengguna', [
            'email' => 'john@example.com',
        ]);
    }

    public function test_gagal_daftar_jika_tanpa_nama()
    {
        $response = $this->post(route('pengguna.store'), [
            'email' => 'john@example.com',
            'kata_sandi' => 'password',
            'kata_sandi_confirmation' => 'password',
            'status' => 'Aktif',
        ]);

        $response->assertSessionHasErrors('nama');
    }

    public function test_gagal_daftar_jika_email_sudah_ada()
    {
        Pengguna::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'kata_sandi' => bcrypt('password'),
            'status' => 'Aktif',
        ]);

        $response = $this->post(route('pengguna.store'), [
            'nama' => 'Jane Doe',
            'email' => 'john@example.com',
            'kata_sandi' => 'password',
            'kata_sandi_confirmation' => 'password',
            'status' => 'Aktif',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
