<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class CetakPelanggan extends Controller
{
    public function index()
    {
        $pelanggan = [];
        for ($i = 1; $i <= 200; $i++) {
            $pelanggan[] = [
                'no_meter' =>  $i,
                'nama_pelanggan' => 'Ivan Fabriano ' . $i,
                'meter_awal' => $i,
                'meter_akhir' => $i,
                'kubik' => $i,
            ];
        }

        return view('content.menu-admin.cetak-pelanggan', compact('pelanggan'));
    }
}
