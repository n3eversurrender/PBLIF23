<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'sertifikat';

    // Primary key
    protected $primaryKey = 'sertifikat_id';

    // Kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'pendaftaran_id',
        'kursus_id',
        'nama_kursus',
        'file_sertifikat',
        'nomor_sertifikat',
        'tanggal_terbit',
    ];

    // Relasi ke model Pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'pendaftaran_id');
    }

    // Relasi ke model Kursus
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'kursus_id');
    }
   
}
