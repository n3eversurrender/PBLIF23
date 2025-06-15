<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';
    protected $primaryKey = 'perusahaan_id';

    protected $fillable = [
        'pengguna_id',
        'deskripsi',
        'visi',
        'misi',
        'layanan',
        'npwp',
        'akta_pendirian',
        'izin_operasional',
        'sertifikasi_bnsp',
        'file_npwp',
        'file_akta_pendirian',
        'file_izin_operasional',
        'file_sertifikasi_bnsp',
    ];

    /**
     * Relasi ke data pengguna (akun perusahaan)
     */
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }

    /**
     * Relasi ke rating perusahaan
     */
    public function ratingPerusahaan()
    {
        return $this->hasMany(RatingPerusahaan::class, 'perusahaan_id', 'perusahaan_id');
    }
}
