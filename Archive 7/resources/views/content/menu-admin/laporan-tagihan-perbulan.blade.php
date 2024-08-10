@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Tagihan')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div clas="bg-white w-100" style="width: 100%">
            <div class="row">
                <div class="col mt-3">
                    <div class="card">
                        <h5 class="card-header">Daftar Tagihan Perbulan</h5>
                        <form action="{{ route('pengelolaan-daftar-tagihan') }}" method="GET">
                            <div class="d-flex card-body align-items-center gap-3">
                                <div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            {{ request()->get('status_bayar') == 'on' ? 'checked' : '' }}
                                            name="status_bayar">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"> Filter Sudah
                                            Dibayar</label>
                                    </div>
                                </div>
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
                                        onclick="location.href='{{ route('pengelolaan-daftar-tagihan') }}'">Reset</button>
                                </div>
                            </div>
                        </form>
                        @if ($list_tagihan)
                            <div class="table-responsive text-nowrap">
                                <div class="mx-3">
                                    <p style="color: red;">Jumlah bayar yang tertera sudah termasuk biaya admin</p>
                                </div>
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
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($list_tagihan as $tagihan)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $tagihan->id_pelanggan }}</td>
                                                <td>{{ $tagihan->nama_pelanggan }}</td>
                                                <td>{{ $tagihan->bulan_tagihan }}</td>
                                                <td>{{ $tagihan->meter_akhir - $tagihan->meter_awal }}</td>
                                                <td>Rp.
                                                    {{ number_format($tagihan->jumlah_bayar + $tagihan->biaya_admin, 0, ',', '.') }}
                                                </td>
                                                <td>{!! $tagihan->status_bayar
                                                    ? '<span class="badge rounded-pill bg-success">Sudah dibayar</span>'
                                                    : '<span class="badge rounded-pill bg-danger">Belum dibayar</span>' !!}
                                                </td>
                                                <td>{{ $tagihan->petugas }}</td>
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
