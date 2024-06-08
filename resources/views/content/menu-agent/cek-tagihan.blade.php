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
                    <form action="{{ route('cek-tagihan') }}" method="GET">
                        <div class="d-flex gap-2 mt-1">
                            <div class="form-floating form-floating-outline" style="width: 100%">
                                <input class="form-control" list="identitaspelanggan" id="exampleDataList"
                                    name="id_pelanggan" placeholder="Masukan ID atau Nama Pelanggan">
                                <datalist id="identitaspelanggan">
                                    @foreach ($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->id_pelanggan }}-{{ $pelanggan->nama_pelanggan }}">
                                        </option>
                                    @endforeach
                                </datalist>
                                <label for="exampleDataList">Cari Data Pelanggan</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    @if ($info_pelanggan)
                        <div class="card h-100 mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Detail Pelanggan</h5>
                                <h6 class="card-subtitle text-muted">Informasi detail pelanggan</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p style="width: 150px">ID Pelanggan</p>
                                    <p>: {{ $info_pelanggan->id_pelanggan }}</p>
                                </div>
                                <div class="d-flex">
                                    <p style="width: 150px">Nama</p>
                                    <p>: {{ $info_pelanggan->nama_pelanggan }}</p>
                                </div>
                                <div class="d-flex">
                                    <p style="width: 150px">No Meter</p>
                                    <p>: {{ $info_pelanggan->no_meter }}</p>
                                </div>
                                <div class="d-flex">
                                    <p style="width: 150px">Tarif</p>
                                    <p>: {{ $info_pelanggan->jenis_tarif }}</p>
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-primary">Lihat Riwayat Transaksi</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-8 mt-3">
                    @if ($list_tagihan)
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
                                            <th>M<sup>3</sup></th>
                                            <th>Tarif/M<sup>3</sup></th>
                                            <th>Jumlah Bayar</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @php
                                            $no = 1;
                                            $total_bayar = 0;
                                        @endphp
                                        @foreach ($list_tagihan as $tagihan)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $tagihan->bulan_tagihan }}
                                                    {{ explode('-', $tagihan->waktu_bayar)[0] }}</td>
                                                <td>{{ $tagihan->meter_awal }}</td>
                                                <td>{{ $tagihan->meter_akhir }}</td>
                                                <td>{{ $tagihan->meter_akhir - $tagihan->meter_awal }}</td>
                                                <td>Rp. {{ number_format($tagihan->tarif, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($tagihan->jumlah_bayar, 0, ',', '.') }}</td>
                                                <td><button type="button" class="btn btn-primary">Bayar</button></td>
                                            </tr>
                                            @php
                                                $no++;
                                                $total_bayar += $tagihan->jumlah_bayar;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-border-bottom-0">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>
                                            <th>Rp. {{ number_format($total_bayar, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
