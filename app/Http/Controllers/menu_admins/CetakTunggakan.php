<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Denda;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CetakTunggakan extends Controller
{
    public function index()
    {
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

        Carbon::setLocale('id');
        $currentDate = Carbon::now();
        $currentMonthYear = $currentDate->format('F Y');
        $currentMonthYearIndo = $currentDate->translatedFormat('F Y');
        $date = Carbon::createFromFormat('F Y', $currentMonthYear);
        $list_tunggakan = [];
        $dataIndex = [];

        $fourMonthsAgo = [];
        $monthOnlyAgo = [];
        for ($i = 0; $i <= 3; $i++) {
            $fourMonthsAgo[] = $date->copy()->subMonths($i)->translatedFormat('F Y');
            $monthOnlyAgo[] = $date->copy()->subMonths($i)->translatedFormat('F');
        }
        $monthOnlyAgo = array_reverse($monthOnlyAgo);

        $tagihans = CekTagihan::join('pelanggans', 'pelanggans.id_pelanggan', '=', 'cek_tagihans.id_pelanggan')
            ->whereIn(DB::raw("CONCAT(bulan_tagihan, ' ', tahun_tagihan)"), $fourMonthsAgo)
            ->select('pelanggans.id_pelanggan', 'pelanggans.nama_pelanggan', 'pelanggans.no_meter', 'pelanggans.tenggang', 'cek_tagihans.bulan_tagihan', 'cek_tagihans.tahun_tagihan', 'cek_tagihans.total_akhir')
            ->get();


        if ($tagihans) {
            foreach ($tagihans as $tagihan) {
                $key = $tagihan['no_meter'] . '|' . $tagihan['nama_pelanggan'];
                $tanggal = $tagihan->tenggang;
                $tahun = $tagihan->tahun_tagihan;
                $bulan =  $bulanIndonesia[$tagihan->bulan_tagihan];
                $tenggang_pembayaran = "$tahun-$bulan-$tanggal";
                $tenggang_date = Carbon::createFromFormat('Y-m-d', $tenggang_pembayaran);

                if ($currentDate->isBefore($tenggang_date) || $currentDate->equalTo($tenggang_date)) {
                    $tagihan->denda = 0;
                } else {
                    $differenceInDays = $tenggang_date->diffInDays($currentDate);
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

                if (!isset($dataIndex[$key])) {
                    $dataIndex[$key] = count($list_tunggakan);
                    $list_tunggakan[] = [
                        'no_meter' => $tagihan->no_meter,
                        'nama_pelanggan' => $tagihan->nama_pelanggan,
                        'jumlah_akhir' => 0
                    ];
                }
                $list_tunggakan[$dataIndex[$key]][$tagihan->bulan_tagihan] = $tagihan->total_akhir;
                $list_tunggakan[$dataIndex[$key]]['jumlah_akhir'] += $tagihan->total_akhir;
            }
        }

        return view('content.menu-admin.cetak-tunggakan', compact('monthOnlyAgo', 'list_tunggakan', 'currentMonthYearIndo'));
    }
}
