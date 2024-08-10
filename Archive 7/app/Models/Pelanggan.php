<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pelanggan',
        'no_meter',
        'nama_pelanggan',
        'alamat_pelanggan',
        'jenis_tarif'
    ];
}
