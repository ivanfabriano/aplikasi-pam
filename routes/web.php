<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\MdiIcons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

use App\Http\Controllers\menu_agents\CekTagihan;
use App\Http\Controllers\menu_agents\PembayaranTagihan;

use App\Http\Controllers\menu_admins\KelolaPenggunaan;
use App\Http\Controllers\menu_admins\KelolaTarif;
use App\Http\Controllers\menu_admins\KelolaDenda;
use App\Http\Controllers\menu_admins\KelolaPelanggan;
use App\Http\Controllers\menu_admins\KelolaPetugas;
use App\Http\Controllers\menu_admins\LaporanTagihanPerbulan;
use App\Http\Controllers\menu_admins\LaporanTunggakan;
use App\Http\Controllers\menu_admins\RiwayatTransaksi;

// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');

//  Menu agen route
Route::get('/menu-agent/cek-tagihan', [CekTagihan::class, 'index'])->name('cek-tagihan');
Route::get('/pembayaran-tagihan', [PembayaranTagihan::class, 'index'])->name('pembayaran-tagihan');

//  ROUTE KELOLA TARIF
Route::get('/datamaster/kelola-tarif/{id?}', [KelolaTarif::class, 'index'])->name('datamaster-kelola-tarif');
Route::post('/datamaster/tambah-tarif', [KelolaTarif::class, 'store'])->name('datamaster-tambah-tarif');
Route::delete('/datamaster/hapus-tarif/{id}', [KelolaTarif::class, 'destroy'])->name('datamaster-hapus-tarif');
Route::put('/datamaster/ubah-tarif/{id}', [KelolaTarif::class, 'update'])->name('datamaster-ubah-tarif');

// ROUTE KELOLA DENDA
Route::get('/datamaster/kelola-denda/{id?}', [KelolaDenda::class, 'index'])->name('datamaster-kelola-denda');
Route::post('/datamaster/tambah-denda', [KelolaDenda::class, 'store'])->name('datamaster-tambah-denda');
Route::delete('/datamaster/hapus-denda/{id}', [KelolaDenda::class, 'destroy'])->name('datamaster-hapus-denda');
Route::put('/datamaster/ubah-denda/{id}', [KelolaDenda::class, 'update'])->name('datamaster-ubah-denda');

// ROUTE KELOLA PELANGGAN
Route::get('/datamaster/kelola-pelanggan/{id?}', [KelolaPelanggan::class, 'index'])->name('datamaster-kelola-pelanggan');
Route::post('/datamaster/tambah-pelanggan', [KelolaPelanggan::class, 'store'])->name('datamaster-tambah-pelanggan');
Route::delete('/datamaster/hapus-pelanggan/{id}', [KelolaPelanggan::class, 'destroy'])->name('datamaster-hapus-pelanggan');
Route::put('/datamaster/ubah-pelanggan/{id}', [KelolaPelanggan::class, 'update'])->name('datamaster-ubah-pelanggan');

Route::get('/datamaster/kelola-petugas', [KelolaPetugas::class, 'index'])->name('datamaster-kelola-petugas');

// ROUTE KELOLA PENGGUNAAN
Route::get('/pengelolaan/input-penggunan', [KelolaPenggunaan::class, 'index'])->name('pengelolaan-input-penggunaan');
Route::post('/pengelolaan/tambah-penggunan', [KelolaPenggunaan::class, 'store'])->name('pengelolaan-tambah-penggunaan');

Route::get('/pengelolaan/daftar-tagihan', [LaporanTagihanPerbulan::class, 'index'])->name('pengelolaan-daftar-tagihan');
Route::get('/pengelolaan/daftar-tunggakan', [LaporanTunggakan::class, 'index'])->name('pengelolaan-daftar-tunggakan');
Route::get('/pengelolaan/riwayat-transaksi', [RiwayatTransaksi::class, 'index'])->name('pengelolaan-riwayat-transaksi');


// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/icons-mdi', [MdiIcons::class, 'index'])->name('icons-mdi');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
