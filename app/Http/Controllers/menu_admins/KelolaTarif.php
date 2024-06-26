<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class KelolaTarif extends Controller
{
    public function index($id = null)
    {
        $tarifs = Tarif::all();
        $initial_tarif = null;
        if ($id) {
            $initial_tarif = Tarif::find($id);
        }

        return view('content.menu-admin.kelola-tarif', compact('tarifs', 'initial_tarif'));
    }

    public function store(Request $request)
    {
        $golongan = $request->input('golongan');
        $abonemen = $request->input('abonemen');
        $tarif = $request->input('tarif');

        $tarif_data = new Tarif();
        $tarif_data->kode_tarif = $golongan . '/' . $tarif;
        $tarif_data->golongan = $golongan;
        $tarif_data->abonemen = $abonemen;
        $tarif_data->tarif = $tarif;
        $tarif_data->save();

        return redirect()->route('datamaster-kelola-tarif')->with('success', 'Data tarif berhasil disimpan.');
    }

    public function destroy($id)
    {
        $tarif = Tarif::find($id);

        if ($tarif) {
            $tarif->delete();
            return redirect()->route('datamaster-kelola-tarif')->with('success', 'Data tarif berhasil dihapus.');
        }

        return redirect()->route('datamaster-kelola-tarif')->with('error', 'Data tarif tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $golongan = $request->input('golongan');
        $abonemen = $request->input('abonemen');
        $tarif = $request->input('tarif');

        $tarif_data = Tarif::find($id);

        if ($tarif_data) {
            $tarif_data->kode_tarif = $golongan . '/' . $tarif;
            $tarif_data->golongan = $golongan;
            $tarif_data->abonemen = $abonemen;
            $tarif_data->tarif = $tarif;

            $tarif_data->save();

            return redirect()->route('datamaster-kelola-tarif')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->route('datamaster-kelola-tarif')->with('error', 'Data tidak ditemukan.');
        }
    }
}
