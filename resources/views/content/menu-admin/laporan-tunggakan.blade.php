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
                        <h5 class="card-header">Daftar Tunggakan Pelanggan <span class="text-muted">[Lebih Dari 3
                                Bulan]</span></h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Alamat </th>
                                        <th>Banyak Tunggakan</th>
                                        <th>Bulan Tertunggak</th>
                                        <th>Jumlah Meter</th>
                                        <th>Tarif</th>
                                        <th>Jumlah Bayar</th>
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
                                            <td>{{ $tagihan->id_pelanggan }}</td>
                                            <td>{{ $tagihan->nama_pelanggan }}</td>
                                            <td>{{ $tagihan->alamat_pelanggan }}</td>
                                            <td>{{ $tagihan->banyak_tunggakan }} Bulan</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach ($tagihan->bulan_tertunggak as $bulan)
                                                        <span class="badge bg-info">{{ $bulan }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>{{ $tagihan->jumlah_meter }}</td>
                                            <td>Rp. {{ number_format($tagihan->tarif, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($tagihan->jumlah_bayar, 0, ',', '.') }}</td>
                                        </tr>
                                        @php
                                            $no++;
                                            $total_bayar += $tagihan->jumlah_bayar;
                                        @endphp
                                    @endforeach
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
