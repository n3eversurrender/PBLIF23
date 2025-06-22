<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'foto_perusahaan';
    protected $primaryKey = 'foto_id';

    protected $fillable = [
        'perusahaan_id',
        'file_path',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'perusahaan_id');
    }
}
