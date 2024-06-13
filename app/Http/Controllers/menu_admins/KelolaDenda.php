<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class KelolaDenda extends Controller
{
    public function index($id = null)
    {
        $dendas = Denda::all();
        $initial_denda = null;
        if ($id) {
            $initial_denda = Denda::find($id);
        }

        return view('content.menu-admin.kelola-denda', compact('dendas', 'initial_denda'));
    }

    public function store(Request $request)
    {
        $hari_awal = $request->input('hari_awal');
        $hari_akhir = $request->input('hari_akhir');
        $denda = $request->input('denda');

        $denda_data = new Denda();
        $denda_data->hari_awal = $hari_awal;
        $denda_data->hari_akhir = $hari_akhir;
        $denda_data->keterlambatan = $hari_awal . ' s/d ' . $hari_akhir . ' hari';
        $denda_data->denda = $denda;

        $denda_data->save();

        return redirect()->route('datamaster-kelola-denda')->with('success', 'Data denda berhasil disimpan.');
    }

    public function destroy($id)
    {
        $denda = Denda::find($id);

        if ($denda) {
            $denda->delete();
            return redirect()->route('datamaster-kelola-denda')->with('success', 'Data denda berhasil dihapus.');
        }

        return redirect()->route('datamaster-kelola-denda')->with('error', 'Data denda tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $hari_awal = $request->input('hari_awal');
        $hari_akhir = $request->input('hari_akhir');
        $denda = $request->input('denda');

        $denda_data = Denda::find($id);

        if ($denda_data) {
            $denda_data->hari_awal = $hari_awal;
            $denda_data->hari_akhir = $hari_akhir;
            $denda_data->keterlambatan = $hari_awal . ' s/d ' . $hari_akhir . ' hari';
            $denda_data->denda = $denda;

            $denda_data->save();

            return redirect()->route('datamaster-kelola-denda')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->route('datamaster-kelola-denda')->with('error', 'Data tidak ditemukan.');
        }
    }
}
