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
                <div class="col-3">
                    <div class="card h-100 mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Data Pelanggan</h5>
                            <h6 class="card-subtitle text-muted">Informasi detail data pelanggan</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        placeholder="Masukan ID Pelanggan" />
                                    <label for="basic-default-company">ID Pelanggan</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        placeholder="Masukan No Meter" />
                                    <label for="basic-default-company">No Meter</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        placeholder="Masukan Nama Pelanggan" />
                                    <label for="basic-default-company">Nama Pelanggan</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" placeholder="Masukan Alamat Pelanggan"></textarea>
                                    <label for="exampleFormControlTextarea1">Alamat Pelanggan</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList"
                                        placeholder="Pilih Jenis Tarif">
                                    <datalist id="datalistOptions">
                                        <option value="Sendangguwo/3000"></option>
                                    </datalist>
                                    <label for="exampleDataList">Jenis Tarif</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-9 mt-3">
                    <div class="card">
                        <h5 class="card-header">Daftar Pelanggan</h5>
                        <div>
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"> Filter Telat
                                                Bayar</label>
                                        </div>
                                    </div>
                                    <div class="form-floating form-floating-outline" style="width: 100%">
                                        <input class="form-control" list="datalistOptions" id="exampleDataList"
                                            placeholder="Masukan ID atau Nama Pelanggan">
                                        <datalist id="datalistOptions">
                                            <option value="San Francisco"></option>
                                            <option value="New York"></option>
                                            <option value="Seattle"></option>
                                            <option value="Los Angeles"></option>
                                            <option value="Chicago"></option>
                                        </datalist>
                                        <label for="exampleDataList">Cari Data Pelanggan</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pelanggan</th>
                                        <th>No Meter</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Tenggang</th>
                                        <th>Kode Tarif</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>2019115145520</td>
                                        <td>R405</td>
                                        <td>Untung</td>
                                        <td>Semarang</td>
                                        <td>20</td>
                                        <td>Sendangguwo/3000</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
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
