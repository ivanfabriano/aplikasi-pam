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
            <div class="card h-100" style="width: 32%">
                <div class="card-body">
                    <h5 class="card-title">Cari ID Pelanggan</h5>
                    <div class="d-flex gap-2 mt-1">
                        <input type="text" class="form-control" id="defaultFormControlInput"
                            placeholder="Masukan ID Pelanggan" aria-describedby="defaultFormControlHelp" />
                        <button type="button" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card h-100 mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Detail Pelanggan</h5>
                            <h6 class="card-subtitle text-muted">Informasi detail pelanggan</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p style="width: 150px">ID Pelanggan</p>
                                <p>: 2019115145520</p>
                            </div>
                            <div class="d-flex">
                                <p style="width: 150px">Nama</p>
                                <p>: UNTUNG</p>
                            </div>
                            <div class="d-flex">
                                <p style="width: 150px">No Meter</p>
                                <p>: 405</p>
                            </div>
                            <div class="d-flex">
                                <p style="width: 150px">Tarif</p>
                                <p>: Rp. 3000</p>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-primary">Lihat Riwayat Transaksi</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 mt-3">
                    <div class="card">
                        <h5 class="card-header">Detail Tagihan <span class="text-muted">[Belum Terbayar]</span></h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Meter Awal</th>
                                        <th>Meter Akhir</th>
                                        <th>Tarif/M</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>April 2024</td>
                                        <td>1979</td>
                                        <td>2010</td>
                                        <td>Rp. 3.000</td>
                                        <td>Rp. 93.000</td>
                                        <td><button type="button" class="btn btn-primary">Bayar</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Mei 2024</td>
                                        <td>2010</td>
                                        <td>2051</td>
                                        <td>Rp. 3.000</td>
                                        <td>Rp. 123.000</td>
                                        <td><button type="button" class="btn btn-primary">Bayar</button></td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-border-bottom-0">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th>Rp. 216.000</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
