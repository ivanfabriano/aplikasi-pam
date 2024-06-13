<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pelanggan',
        'no_meter',
        'nama_pelanggan',
        'bulan_penggunaan',
        'meter_awal',
        'meter_akhir',
        'tanggal_pengecekan'
    ];
}
