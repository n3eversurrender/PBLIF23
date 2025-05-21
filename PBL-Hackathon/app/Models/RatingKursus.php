<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingKursus extends Model
{
    use HasFactory;

    // Specify the table name (optional, if it follows Laravel's default naming convention, you can omit this)
    protected $table = 'rating_kursus';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'kursus_id',
        'pengguna_id',
        'rating',
        'komentar',
    ];

    // Define relationships

    // A RatingKursus belongs to a Kursus
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'kursus_id');
    }

    // A RatingKursus belongs to a Pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }
}
