<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentications\Login;

use App\Http\Controllers\menu_agents\CekTagihan;
use App\Http\Controllers\menu_agents\PembayaranTagihan;

use App\Http\Controllers\menu_admins\KelolaPenggunaan;
use App\Http\Controllers\menu_admins\KelolaTarif;
use App\Http\Controllers\menu_admins\KelolaDenda;
use App\Http\Controllers\menu_admins\KelolaPelanggan;
use App\Http\Controllers\menu_admins\KelolaAkun;
use App\Http\Controllers\menu_admins\LaporanTagihanPerbulan;
use App\Http\Controllers\menu_admins\LaporanTunggakan;
use App\Http\Controllers\menu_admins\RiwayatTransaksi;
use App\Http\Controllers\menu_admins\CetakStruk;
use App\Http\Controllers\menu_admins\HomePage;

// Main Page Route
Route::get('/', [HomePage::class, 'index'])->name('home-page')->middleware('auth');

Route::get('/login', [Login::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [Login::class, 'authenticate'])->name('login')->middleware('guest');
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

//  Menu agen route
Route::get('/menu-agent/cek-tagihan', [CekTagihan::class, 'index'])->name('cek-tagihan')->middleware('auth');
Route::get('/menu-agent/cetak-struk', [CetakStruk::class, 'index'])->name('cetak-struk')->middleware('auth');
Route::get('/pembayaran-tagihan/{id_pembayaran}', [PembayaranTagihan::class, 'index'])->name('pembayaran-tagihan')->middleware('auth');
Route::put('/update-tagihan/{id_pembayaran}', [PembayaranTagihan::class, 'update'])->name('update-tagihan')->middleware('auth');

//  ROUTE KELOLA TARIF
Route::get('/datamaster/kelola-tarif/{id?}', [KelolaTarif::class, 'index'])->name('datamaster-kelola-tarif')->middleware('auth');
Route::post('/datamaster/tambah-tarif', [KelolaTarif::class, 'store'])->name('datamaster-tambah-tarif')->middleware('auth');
Route::delete('/datamaster/hapus-tarif/{id}', [KelolaTarif::class, 'destroy'])->name('datamaster-hapus-tarif')->middleware('auth');
Route::put('/datamaster/ubah-tarif/{id}', [KelolaTarif::class, 'update'])->name('datamaster-ubah-tarif')->middleware('auth');

// ROUTE KELOLA DENDA
Route::get('/datamaster/kelola-denda/{id?}', [KelolaDenda::class, 'index'])->name('datamaster-kelola-denda')->middleware('auth');
Route::post('/datamaster/tambah-denda', [KelolaDenda::class, 'store'])->name('datamaster-tambah-denda')->middleware('auth');
Route::delete('/datamaster/hapus-denda/{id}', [KelolaDenda::class, 'destroy'])->name('datamaster-hapus-denda')->middleware('auth');
Route::put('/datamaster/ubah-denda/{id}', [KelolaDenda::class, 'update'])->name('datamaster-ubah-denda')->middleware('auth');

// ROUTE KELOLA PELANGGAN
Route::get('/datamaster/kelola-pelanggan/{id?}', [KelolaPelanggan::class, 'index'])->name('datamaster-kelola-pelanggan')->middleware('auth');
Route::post('/datamaster/tambah-pelanggan', [KelolaPelanggan::class, 'store'])->name('datamaster-tambah-pelanggan')->middleware('auth');
Route::delete('/datamaster/hapus-pelanggan/{id}', [KelolaPelanggan::class, 'destroy'])->name('datamaster-hapus-pelanggan')->middleware('auth');
Route::put('/datamaster/ubah-pelanggan/{id}', [KelolaPelanggan::class, 'update'])->name('datamaster-ubah-pelanggan')->middleware('auth');

Route::get('/datamaster/kelola-akun/{id?}', [KelolaAkun::class, 'index'])->name('datamaster-kelola-akun')->middleware('auth');
Route::post('/datamaster/tambah-akun', [KelolaAkun::class, 'store'])->name('datamaster-tambah-akun')->middleware('auth');
Route::delete('/datamaster/hapus-akun/{id}', [KelolaAkun::class, 'destroy'])->name('datamaster-hapus-akun')->middleware('auth');
Route::put('/datamaster/ubah-akun/{id}', [KelolaAkun::class, 'update'])->name('datamaster-ubah-akun')->middleware('auth');

// ROUTE KELOLA PENGGUNAAN
Route::get('/pengelolaan/input-penggunan', [KelolaPenggunaan::class, 'index'])->name('pengelolaan-input-penggunaan')->middleware('auth');
Route::post('/pengelolaan/tambah-penggunan', [KelolaPenggunaan::class, 'store'])->name('pengelolaan-tambah-penggunaan')->middleware('auth');
Route::post('/pengelolaan/reset-penggunan/{id}', [KelolaPenggunaan::class, 'reset'])->name('pengelolaan-reset-penggunaan')->middleware('auth');

Route::get('/pengelolaan/daftar-tagihan', [LaporanTagihanPerbulan::class, 'index'])->name('pengelolaan-daftar-tagihan')->middleware('auth');
Route::get('/pengelolaan/daftar-tunggakan', [LaporanTunggakan::class, 'index'])->name('pengelolaan-daftar-tunggakan')->middleware('auth');

Route::get('/pengelolaan/riwayat-transaksi/{id_pelanggan?}', [RiwayatTransaksi::class, 'index'])->name('pengelolaan-riwayat-transaksi')->middleware('auth');
Route::put('/pengelolaan/rollback-transaksi/{id_pelanggan}', [RiwayatTransaksi::class, 'rollback'])->name('pengelolaan-rollback-transaksi')->middleware('auth');
