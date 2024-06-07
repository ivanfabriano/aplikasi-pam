<?php

namespace App\Http\Controllers\menu_agents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CekTagihan extends Controller
{
    public function index()
    {
        return view('content.menu-agent.cek-tagihan');
    }
}
