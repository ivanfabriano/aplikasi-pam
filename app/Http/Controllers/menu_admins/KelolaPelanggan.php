<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaPelanggan extends Controller
{
    public function index(Request $request, $id = null)
    {
        $id_name_filter = $request->input('id_name_filter');
        $telat_bayar = $request->input('telat_bayar');
        $telat_bayar = $telat_bayar == 'on' ? true : false;
        $id_filter = null;

        if ($id_name_filter) {
            $id_filter = explode('-', $id_name_filter);
            $id_filter = $id_filter[0];
        }

        $list_pelanggans = Pelanggan::all();

        $last_pelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->first();
        $last_id_pelanggan = $last_pelanggan->id_pelanggan + 1;


        DB::statement("SET @bulan_indonesia := 'Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember'");
        DB::statement("SET @kode_bulan := '01,02,03,04,05,06,07,08,09,10,11,12'");

        $query = "
        SELECT 
        p.id ,
        p.id_pelanggan ,
        p.no_meter ,
        p.nama_pelanggan ,
        p.alamat_pelanggan ,
        p.jenis_tarif ,
        p.tenggang ,
        jct.tertunggak
        FROM pelanggans p 
        left join (
        SELECT 
            p2.id,
            CASE 
                when count(*) > 0 then true
                else false
            END tertunggak
        FROM cek_tagihans ct 
        right join pelanggans p2 on p2.id_pelanggan = ct.id_pelanggan
        where ct.status_bayar = false and 
            STR_TO_DATE(
                CONCAT(
                    p2.tenggang , ' ', 
                    SUBSTRING_INDEX(SUBSTRING_INDEX(@kode_bulan COLLATE utf8mb4_unicode_ci, ',', FIND_IN_SET(bulan_tagihan  COLLATE utf8mb4_unicode_ci, @bulan_indonesia COLLATE utf8mb4_unicode_ci)), ',', -1), ' ',
                    YEAR(ct.created_at)
                ), 
                '%e %m %Y'
            ) < CURDATE()
        group by p2.id
        )jct on jct.id = p.id
        WHERE p.id is not null
        ";

        $bindings = [];

        if ($telat_bayar) {
            $query .= " AND tertunggak = :telat_bayar";
            $bindings['telat_bayar'] = $telat_bayar;
        }

        if ($id_filter) {
            $query .= " AND id_pelanggan = :id_filter";
            $bindings['id_filter'] = $id_filter;
        }

        $pelanggans = DB::select($query, $bindings);

        $tarifs = Tarif::all();
        $initial_pelanggan = null;
        if ($id) {
            $initial_pelanggan = Pelanggan::find($id);
        }

        return view('content.menu-admin.kelola-pelanggan', compact('pelanggans', 'initial_pelanggan', 'tarifs', 'list_pelanggans', 'last_id_pelanggan'));
    }

    public function store(Request $request)
    {
        $id_pelanggan = $request->input('id_pelanggan');
        $no_meter = $request->input('no_meter');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $alamat_pelanggan = $request->input('alamat_pelanggan');
        $tenggang = $request->input('tenggang');
        $jenis_tarif = $request->input('jenis_tarif');

        $pelanggan_data = new Pelanggan();
        $pelanggan_data->id_pelanggan = $id_pelanggan;
        $pelanggan_data->no_meter = $no_meter;
        $pelanggan_data->nama_pelanggan = $nama_pelanggan;
        $pelanggan_data->alamat_pelanggan = $alamat_pelanggan;
        $pelanggan_data->tenggang = $tenggang;
        $pelanggan_data->jenis_tarif = $jenis_tarif;
        $pelanggan_data->save();

        return redirect()->route('datamaster-kelola-pelanggan')->with('success', 'Data pelanggan berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        if ($pelanggan) {
            $pelanggan->delete();
            return redirect()->route('datamaster-kelola-pelanggan')->with('success', 'Data pelanggan berhasil dihapus.');
        }

        return redirect()->route('datamaster-kelola-pelanggan')->with('error', 'Data pelanggan tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $id_pelanggan = $request->input('id_pelanggan');
        $no_meter = $request->input('no_meter');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $alamat_pelanggan = $request->input('alamat_pelanggan');
        $tenggang = $request->input('tenggang');
        $jenis_tarif = $request->input('jenis_tarif');

        $pelanggan_data = Pelanggan::find($id);

        if ($pelanggan_data) {
            $pelanggan_data->id_pelanggan = $id_pelanggan;
            $pelanggan_data->no_meter = $no_meter;
            $pelanggan_data->nama_pelanggan = $nama_pelanggan;
            $pelanggan_data->alamat_pelanggan = $alamat_pelanggan;
            $pelanggan_data->tenggang = $tenggang;
            $pelanggan_data->jenis_tarif = $jenis_tarif;

            $pelanggan_data->save();

            return redirect()->route('datamaster-kelola-pelanggan')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->route('datamaster-kelola-pelanggan')->with('error', 'Data tidak ditemukan.');
        }
    }
}
