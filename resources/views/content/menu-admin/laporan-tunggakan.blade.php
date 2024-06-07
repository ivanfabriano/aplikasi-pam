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
                        <h5 class="card-header">Daftar Tagihan Perbulan</h5>
                        <div class="d-flex card-body align-items-center gap-3">
                            <div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"> Filter Sudah
                                        Dibayar</label>
                                </div>
                            </div>
                            <div>
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList"
                                        placeholder="Pilih Bulan Tagihan">
                                    <datalist id="datalistOptions">
                                        <option value="Januari"></option>
                                        <option value="Februari"></option>
                                        <option value="Maret"></option>
                                        <option value="April"></option>
                                        <option value="Mei"></option>
                                        <option value="Juni"></option>
                                        <option value="Juli"></option>
                                        <option value="Agustus"></option>
                                        <option value="September"></option>
                                        <option value="Oktober"></option>
                                        <option value="Novenmber"></option>
                                        <option value="Desember"></option>
                                    </datalist>
                                    <label for="exampleDataList">Bulan Tagihan</label>
                                </div>
                            </div>
                            <div>
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList"
                                        placeholder="Pilih Tahun Tagihan">
                                    <datalist id="datalistOptions">
                                        <option value="2019"></option>
                                        <option value="2020"></option>
                                        <option value="2021"></option>
                                        <option value="2022"></option>
                                        <option value="2023"></option>
                                        <option value="2024"></option>
                                        <option value="2025"></option>
                                        <option value="2026"></option>
                                        <option value="2027"></option>
                                        <option value="2028"></option>
                                        <option value="2029"></option>
                                        <option value="2030"></option>
                                    </datalist>
                                    <label for="exampleDataList">Tahun Tagihan</label>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Cari</button>
                                <button type="submit" class="btn btn-warning">Reset</button>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Bulan Tagihan</th>
                                        <th>Jumlah Meter</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Status</th>
                                        <th>Petugas</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>2019115145520</td>
                                        <td>Untung</td>
                                        <td>Januari</td>
                                        <td>20</td>
                                        <td>Rp. 12.000</td>
                                        <td><span class="badge rounded-pill bg-danger">Belum dibayar</span></td>
                                        <td>Ivan Fabriano</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2019115145521</td>
                                        <td>Budi</td>
                                        <td>Februari</td>
                                        <td>10</td>
                                        <td>Rp. 9.000</td>
                                        <td><span class="badge rounded-pill bg-danger">Belum dibayar</span></td>
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
