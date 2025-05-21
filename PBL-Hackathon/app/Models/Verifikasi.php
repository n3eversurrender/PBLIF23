<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    protected $table = 'verifikasi';  

    protected $primaryKey = 'verifikasi_id';  

    protected $fillable = ['pengguna_id', 'status_verifikasi'];

    // Relasi ke tabel Pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
