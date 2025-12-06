<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'nama_pelanggan',
        'no_hp',
        'metode_pembayaran',
        'delivery_method',
        'alamat',
        'total',
    ];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
