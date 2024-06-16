@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Cek Tagihan')

@section('page-script')
    <script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
@endsection

@section('content')
    <div class="layout-demo-wrapper">
        <div clas="bg-white w-100" style="width: 100%">
            <div class="card h-100" style="width: 32%">
                <div class="card-body">
                    <h5 class="card-title">Cari Data Pelanggan</h5>
                    <form action="{{ route('cek-tagihan') }}" method="GET">
                        <div class="d-flex gap-2 mt-1">
                            <div class="form-floating form-floating-outline" style="width: 100%">
                                <input class="form-control" list="identitaspelanggan" id="exampleDataList"
                                    name="id_pelanggan" placeholder="Masukan ID atau Nama Pelanggan">
                                <datalist id="identitaspelanggan">
                                    @foreach ($pelanggans as $pelanggan)
                                        <option
                                            value="{{ $pelanggan->no_meter }}-{{ $pelanggan->nama_pelanggan }}-{{ $pelanggan->alamat_pelanggan }}">
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
            @if (is_null($list_tagihan))
                <div></div>
            @elseif (!is_null($list_tagihan) && !$list_tagihan->isEmpty())
                <div class="row">
                    <div class="col-12 mt-3">
                        @if ($list_tagihan)
                            <div class="card">
                                <h5 class="card-header">Detail Tagihan <span class="text-muted">[Belum Terbayar]</span>
                                </h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bulan Tagihan</th>
                                                <th>Meter Awal</th>
                                                <th>Meter Akhir</th>
                                                <th>M<sup>3</sup></th>
                                                <th>Tarif/M<sup>3</sup></th>
                                                <th>Abonemen</th>
                                                <th>Denda</th>
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
                                                        {{ explode('-', $tagihan->created_at)[0] }}</td>
                                                    <td>{{ $tagihan->meter_awal }}</td>
                                                    <td>{{ $tagihan->meter_akhir }}</td>
                                                    <td>{{ $tagihan->meter_akhir - $tagihan->meter_awal }}</td>
                                                    <td>Rp. {{ number_format($tagihan->tarif, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($tagihan->biaya_admin, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($tagihan->denda, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($tagihan->total_akhir, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('pembayaran-tagihan', $tagihan->id_pembayaran) }}"
                                                            target="_blank">
                                                            @method('GET')
                                                            <button type="sumbit" class="btn btn-primary">BAYAR</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php
                                                    $no++;
                                                    $total_bayar += $tagihan->total_akhir;
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
                    <div class="col-3">
                        @if ($info_pelanggan)
                            <div class="card h-100 mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">Detail Pelanggan</h5>
                                    <h6 class="card-subtitle text-muted">Informasi detail pelanggan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex ">
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
                                        <form
                                            action="{{ route('pengelolaan-riwayat-transaksi', $info_pelanggan->id_pelanggan) }}">
                                            @method('GET')
                                            <button type="sumbit" class="btn btn-primary">Lihat Riwayat
                                                Transaksi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-3">
                        @if ($info_pelanggan)
                            <div class="card h-100 mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">Detail Pelanggan</h5>
                                    <h6 class="card-subtitle text-muted">Informasi detail pelanggan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap">
                                        <p style="width: 150px">ID Pelanggan</p>
                                        <p>: {{ $info_pelanggan->id_pelanggan }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <p style="width: 150px">Nama</p>
                                        <p>: {{ $info_pelanggan->nama_pelanggan }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <p style="width: 150px">No Meter</p>
                                        <p>: {{ $info_pelanggan->no_meter }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <p style="width: 150px">Tarif</p>
                                        <p>: {{ $info_pelanggan->jenis_tarif }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <form
                                            action="{{ route('pengelolaan-riwayat-transaksi', $info_pelanggan->id_pelanggan) }}">
                                            @method('GET')
                                            <button type="sumbit" class="btn btn-primary">Lihat Riwayat
                                                Transaksi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-9">
                        <div class="card mt-3 text-center" style="width: 100%;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center py-5">
                                <h3 class="card-title">Tidak Ada Tagihan</h3>
                                <p style="width: 600px;">Mohon maaf saat ini pelanggan
                                    <b>{{ $info_pelanggan->nama_pelanggan }}</b>
                                    dengan ID Pelanggan
                                    <b>{{ $info_pelanggan->id_pelanggan }}</b>
                                    tidak memiliki tagihan yang belum terbayarkan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
