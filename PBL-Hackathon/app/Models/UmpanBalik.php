<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmpanBalik extends Model
{
    use HasFactory;

    protected $table = 'umpan_balik';
    protected $primaryKey = 'umpan_balik_id';

    protected $fillable = [
        'nama_komentar',
        'komentar',
    ];
}
