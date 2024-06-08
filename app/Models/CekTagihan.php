<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekTagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pembayaran',
        'id_pelanggan',
        'nama_pelanggan',
        'waktu_bayar',
        'bulan_tagihan',
        'meter_awal',
        'meter_akhir',
        'tarif',
        'jumlah_bayar',
        'biaya_admin',
        'total_akhir',
        'bayar',
        'status_bayar'
    ];
}
