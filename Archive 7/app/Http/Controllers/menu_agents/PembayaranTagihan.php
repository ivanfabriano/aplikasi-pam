<?php

namespace App\Http\Controllers\menu_agents;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Denda;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranTagihan extends Controller
{
    public function index($id_pembayaran)
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

        $info_tagihan = CekTagihan::firstWhere('id_pembayaran', $id_pembayaran);

        if (!$info_tagihan) {
            return redirect()->route('cek-tagihan')->with('error', 'Data pembayaran tidak ditemukan');
        }

        $info_pelanggan = Pelanggan::firstWhere('id_pelanggan', $info_tagihan->id_pelanggan);
        $tanggal = $info_pelanggan->tenggang;
        $bulan =  $bulanIndonesia[$info_tagihan->bulan_tagihan];
        $tahun = Carbon::parse($info_tagihan->created_at)->year;

        $tenggang_pembayaran = "$tahun-$bulan-$tanggal";
        $tenggang_date = Carbon::createFromFormat('Y-m-d', $tenggang_pembayaran);
        $current_date = Carbon::now();

        $info_tagihan->no_meter = $info_pelanggan->no_meter;
        $info_tagihan->waktu_bayar = Carbon::now('Asia/Jakarta');

        if ($current_date->isBefore($tenggang_date) || $current_date->equalTo($tenggang_date)) {
            $info_tagihan->denda = 0;
        } else {
            $differenceInDays = $tenggang_date->diffInDays($current_date);
            $info_denda = Denda::where('hari_awal', '<', $differenceInDays)
                ->where('hari_akhir', '>', $differenceInDays)
                ->first();

            if ($info_denda) {
                $info_tagihan->denda = $info_denda->denda;
                $info_tagihan->total_akhir = $info_denda->denda + $info_tagihan->total_akhir;
            } else {
                $info_tagihan->denda = 0;
            }
        }

        return view('content.menu-agent.pembayaran-tagihan', compact('info_tagihan'));
    }

    public function update(Request $request, $id)
    {
        $denda = $request->input('denda');
        $total_akhir = $request->input('total_akhir');

        $tagihan_data = CekTagihan::find($id);
        $pelanggan = Pelanggan::firstWhere('id_pelanggan', $tagihan_data->id_pelanggan);

        if ($tagihan_data) {
            $tagihan_data->denda = (int) str_replace('.', '', $denda);
            $tagihan_data->total_akhir = (int) str_replace('.', '', $total_akhir);
            $tagihan_data->status_bayar = true;
            $tagihan_data->waktu_bayar = Carbon::now('Asia/Jakarta');

            $tagihan_data->save();

            $tagihan_data->jenis_tarif = $pelanggan->jenis_tarif;
            $tagihan_data->no_meter = $pelanggan->no_meter;

            return redirect()->route('cetak-struk')->with(['success' => 'Pembayaran berhasil', 'tagihan_data' => $tagihan_data]);
        } else {
            return redirect()->route('cek-tagihan')->with('error', 'Pembayaran gagal');
        }
    }
}
