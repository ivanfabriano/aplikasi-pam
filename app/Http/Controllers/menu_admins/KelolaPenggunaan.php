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
    public function index(Request $request, $id = null)
    {
        $months = [
            'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4,
            'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8,
            'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
        ];

        $id_pelanggan = $request->input('id_pelanggan');

        if ($id_pelanggan && substr_count($id_pelanggan, '-') != 2) {
            return redirect()->route('pengelolaan-input-penggunaan')->with('error', 'Mohon masukan informasi pelanggan lagi.');
        }

        $id_filter = null;
        $nama_pelanggan = null;
        $alamat_pelanggan = null;
        $pelanggan = null;
        $last_record_penggunaan = null;
        $edit_data = null;

        Carbon::setLocale('id');
        $currentMonth = Carbon::now()->translatedFormat('F');

        if ($id_pelanggan) {
            $id_filter = explode('-', $id_pelanggan)[0];
            $nama_pelanggan = explode('-', $id_pelanggan)[1];
            $alamat_pelanggan = explode('-', $id_pelanggan)[2];
        }
        $current_date_now = Carbon::now()->toDateString();

        $list_pelanggans = Pelanggan::all();

        if ($id_filter) {
            $pelanggan = Pelanggan::where('no_meter', $id_filter)
                ->where('nama_pelanggan', $nama_pelanggan)
                ->where('alamat_pelanggan', $alamat_pelanggan)
                ->first();

            $last_record_penggunaan = Penggunaan::where('id_pelanggan', $pelanggan->id_pelanggan)
                ->orderBy('id', 'desc')
                ->first();

            if ($last_record_penggunaan) {
                $currentMonthIndex = $months[ucfirst(strtolower($last_record_penggunaan->bulan_penggunaan))];
                $current_date = Carbon::createFromDate(null, $currentMonthIndex, 1);
                $nextMonthDate = $current_date->addMonth();
                $nextMonth = $nextMonthDate->translatedFormat('F');
            }

            $pelanggan->work_date = $current_date_now;
            $pelanggan->bulan_penggunaan = $last_record_penggunaan ? $nextMonth : $currentMonth;
            $pelanggan->meter_awal = $last_record_penggunaan ? $last_record_penggunaan->meter_akhir : 0;
        }

        if ($id) {
            $edit_data = Penggunaan::find($id);
            if ($edit_data) {
                $info_pelanggan = Pelanggan::where('id_pelanggan', $edit_data->id_pelanggan)->first();
                $edit_data->alamat_pelanggan = $info_pelanggan->alamat_pelanggan;
            }
        }

        return view('content.menu-admin.kelola-penggunaan', compact('pelanggan', 'list_pelanggans', 'edit_data'));
    }

    public function store(Request $request)
    {
        $namaBulanIndonesia = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $id_pelanggan = $request->input('id_pelanggan');

        if ($id_pelanggan) {
            $id_filter = explode('-', $id_pelanggan)[0];
            $nama_pelanggan = explode('-', $id_pelanggan)[1];
            $alamat_pelanggan = explode('-', $id_pelanggan)[2];
        }

        $no_meter = $request->input('no_meter');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $bulan_penggunaan = $request->input('bulan_penggunaan');
        $meter_awal = $request->input('meter_awal');
        $meter_akhir = $request->input('meter_akhir');
        $tanggal_pengecekan = $request->input('tanggal_pengecekan');

        $pelanggan = Pelanggan::where('no_meter', $id_filter)
            ->where('nama_pelanggan', $nama_pelanggan)
            ->where('alamat_pelanggan', $alamat_pelanggan)
            ->first();

        $tarif = Tarif::firstWhere('kode_tarif', $pelanggan->jenis_tarif);

        $current_date = Carbon::parse($tanggal_pengecekan);
        $next_month_date = $current_date->addMonth();
        $nama_bulan_berikutnya = $namaBulanIndonesia[$next_month_date->month - 1];

        $cek_tagihan_data = new CekTagihan();
        $cek_tagihan_data->id_pembayaran = str_pad(mt_rand(0, 999999999), 9, '0', STR_PAD_LEFT);;
        $cek_tagihan_data->id_pelanggan = $pelanggan->id_pelanggan;
        $cek_tagihan_data->nama_pelanggan = $pelanggan->nama_pelanggan;
        $cek_tagihan_data->bulan_tagihan = $nama_bulan_berikutnya;
        $cek_tagihan_data->meter_awal = $meter_awal;
        $cek_tagihan_data->meter_akhir = $meter_akhir;
        $cek_tagihan_data->tarif = $tarif->tarif;
        $cek_tagihan_data->jumlah_bayar = ($meter_akhir - $meter_awal) * $tarif->tarif;
        $cek_tagihan_data->biaya_admin = $tarif->abonemen;
        $cek_tagihan_data->bayar = 0;
        $cek_tagihan_data->kembali = 0;
        $cek_tagihan_data->petugas = 'Ivan Fabriano';
        $cek_tagihan_data->total_akhir = (($meter_akhir - $meter_awal) * $tarif->tarif) + $tarif->abonemen;
        $cek_tagihan_data->save();

        $penggunaan_data = new Penggunaan();
        $penggunaan_data->id_pelanggan = $pelanggan->id_pelanggan;
        $penggunaan_data->id_pembayaran = $cek_tagihan_data->id_pembayaran;
        $penggunaan_data->no_meter = $pelanggan->no_meter;
        $penggunaan_data->nama_pelanggan = $pelanggan->nama_pelanggan;
        $penggunaan_data->bulan_penggunaan = $bulan_penggunaan;
        $penggunaan_data->meter_awal = $meter_awal;
        $penggunaan_data->meter_akhir = $meter_akhir;
        $penggunaan_data->tanggal_pengecekan = $tanggal_pengecekan;
        $penggunaan_data->petugas = 'Ivan Fabriano';
        $penggunaan_data->save();

        return redirect()->route('pengelolaan-input-penggunaan')->with('success', 'Data penggunaan berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {

        $id_pelanggan = $request->input('id_pelanggan');

        if ($id_pelanggan) {
            $id_filter = explode('-', $id_pelanggan)[0];
            $nama_pelanggan = explode('-', $id_pelanggan)[1];
            $alamat_pelanggan = explode('-', $id_pelanggan)[2];
        }

        $meter_awal = $request->input('meter_awal');
        $meter_akhir = $request->input('meter_akhir');
        $tanggal_pengecekan = $request->input('tanggal_pengecekan');

        $pelanggan = Pelanggan::where('no_meter', $id_filter)
            ->where('nama_pelanggan', $nama_pelanggan)
            ->where('alamat_pelanggan', $alamat_pelanggan)
            ->first();

        $tarif = Tarif::firstWhere('kode_tarif', $pelanggan->jenis_tarif);

        $penggunaan_data = Penggunaan::firstWhere('id', $id);
        $penggunaan_data->meter_awal = $meter_awal;
        $penggunaan_data->meter_akhir = $meter_akhir;
        $penggunaan_data->tanggal_pengecekan = $tanggal_pengecekan;
        $penggunaan_data->petugas = 'Ivan Fabriano';
        $penggunaan_data->save();

        $cek_tagihan_data = CekTagihan::firstWhere('id_pembayaran', $penggunaan_data->id_pembayaran);
        $cek_tagihan_data->meter_awal = $meter_awal;
        $cek_tagihan_data->meter_akhir = $meter_akhir;
        $cek_tagihan_data->jumlah_bayar = ($meter_akhir - $meter_awal) * $tarif->tarif;
        $cek_tagihan_data->petugas = 'Ivan Fabriano';
        $cek_tagihan_data->total_akhir = (($meter_akhir - $meter_awal) * $tarif->tarif) + $tarif->abonemen;
        $cek_tagihan_data->save();

        return redirect()->route('pengelolaan-daftar-penggunaan')->with('success', 'Data penggunaan berhasil diubah.');
    }

    public function reset($id)
    {
        $pelanggan = Pelanggan::find($id);

        $now = Carbon::now();
        $monthName = $now->translatedFormat('F');

        $penggunaan_data = new Penggunaan();
        $penggunaan_data->id_pelanggan = $pelanggan->id_pelanggan;
        $penggunaan_data->no_meter = $pelanggan->no_meter;
        $penggunaan_data->nama_pelanggan = $pelanggan->nama_pelanggan;
        $penggunaan_data->bulan_penggunaan = $monthName;
        $penggunaan_data->meter_awal = 0;
        $penggunaan_data->meter_akhir = 0;
        $penggunaan_data->tanggal_pengecekan = Carbon::now();
        $penggunaan_data->petugas = "Sistem reset";
        $penggunaan_data->save();

        return redirect()->route('datamaster-kelola-pelanggan')->with('success', 'Data penggunaan berhasil disimpan.');
    }
}
