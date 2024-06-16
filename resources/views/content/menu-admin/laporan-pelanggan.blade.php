@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Laporan Pelanggan')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div clas="bg-white w-100" style="width: 100%">
            <div class="row">
                <div class="col mt-3">
                    <div class="card">
                        @php
                            $total = 0;
                        @endphp
                        <h5 class="card-header">Laporan Pemakaian Pelanggan</h5>
                        <div class="card-body">
                            <div class="d-flex gap-2">
                                <form class="d-flex gap-2" action="{{ route('laporan-pelanggan') }}" method="GET"
                                    style="width: 100%">
                                    <div class="form-floating form-floating-outlines">
                                        <select class="form-select" id="exampleFormControlSelect1" name="bulan" required
                                            aria-label="Pilih Jenis Tarif">
                                            <option selected disabled hidden>Pilih Bulan</option>
                                            <option value="Januari">Januari</option>
                                            <option value="Februari">Februari</option>
                                            <option value="Maret">Maret</option>
                                            <option value="April">April</option>
                                            <option value="Mei">Mei</option>
                                            <option value="Juni">Juni</option>
                                            <option value="Juli">Juli</option>
                                            <option value="Agustus">Agustus</option>
                                            <option value="September">September</option>
                                            <option value="Oktober">Oktober</option>
                                            <option value="November">November</option>
                                            <option value="Desember">Desember</option>
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Bulan</label>
                                    </div>
                                    <div class="form-floating form-floating-outlines">
                                        <select class="form-select" id="exampleFormControlSelect1" name="tahun" required
                                            aria-label="Pilih Tahun">
                                            <option selected disabled hidden>Pilih Tahun</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Tahun</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <button type="button" class="btn btn-warning"
                                        onclick="location.href='{{ route('pengelolaan-riwayat-transaksi') }}'">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
