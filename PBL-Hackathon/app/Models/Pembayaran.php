<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'pembayaran_id';

    protected $fillable = [
        'pendaftaran_id',
        'tgl_pembayaran',
        'metode_pembayaran',
        'jumlah',
        'status',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'midtrans_status',
        'midtrans_response',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}
