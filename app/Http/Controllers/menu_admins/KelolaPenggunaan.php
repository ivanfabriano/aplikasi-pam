<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use App\Models\Tarif;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KelolaPenggunaan extends Controller
{
    public function index(Request $request)
    {
        $id_pelanggan = $request->input('id_pelanggan');
        $id_filter = null;
        $pelanggan = null;
        $last_record_penggunaan = null;

        Carbon::setLocale('id');
        $currentMonth = Carbon::now()->translatedFormat('F');

        if ($id_pelanggan) {
            $id_filter = explode('-', $id_pelanggan);
            $id_filter = $id_filter[0];
        }

        $list_pelanggans = Pelanggan::all();


        if ($id_filter) {
            $pelanggan = Pelanggan::firstWhere('id_pelanggan', $id_filter);

            $last_record_penggunaan = Penggunaan::where('id_pelanggan', $id_filter)
                ->orderBy('id', 'desc')
                ->first();

            $pelanggan->bulan_penggunaan = $last_record_penggunaan ? $last_record_penggunaan->bulan_penggunaan : $currentMonth;
            $pelanggan->meter_awal = $last_record_penggunaan ? $last_record_penggunaan->meter_akhir : 0;
        }

        return view('content.menu-admin.kelola-penggunaan', compact('pelanggan', 'list_pelanggans'));
    }

    public function store(Request $request)
    {
        $id_pelanggan = $request->input('id_pelanggan');
        $id_pelanggan = explode('-', $id_pelanggan)[0];
        $no_meter = $request->input('no_meter');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $bulan_penggunaan = $request->input('bulan_penggunaan');
        $meter_awal = $request->input('meter_awal');
        $meter_akhir = $request->input('meter_akhir');
        $tanggal_pengecekan = $request->input('tanggal_pengecekan');

        $pelanggan = Pelanggan::firstWhere('id_pelanggan', $id_pelanggan);
        $tarif = Tarif::firstWhere('kode_tarif', $pelanggan->jenis_tarif);

        $cek_tagihan_data = new CekTagihan();
        $cek_tagihan_data->id_pembayaran = str_pad(mt_rand(0, 999999999), 9, '0', STR_PAD_LEFT);;
        $cek_tagihan_data->id_pelanggan = $id_pelanggan;
        $cek_tagihan_data->nama_pelanggan = $nama_pelanggan;
        $cek_tagihan_data->waktu_bayar = $currentDate = Carbon::now('Asia/Jakarta');
        $cek_tagihan_data->bulan_tagihan = $bulan_penggunaan;
        $cek_tagihan_data->meter_awal = $meter_awal;
        $cek_tagihan_data->meter_akhir = $meter_akhir;
        $cek_tagihan_data->tarif = $tarif->tarif;
        $cek_tagihan_data->jumlah_bayar = ($meter_akhir - $meter_awal) * $tarif->tarif;
        $cek_tagihan_data->biaya_admin = $tarif->abonemen;
        $cek_tagihan_data->bayar = 0;
        $cek_tagihan_data->kembali = 0;
        $cek_tagihan_data->total_akhir = (($meter_akhir - $meter_awal) * $tarif->tarif) + $tarif->abonemen;
        $cek_tagihan_data->save();

        $penggunaan_data = new Penggunaan();
        $penggunaan_data->id_pelanggan = $id_pelanggan;
        $penggunaan_data->no_meter = $no_meter;
        $penggunaan_data->nama_pelanggan = $nama_pelanggan;
        $penggunaan_data->bulan_penggunaan = $bulan_penggunaan;
        $penggunaan_data->meter_awal = $meter_awal;
        $penggunaan_data->meter_akhir = $meter_akhir;
        $penggunaan_data->tanggal_pengecekan = $tanggal_pengecekan;
        $penggunaan_data->petugas = 'Ivan Fabriano';
        $penggunaan_data->save();

        return redirect()->route('pengelolaan-input-penggunaan')->with('success', 'Data penggunaan berhasil disimpan.');
    }
}
