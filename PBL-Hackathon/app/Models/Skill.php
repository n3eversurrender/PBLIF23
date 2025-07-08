<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skill';
    protected $primaryKey = 'skillmatching_id';

    protected $fillable = [
        'peserta_id',
        'kursus_id',
        'score',
    ];

    public $timestamps = false;

       // Relasi ke Peserta
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }

    // Relasi ke Kursus (kalau mau)
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'kursus_id');
    }

      public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }



}
