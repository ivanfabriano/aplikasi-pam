<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class KelolaTarif extends Controller
{
    public function index()
    {
        $users = collect([
            ['no' => 1, 'id_customer' => '2019115145520', 'name' => 'Untung', 'no_meter' => '405', 'price' => '3000'],
            ['no' => 2, 'id_customer' => '2019115145445', 'name' => 'Budi', 'no_meter' => '203', 'price' => '3000']
        ]);

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $users->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedUsers = new LengthAwarePaginator(
            $currentItems,
            $users->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );


        return view('content.menu-admin.kelola-tarif', compact('paginatedUsers'));
    }
}
