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

        if ($id_pelanggan && substr_count($id_pelanggan, '-') != 2) {
            return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan');
        }

        $no_meter = null;
        $nama_pelanggan = null;
        $alamat_pelanggan = null;
        $list_tagihan = null;
        $info_pelanggan = null;

        // dd($id_pelanggan);

        $pelanggans = Pelanggan::all();

        if ($id_pelanggan) {
            $no_meter = explode('-', $id_pelanggan)[0];
            $nama_pelanggan = explode('-', $id_pelanggan)[1];
            $alamat_pelanggan = explode('-', $id_pelanggan)[2];
        }

        if ($no_meter && $nama_pelanggan && $alamat_pelanggan) {
            $info_pelanggan = Pelanggan::where('no_meter', $no_meter)
                ->where('nama_pelanggan', $nama_pelanggan)
                ->where('alamat_pelanggan', $alamat_pelanggan)
                ->first();

            if ($info_pelanggan) {
                $list_tagihan = ModelsCekTagihan::where('status_bayar', false)
                    ->where('id_pelanggan', $info_pelanggan->id_pelanggan)
                    ->get();
            } else {
                return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan');
            }
        }

        return view('content.menu-agent.cek-tagihan', compact('list_tagihan', 'info_pelanggan', 'pelanggans'));
    }
}
