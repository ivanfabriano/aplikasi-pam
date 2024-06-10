<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaAkun extends Controller
{
    public function index()
    {
        return view('content.menu-admin.kelola-akun');
    }
}
