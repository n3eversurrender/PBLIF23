<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'rating_perusahaan';
    protected $primaryKey = 'rating_perusahaan_id';

    protected $fillable = [
        'pemberi_id',
        'perusahaan_id',
        'rating',
        'komentar',
    ];

    // Relasi ke pengguna pemberi rating
    public function pemberi()
    {
        return $this->belongsTo(Pengguna::class, 'pemberi_id', 'pengguna_id');
    }

    // Relasi ke perusahaan yang dinilai
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'perusahaan_id');
    }
}
