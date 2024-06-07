<?php

namespace App\Http\Controllers\menu_agents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatPembayaran extends Controller
{
    public function index()
    {
        return view('content.menu-agent.riwayat-pembayaran');
    }
}
