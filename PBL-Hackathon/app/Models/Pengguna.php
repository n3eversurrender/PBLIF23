<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'pengguna_id';

    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
        'alamat',
        'jenis_kelamin',
        'kata_sandi',
        'foto_profil',
        'peran'
    ];
    protected $hidden = [
        'kata_sandi',
    ];

    public function pelatih()
    {
        return $this->hasOne(Pelatih::class, 'pengguna_id');
    }

    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'pengguna_id');
    }

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'pengguna_id', 'pengguna_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'pengguna_id');
    }
    public function verifikasi()
    {
        return $this->hasOne(Verifikasi::class, 'pengguna_id', 'pengguna_id');
    }

    public function ratingKursus()
    {
        return $this->hasMany(RatingKursus::class, 'pengguna_id');
    }
    public function ratingsPelatih()
    {
        return $this->hasMany(RatingPelatih::class, 'pengguna_id', 'pengguna_id');
    }
    public function ratingPemberi()
    {
        return $this->hasMany(RatingPelatih::class, 'pemberi_id');
    }
}
