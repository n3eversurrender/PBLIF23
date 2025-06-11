<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKursus extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kursus';
    protected $primaryKey = 'jadwal_id';

    protected $fillable = [
        'kursus_id',
        'sesi',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
    ];

    // Relasi ke model Kursus
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'kursus_id');
    }
}
