<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialisasi extends Model
{
    use HasFactory;

    protected $table = 'spesialisasi';
    protected $primaryKey = 'spesialisasi_id';

    protected $fillable = [
        'pelatih_id', 'nama_spesialisasi'
    ];

    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class, 'pelatih_id');
    }
}
