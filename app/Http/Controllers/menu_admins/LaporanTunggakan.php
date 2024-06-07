<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanTunggakan extends Controller
{
    public function index()
    {
        return view('content.menu-admin.laporan-tunggakan');
    }
}
