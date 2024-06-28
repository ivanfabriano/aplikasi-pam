<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPelanggan extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $bulanIndonesiaKeInggris = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        Carbon::setLocale('id');

        if ($bulan && $tahun) {
            $bulanInggris = $bulanIndonesiaKeInggris[$bulan];
            $dateStringInggris = $bulanInggris . ' ' . $tahun;
            $carbonDate = Carbon::createFromFormat('F Y', $dateStringInggris);
            $startOfMonth = $carbonDate->startOfMonth()->format('Y-m-d');
            $endOfMonth = $carbonDate->endOfMonth()->format('Y-m-d');

            $subQuery = DB::table('penggunaans as p2')
                ->select('p2.id_pelanggan', 'p2.meter_awal', 'p2.meter_akhir')
                ->join('pelanggans as p3', 'p3.id_pelanggan', '=', 'p2.id_pelanggan')
                ->whereBetween('p2.tanggal_pengecekan', [$startOfMonth, $endOfMonth])
                ->groupBy('p2.id_pelanggan', 'p2.meter_awal', 'p2.meter_akhir');

            // Main query
            $penggunaan = DB::table('pelanggans as p')
                ->select('p.id', 'p.no_meter', 'p.nama_pelanggan', 'sub1.meter_awal', 'sub1.meter_akhir')
                ->leftJoinSub($subQuery, 'sub1', function ($join) {
                    $join->on('sub1.id_pelanggan', '=', 'p.id_pelanggan');
                })
                ->orderByRaw('CAST(p.no_meter AS UNSIGNED) ASC')
                ->get();

            return redirect()->route('cetak-pelanggan')->with(['penggunaan' => $penggunaan, 'bulan' => $bulan, 'tahun' => $tahun]);
        }

        return view('content.menu-admin.laporan-pelanggan');
    }
}
