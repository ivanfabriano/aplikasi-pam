@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Riwayat Transaksi')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div clas="bg-white w-100" style="width: 100%">
            <div class="row">
                <div class="col mt-3">
                    <div class="card">
                        <h5 class="card-header">Riwayat Transaksi Pelanggan <span
                                class="text-muted">[{{ $info_pelanggan ? $info_pelanggan->id_pelanggan . '-' . $info_pelanggan->nama_pelanggan : 'Semua Pelanggan' }}]</span>
                        </h5>
                        <div class="card-body">
                            <div class="d-flex gap-2">
                                <form class="d-flex gap-2" action="{{ route('pengelolaan-riwayat-transaksi') }}"
                                    method="GET" style="width: 40%">
                                    <div class="form-floating form-floating-outline" style="width: 100%">
                                        <input class="form-control" list="identitaspelanggan" id="exampleDataList"
                                            value="{{ request()->get('id_name_filter') }}" name="id_name_filter"
                                            placeholder="Masukan ID atau Nama Pelanggan">
                                        <datalist id="identitaspelanggan">
                                            @foreach ($list_pelanggans as $list_pelanggan)
                                                <option
                                                    value="{{ $list_pelanggan->no_meter }}-{{ $list_pelanggan->nama_pelanggan }}-{{ $list_pelanggan->alamat_pelanggan }}">
                                                </option>
                                            @endforeach
                                        </datalist>
                                        <label for="exampleDataList">Cari Pelanggan</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <button type="button" class="btn btn-warning"
                                        onclick="location.href='{{ route('pengelolaan-riwayat-transaksi') }}'">Reset</button>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pembayaran</th>
                                        <th>ID Pelanggan</th>
                                        <th>Nama Pelanggan </th>
                                        <th>Waktu</th>
                                        <th>Bulan Bayar</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Biaya Admin</th>
                                        <th>Denda</th>
                                        <th>Total Akhir</th>
                                        <th>Bayar</th>
                                        <th>Kembali</th>
                                        <th>Petugas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($list_tagihan as $tagihan)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $tagihan->id_pembayaran }}</td>
                                            <td>{{ $tagihan->id_pelanggan }}</td>
                                            <td>{{ $tagihan->nama_pelanggan }}</td>
                                            <td>{{ $tagihan->waktu_bayar }}</td>
                                            <td>{{ $tagihan->bulan_tagihan }} {{ explode('-', $tagihan->waktu_bayar)[0] }}
                                            </td>
                                            <td>Rp. {{ number_format($tagihan->jumlah_bayar, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($tagihan->biaya_admin, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($tagihan->denda, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($tagihan->total_akhir, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($tagihan->bayar, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($tagihan->kembali, 0, ',', '.') }}</td>
                                            <td>{{ $tagihan->petugas }}</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('pengelolaan-rollback-transaksi', $tagihan->id) }}"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin rollback transaksi ini?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger">Rollback</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
