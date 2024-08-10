<?php

namespace App\Http\Controllers\menu_admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaAkun extends Controller
{
    public function index($id = null)
    {
        $users = User::all();
        $initial_user = null;

        if ($id) {
            $initial_user = User::find($id);
        }

        return view('content.menu-admin.kelola-akun', compact('users', 'initial_user'));
    }

    public function store(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $no_telepon = $request->input('no_telepon');
        $role = $request->input('role');

        $user_data = new User();
        $user_data->username = $username;
        $user_data->password = Hash::make($password);
        $user_data->no_telepon = $no_telepon;
        $user_data->role = $role;

        $user_data->save();

        return redirect()->route('datamaster-kelola-akun')->with('success', 'Data akun berhasil dibuat.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('datamaster-kelola-akun')->with('success', 'Data akun berhasil dihapus.');
        }

        return redirect()->route('datamaster-kelola-akun')->with('error', 'Data akun tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $no_telepon = $request->input('no_telepon');
        $role = $request->input('role');

        $user = User::find($id);

        if ($user) {
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->no_telepon = $no_telepon;
            $user->role = $role;

            $user->save();

            return redirect()->route('datamaster-kelola-akun')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->route('datamaster-kelola-akun')->with('error', 'Data tidak ditemukan.');
        }
    }
}
