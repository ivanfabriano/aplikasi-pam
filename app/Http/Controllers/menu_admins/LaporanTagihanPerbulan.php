<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class LaporanTagihanPerbulan extends Controller
{
    public function index(Request $request)
    {
        $bulan_tagihan = $request->input('bulan_tagihan');
        $tahun_tagihan = $request->input('tahun_tagihan');
        $status_bayar = $request->input('status_bayar');
        $status_bayar = $status_bayar == 'on' ? true : false;
        $filter_pelanggan = $request->input('filter_pelanggan');
        $list_tagihan = null;
        $no_meter = null;
        $nama_pelanggan = null;
        $alamat_pelanggan = null;

        $pelanggans = Pelanggan::all();

        if ($filter_pelanggan) {
            $no_meter = explode('-', $filter_pelanggan)[0];
            $nama_pelanggan = explode('-', $filter_pelanggan)[1];
            $alamat_pelanggan = explode('-', $filter_pelanggan)[2];
        }

        if ($no_meter && $nama_pelanggan) {
            $info_pelanggan = Pelanggan::where('no_meter', $no_meter)
                ->where('nama_pelanggan', $nama_pelanggan)
                ->where('alamat_pelanggan', $alamat_pelanggan)
                ->first();

            if ($info_pelanggan) {
                $list_tagihan = CekTagihan::where('id_pelanggan', $info_pelanggan->id_pelanggan)
                    ->where('status_bayar', $status_bayar)
                    ->get();
            }
        } else {
            $list_tagihan = CekTagihan::where('status_bayar', $status_bayar)
                ->get();
        }

        return view('content.menu-admin.laporan-tagihan-perbulan', compact('list_tagihan', 'pelanggans'));
    }
}
