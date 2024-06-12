<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class RiwayatTransaksi extends Controller
{
    public function index(Request $request, $id_pelanggan = null)
    {
        $list_tagihan = CekTagihan::where('status_bayar', true)->get();
        $id_name_filter = $request->input('id_name_filter');
        $id_filter = null;
        $nama_pelanggan = null;
        $alamat_pelanggan = null;

        if ($id_name_filter) {
            $id_filter = explode('-', $id_name_filter)[0];
            $nama_pelanggan = explode('-', $id_name_filter)[1];
            $alamat_pelanggan = explode('-', $id_name_filter)[2];
        }
        $info_pelanggan = null;

        $list_pelanggans = Pelanggan::all();

        if ($id_pelanggan) {
            $list_tagihan = CekTagihan::where('id_pelanggan', $id_pelanggan)
                ->where('status_bayar', true)
                ->get();

            $info_pelanggan = Pelanggan::firstWhere('id_pelanggan', $id_pelanggan);
        }

        if ($id_name_filter) {
            $pelanggan_data = Pelanggan::where('no_meter', $id_filter)
                ->where('nama_pelanggan', $nama_pelanggan)
                ->where('alamat_pelanggan', $alamat_pelanggan)
                ->first();

            if ($pelanggan_data) {
                $list_tagihan = CekTagihan::where('id_pelanggan', $pelanggan_data->id_pelanggan)
                    ->where('status_bayar', true)
                    ->get();
            }

            $info_pelanggan = Pelanggan::firstWhere('id_pelanggan', $id_pelanggan);
        }


        return view('content.menu-admin.riwayat-transaksi', compact('list_tagihan', 'info_pelanggan', 'list_pelanggans'));
    }

    public function rollback($id)
    {
        $info_tagihan = CekTagihan::find($id);

        if ($info_tagihan) {
            $info_tagihan->waktu_bayar = null;
            $info_tagihan->bayar = 0;
            $info_tagihan->kembali = 0;
            $info_tagihan->denda = 0;
            $info_tagihan->status_bayar = false;

            $info_tagihan->save();

            return redirect()->route('pengelolaan-riwayat-transaksi')->with('success', 'Pembayaran berhasil di-rollback.');
        } else {
            return redirect()->route('pengelolaan-riwayat-transaksi')->with('error', 'Data tidak ditemukan.');
        }
    }
}
