<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Denda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanTunggakan extends Controller
{
    public function index()
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

        $current_date = Carbon::now();

        $query = "
            SELECT *
            FROM (
            select 
            p.id_pelanggan,
            p.tenggang,
            MAX(p.nama_pelanggan) nama_pelanggan,
            MAX(p.alamat_pelanggan) alamat_pelanggan,
            COUNT(*) banyak_tunggakan,
            JSON_ARRAYAGG(CONCAT(ct.bulan_tagihan, ' ', YEAR(ct.created_at))) bulan_tertunggak,
            SUM((ct.meter_akhir-ct.meter_awal)) jumlah_meter,
            MAX(ct.tarif) tarif,
            SUM(ct.total_akhir) total_akhir
            from pelanggans p 
            join cek_tagihans ct on ct.id_pelanggan = p.id_pelanggan
            where ct.status_bayar = FALSE 
            group by p.id_pelanggan 
            )sub1
            WHERE banyak_tunggakan >= 3
        ";

        $list_tagihan = DB::select($query);

        foreach ($list_tagihan as $tagihan) {
            $tanggal = $tagihan->tenggang;
            $total_denda = 0;

            $list_tagihan_per_user = CekTagihan::where('status_bayar', false)
                ->where('id_pelanggan', $tagihan->id_pelanggan)
                ->get();

            if ($list_tagihan_per_user) {
                foreach ($list_tagihan_per_user as $tagihan_user) {
                    $bulan =  $bulanIndonesia[$tagihan_user->bulan_tagihan];
                    $tahun = Carbon::parse($tagihan_user->created_at)->year;
                    $tenggang_pembayaran = "$tahun-$bulan-$tanggal";
                    $tenggang_date = Carbon::createFromFormat('Y-m-d', $tenggang_pembayaran);

                    if ($current_date->isBefore($tenggang_date) || $current_date->equalTo($tenggang_date)) {
                        $total_denda += 0;
                    } else {
                        $differenceInDays = $tenggang_date->diffInDays($current_date);
                        $info_denda = Denda::where('hari_awal', '<', $differenceInDays)
                            ->where('hari_akhir', '>', $differenceInDays)
                            ->first();
                        if ($info_denda) {
                            $total_denda += $info_denda->denda;
                        } else {
                            $total_denda += 0;
                        }
                    }
                }
            }

            $tagihan->bulan_tertunggak = json_decode($tagihan->bulan_tertunggak, true);
            $tagihan->total_akhir = $tagihan->total_akhir + $total_denda;
        }

        return view('content.menu-admin.laporan-tunggakan', compact('list_tagihan'));
    }
}
