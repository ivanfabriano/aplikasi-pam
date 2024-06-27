<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\CekTagihan;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $tarif_lama = null;
        $biaya_admin_lama = null;

        $tarif_data = Tarif::find($id);

        if ($tarif_data) {
            $tarif_lama = $tarif_data->kode_tarif;

            $tarif_data->kode_tarif = $golongan . '/' . $tarif;
            $tarif_data->golongan = $golongan;
            $tarif_data->abonemen = $abonemen;
            $tarif_data->tarif = $tarif;

            $tarif_data->save();


            Pelanggan::where('jenis_tarif', '=', $tarif_lama)->update(['jenis_tarif' => $tarif_data->kode_tarif]);

            CekTagihan::where('status_bayar', false)
                ->where('kode_tarif', $tarif_lama)
                ->update(['tarif' => $tarif]);

            DB::table('cek_tagihans')
                ->where('status_bayar', false)
                ->where('kode_tarif', $tarif_lama)
                ->update([
                    'biaya_admin' => $abonemen,
                    'jumlah_bayar' => DB::raw('(meter_akhir - meter_awal) * tarif'),
                    'total_akhir' => DB::raw('((meter_akhir - meter_awal) * tarif) + denda + ' . $abonemen)
                ]);

            return redirect()->route('datamaster-kelola-tarif')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->route('datamaster-kelola-tarif')->with('error', 'Data tidak ditemukan.');
        }
    }
}
