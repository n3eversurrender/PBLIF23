<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin'; // Nama tabel
    protected $primaryKey = 'admin_id'; // Primary key
    protected $fillable = ['username', 'kata_sandi', 'role']; // Kolom yang dapat diisi
    protected $hidden = [
        'kata_sandi',
    ];
}
