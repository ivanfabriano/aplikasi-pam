<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanTagihanPerbulan extends Controller
{
    public function index()
    {
        return view('content.menu-admin.laporan-tagihan-perbulan');
    }
}
