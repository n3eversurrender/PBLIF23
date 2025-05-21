<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'pendaftaran_id';

    protected $fillable = [
        'pengguna_id',
        'kursus_id',
        'peserta_id',
        'tgl_pendaftaran',
        'status_pendaftaran',
        'status_pembayaran',
        'komentar',
        'rating'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'kursus_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'pendaftaran_id');
    }
}
