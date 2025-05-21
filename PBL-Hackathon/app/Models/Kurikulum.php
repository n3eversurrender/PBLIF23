<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $table = 'kurikulum';
    protected $primaryKey = 'kurikulum_id';

    protected $fillable = [
        'kursus_id',
        'nama_topik',
        'deskripsi',
        'durasi',
        'materi'
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'kursus_id');
    }
}
