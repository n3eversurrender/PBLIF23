<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    use HasFactory;

    protected $table = 'pelatih';
    protected $primaryKey = 'pelatih_id';

    protected $fillable = [
        'pengguna_id', 'tahun_pengalaman', 'bulan_pengalaman', 'nama_spesialisasi', 'status'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function spesialisasi()
    {
        return $this->hasMany(Spesialisasi::class, 'pelatih_id');
    }

    public function ratingPelatih()
    {
        return $this->hasMany(RatingPelatih::class, 'pelatih_id');
    }
}
