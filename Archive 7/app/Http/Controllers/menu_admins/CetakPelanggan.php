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
        return view('content.menu-admin.cetak-pelanggan');
    }
}
