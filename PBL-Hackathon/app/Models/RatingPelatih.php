<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingPelatih extends Model
{
    use HasFactory;

    protected $table = 'rating_pelatih';
    protected $primaryKey = 'rating_pelatih_id';

    protected $fillable = [
        'pemberi_id',
        'pengguna_id',
        'rating',
        'komentar'
    ];

    public function pemberi()
    {
        return $this->belongsTo(Pengguna::class, 'pemberi_id');
    }
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }
}
