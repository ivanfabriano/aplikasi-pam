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
                                            value="{{ request()->get('bulan_tagihan') }}" name="bulan_tagihan"
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
                                        <input class="form-control" list="listTahun" id="exampleDataList"
                                            value="{{ request()->get('tahun_tagihan') }}" name="tahun_tagihan"
                                            placeholder="Pilih Tahun Tagihan">
                                        <datalist id="listTahun">
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
                                    <button type="button" class="btn btn-warning"
                                        onclick="location.href='{{ route('pengelolaan-daftar-tagihan') }}'">Reset</button>
                                </div>
                            </div>
                        </form>
                        @if ($list_tagihan)
                            <div class="table-responsive text-nowrap">
                                <div class="mx-3">
                                    <p>Filter diterapkan untuk Bulan {{ request()->get('bulan_tagihan') }}
                                        {{ request()->get('tahun_tagihan') }}
                                        [{{ request()->get('status_bayar') == 'on' ? 'Sudah Dibayar' : 'Belum Dibayar' }}]
                                    </p>
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
                                                <td>Rp. {{ number_format($tagihan->jumlah_bayar, 0, ',', '.') }}</td>
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
