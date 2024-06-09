<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class RiwayatTransaksi extends Controller
{
    public function index($id_pelanggan = null)
    {
        $list_tagihan = CekTagihan::where('status_bayar', true)->get();
        $info_pelanggan = null;

        if ($id_pelanggan) {
            $list_tagihan = CekTagihan::where('id_pelanggan', $id_pelanggan)
                ->where('status_bayar', true)
                ->get();

            $info_pelanggan = Pelanggan::firstWhere('id_pelanggan', $id_pelanggan);
        }


        return view('content.menu-admin.riwayat-transaksi', compact('list_tagihan', 'info_pelanggan'));
    }
}
