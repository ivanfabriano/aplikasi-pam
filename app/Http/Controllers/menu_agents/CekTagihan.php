<?php

namespace App\Http\Controllers\menu_agents;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan as ModelsCekTagihan;
use App\Models\Denda;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CekTagihan extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        $bulanIndonesia = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        $id_pelanggan = $request->input('id_pelanggan');

        if ($id_pelanggan && substr_count($id_pelanggan, '-') != 2) {
            return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan');
        }

        $no_meter = null;
        $nama_pelanggan = null;
        $alamat_pelanggan = null;
        $list_tagihan = null;
        $info_pelanggan = null;

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
                $tanggal = $info_pelanggan->tenggang;
                $current_date = Carbon::now();

                $list_tagihan = ModelsCekTagihan::where('status_bayar', false)
                    ->where('id_pelanggan', $info_pelanggan->id_pelanggan)
                    ->get();

                if ($list_tagihan) {
                    foreach ($list_tagihan as $tagihan) {
                        $bulan =  $bulanIndonesia[$tagihan->bulan_tagihan];
                        $tahun = $tagihan->tahun_tagihan;
                        $tenggang_pembayaran = "$tahun-$bulan-$tanggal";
                        $tenggang_date = Carbon::createFromFormat('Y-m-d', $tenggang_pembayaran);

                        if ($current_date->isBefore($tenggang_date) || $current_date->equalTo($tenggang_date)) {
                            $tagihan->denda = 0;
                        } else {
                            $differenceInDays = $tenggang_date->diffInDays($current_date);
                            $info_denda = Denda::where('hari_awal', '<', $differenceInDays)
                                ->where('hari_akhir', '>', $differenceInDays)
                                ->first();
                            if ($info_denda) {
                                $tagihan->denda = $info_denda->denda;
                                $tagihan->total_akhir = $info_denda->denda + $tagihan->total_akhir;
                            } else {
                                $tagihan->denda = 0;
                            }
                        }
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan');
            }
        }

        return view('content.menu-agent.cek-tagihan', compact('list_tagihan', 'info_pelanggan', 'pelanggans'));
    }
}
