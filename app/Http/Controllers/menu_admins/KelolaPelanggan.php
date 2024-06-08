<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;

class KelolaPelanggan extends Controller
{
    public function index(Request $request, $id = null)
    {
        $id_name_filter = $request->input('id_name_filter');
        $id_filter = null;

        if ($id_name_filter) {
            $id_filter = explode('-', $id_name_filter);
            $id_filter = $id_filter[0];
        }

        $query = Pelanggan::query();
        $list_pelanggans = Pelanggan::all();

        $last_pelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->first();
        $last_id_pelanggan = $last_pelanggan->id_pelanggan + 1;

        if ($id_filter) {
            $query->where('id_pelanggan', $id_filter);
        }

        $pelanggans = $query->get();

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
