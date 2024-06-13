<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class KelolaDaftarPenggunaan extends Controller
{
    public function index(Request $request)
    {
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
                $list_tagihan = CekTagihan::join('penggunaans', 'cek_tagihans.id_pembayaran', '=', 'penggunaans.id_pembayaran')
                    ->where('penggunaans.id_pelanggan', $info_pelanggan->id_pelanggan)
                    ->where('status_bayar', false)
                    ->select('cek_tagihans.*', 'penggunaans.tanggal_pengecekan')
                    ->get();
            }
        } else {
            $list_tagihan = CekTagihan::join('penggunaans', 'cek_tagihans.id_pembayaran', '=', 'penggunaans.id_pembayaran')
                ->where('status_bayar', false)
                ->select('cek_tagihans.*', 'penggunaans.tanggal_pengecekan', 'penggunaans.id as id_penggunaan')
                ->get();
        }

        return view('content.menu-admin.kelola-daftar-penggunaan', compact('list_tagihan', 'pelanggans'));
    }
}
