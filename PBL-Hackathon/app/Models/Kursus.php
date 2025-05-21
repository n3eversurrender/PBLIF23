<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;

    protected $table = 'kursus';
    protected $primaryKey = 'kursus_id';

    protected $fillable = [
        'pengguna_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'lokasi',
        'harga',
        'tingkat_kesulitan',
        'rating',
        'status',
        'tgl_mulai',
        'tgl_selesai',
        'kapasitas',
        'foto_kursus'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }

    public function kurikulum()
    {
        return $this->hasMany(Kurikulum::class, 'kursus_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'kursus_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function ratingKursus()
    {
        return $this->hasMany(RatingKursus::class, 'kursus_id', 'kursus_id');
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'kursus_id', 'kursus_id');
    }
}
