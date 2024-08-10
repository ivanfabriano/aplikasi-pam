@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Laporan Tunggakan')

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
                        <h5 class="card-header">Laporan Tunggakan Pelanggan</h5>
                        <div class="card-body">
                            <div class="d-flex gap-2">
                                <form class="d-flex gap-2" action="{{ route('laporan-tunggakan') }}" method="GET"
                                    style="width: 100%">
                                    <div class="form-floating form-floating-outline">
                                        <select class="form-select" id="exampleFormControlSelect1" name="wilayah"
                                            aria-label="Pilih wilayah">
                                            <option selected>Pilih wilayah</option>
                                            <option value="KEDUNGMUNDU">KEDUNGMUNDU</option>
                                            <option value="SENDANGGUWO">SENDANGGUWO</option>
                                            <option value="SAMBIROTO">SAMBIROTO</option>
                                            <option value="KARANGGAWANG">KARANGGAWANG</option>
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Wilayah</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <button type="button" class="btn btn-warning"
                                        onclick="location.href='{{ route('laporan-tunggakan') }}'">Reset</button>
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
