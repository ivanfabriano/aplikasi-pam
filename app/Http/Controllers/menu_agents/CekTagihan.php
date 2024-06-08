<?php

namespace App\Http\Controllers\menu_agents;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan as ModelsCekTagihan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class CekTagihan extends Controller
{
    public function index(Request $request)
    {
        $id_pelanggan = $request->input('id_pelanggan');
        $id_filter = null;
        $list_tagihan = null;
        $info_pelanggan = null;

        // dd($id_pelanggan);

        $pelanggans = Pelanggan::all();

        if ($id_pelanggan) {
            $id_filter = explode('-', $id_pelanggan);
            $id_filter = $id_filter[0];
        }

        if ($id_filter) {
            $list_tagihan = ModelsCekTagihan::where('status_bayar', false)
                ->where('id_pelanggan', $id_filter)
                ->get();

            $info_pelanggan = Pelanggan::firstWhere('id_pelanggan', $id_filter);
        }

        return view('content.menu-agent.cek-tagihan', compact('list_tagihan', 'info_pelanggan', 'pelanggans'));
    }
}
