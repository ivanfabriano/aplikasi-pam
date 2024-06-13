@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Penggunaan')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div clas="bg-white w-100" style="width: 100%">
            <div class="row">
                <div class="col mt-3">
                    <div class="card">
                        <h5 class="card-header">Daftar Tagihan Perbulan</h5>
                        <form action="{{ route('pengelolaan-daftar-penggunaan') }}" method="GET">
                            <div class="d-flex card-body align-items-center gap-3">
                                <div>
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" list="datalistOptions" id="exampleDataList"
                                            value="{{ request()->get('bulan_tagihan') }}" name="filter_pelanggan"
                                            placeholder="Pilih Pelanggan">
                                        <datalist id="datalistOptions">
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($pelanggans as $pelanggan)
                                                <option
                                                    value="{{ $pelanggan->no_meter }}-{{ $pelanggan->nama_pelanggan }}-{{ $pelanggan->alamat_pelanggan }}">
                                                </option>
                                                @php
                                                    $no++;
                                                @endphp
                                            @endforeach
                                        </datalist>
                                        <label for="exampleDataList">Cari Pelanggan</label>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <button type="button" class="btn btn-warning"
                                        onclick="location.href='{{ route('pengelolaan-daftar-penggunaan') }}'">Reset</button>
                                </div>
                            </div>
                        </form>
                        @if ($list_tagihan)
                            <div class="table-responsive text-nowrap">
                                <div class="mx-3">
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Bulan Tagihan</th>
                                            <th>Meter Awal</th>
                                            <th>Meter Akhir</th>
                                            <th>Tanggal Cek</th>
                                            <th>Petugas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($list_tagihan as $tagihan)
                                            <tr
                                                class="{{ $tagihan->meter_awal == $tagihan->meter_akhir ? 'table-danger' : '' }}">
                                                <td>{{ $no }}</td>
                                                <td>{{ $tagihan->id_pelanggan }}</td>
                                                <td>{{ $tagihan->nama_pelanggan }}</td>
                                                <td>{{ $tagihan->bulan_tagihan }}</td>
                                                <td>{{ $tagihan->meter_awal }}</td>
                                                <td>{{ $tagihan->meter_akhir }}</td>
                                                <td>{{ $tagihan->tanggal_pengecekan }}</td>
                                                <td>{{ $tagihan->petugas }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('pengelolaan-input-penggunaan', $tagihan->id_penggunaan) }}">
                                                        @method('GET')
                                                        <button type="sumbit" class="btn btn-warning">Edit</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php
                                                $no++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
