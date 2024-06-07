@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Container - Layouts')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div clas="bg-white w-100" style="width: 100%">
            <div class="row">
                <div class="col mt-3">
                    <div class="card">
                        <h5 class="card-header">Riwayat Transaksi Pelanggan</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pembayaran</th>
                                        <th>ID Pelanggan</th>
                                        <th>Nama Pelanggan </th>
                                        <th>Waktu</th>
                                        <th>Bulan Bayar</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Biaya Admin</th>
                                        <th>Total Akhir</th>
                                        <th>Bayar</th>
                                        <th>Kembali</th>
                                        <th>Petugas</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>0000291299392</td>
                                        <td>2019115145520</td>
                                        <td>Untung</td>
                                        <td>2023-06-07</td>
                                        <td>Februari 2023</td>
                                        <td>Rp. 20.000</td>
                                        <td>Rp. 4.000</td>
                                        <td>Rp. 24.000</td>
                                        <td>Rp. 50.000</td>
                                        <td>Rp. 26.000</td>
                                        <td>Ivan Fabriano</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
