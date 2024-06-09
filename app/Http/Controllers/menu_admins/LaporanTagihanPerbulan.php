<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use Illuminate\Http\Request;

class LaporanTagihanPerbulan extends Controller
{
    public function index(Request $request)
    {
        $bulan_tagihan = $request->input('bulan_tagihan');
        $tahun_tagihan = $request->input('tahun_tagihan');
        $status_bayar = $request->input('status_bayar');
        $status_bayar = $status_bayar == 'on' ? true : false;
        $list_tagihan = null;

        if ($bulan_tagihan && $tahun_tagihan) {
            $list_tagihan = CekTagihan::where('bulan_tagihan', $bulan_tagihan)
                ->whereYear('created_at', $tahun_tagihan)
                ->where('status_bayar', $status_bayar)
                ->get();
        }

        return view('content.menu-admin.laporan-tagihan-perbulan', compact('list_tagihan'));
    }
}
