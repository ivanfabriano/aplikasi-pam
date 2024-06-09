<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanTunggakan extends Controller
{
    public function index()
    {
        $query = "
            SELECT *
            FROM (
            select 
            p.id_pelanggan,
            MAX(p.nama_pelanggan) nama_pelanggan,
            MAX(p.alamat_pelanggan) alamat_pelanggan,
            COUNT(*) banyak_tunggakan,
            JSON_ARRAYAGG(CONCAT(ct.bulan_tagihan, ' ', YEAR(ct.waktu_bayar))) bulan_tertunggak,
            SUM((ct.meter_akhir-ct.meter_awal)) jumlah_meter,
            MAX(ct.tarif) tarif,
            SUM(ct.jumlah_bayar) jumlah_bayar
            from pelanggans p 
            join cek_tagihans ct on ct.id_pelanggan = p.id_pelanggan
            where ct.status_bayar = FALSE 
            group by p.id_pelanggan 
            )sub1
            WHERE banyak_tunggakan >= 3
        ";

        $list_tagihan = DB::select($query);

        foreach ($list_tagihan as $tagihan) {
            $tagihan->bulan_tertunggak = json_decode($tagihan->bulan_tertunggak, true);
        }

        return view('content.menu-admin.laporan-tunggakan', compact('list_tagihan'));
    }
}
