@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Container - Layouts')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div class="col-xl">
            <div class="card mb-4" style="width: 500px">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Pengelolaan Penggunaan</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" list="datalistOptions" id="exampleDataList"
                                placeholder="Type to search...">
                            <datalist id="datalistOptions">
                                <option value="San Francisco"></option>
                                <option value="New York"></option>
                                <option value="Seattle"></option>
                                <option value="Los Angeles"></option>
                                <option value="Chicago"></option>
                            </datalist>
                            <label for="exampleDataList">ID Pelanggan</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-company" placeholder="ACME Inc." />
                            <label for="basic-default-company">Nomor Meter</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-company" placeholder="ACME Inc." />
                            <label for="basic-default-company">Nama Pelanggan</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-company" placeholder="ACME Inc." />
                            <label for="basic-default-company">Bulan Penggunaan</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input" />
                            <label for="html5-number-input">Meter Awal</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input" />
                            <label for="html5-number-input">Meter Akhir</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="date" id="html5-date-input" />
                            <label for="html5-date-input">Tanggal Pengecekan</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
