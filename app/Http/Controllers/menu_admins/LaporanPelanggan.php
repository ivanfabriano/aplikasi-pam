<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

            $penggunaan = Penggunaan::whereBetween('tanggal_pengecekan', [$startOfMonth, $endOfMonth])
                ->orderByRaw('CAST(no_meter AS UNSIGNED) ASC')
                ->get();

            return redirect()->route('cetak-pelanggan')->with(['penggunaan' => $penggunaan, 'bulan' => $bulan, 'tahun' => $tahun]);
        }

        return view('content.menu-admin.laporan-pelanggan');
    }
}
