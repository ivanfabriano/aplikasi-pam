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
                        <h5 class="card-header">Daftar Tunggakan Pelanggan <span class="text-muted">[Lebih Dari 3
                                Bulan]</span></h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Alamat </th>
                                        <th>Banyak Tunggakan</th>
                                        <th>Bulan Tertunggak</th>
                                        <th>Jumlah Meter</th>
                                        <th>Tarif</th>
                                        <th>Jumlah Bayar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>2019115145520</td>
                                        <td>Untung</td>
                                        <td>Semarang</td>
                                        <td>7 Bulan</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <span class="badge bg-info">Januari</span>
                                                <span class="badge bg-info">Februari</span>
                                                <span class="badge bg-info">Maret</span>
                                                <span class="badge bg-info">April</span>
                                                <span class="badge bg-info">Mei</span>
                                                <span class="badge bg-info">Juni</span>
                                                <span class="badge bg-info">Juli</span>
                                            </div>
                                        </td>
                                        <td>20</td>
                                        <td>Rp. 3.000</td>
                                        <td>Rp. 36.000</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2019115145521</td>
                                        <td>Budi</td>
                                        <td>Semarang</td>
                                        <td>3 Bulan</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <span class="badge bg-info">Januari</span>
                                                <span class="badge bg-info">Februari</span>
                                                <span class="badge bg-info">Maret</span>
                                            </div>
                                        </td>
                                        <td>20</td>
                                        <td>Rp. 4.000</td>
                                        <td>Rp. 40.000</td>
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
