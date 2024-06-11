@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Input Penggunaan')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div class="col-xl">
            <div class="card mb-4" style="width: 100%">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Input Penggunaan</h5>
                </div>
                <div class="card-body">
                    @if (!$pelanggan)
                        <form action="{{ route('pengelolaan-input-penggunaan') }}" method="GET">
                            <div class="d-flex mb-4 gap-2">
                                <div class="form-floating form-floating-outline" style="width: 100%">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList"
                                        {{ $pelanggan ? 'readonly' : '' }}
                                        value="{{ $pelanggan ? $pelanggan->id_pelanggan : '' }}" name="id_pelanggan"
                                        placeholder="Type to search...">
                                    <datalist id="datalistOptions">
                                        @foreach ($list_pelanggans as $list_pelanggan)
                                            <option
                                                value="{{ $list_pelanggan->id_pelanggan }}-{{ $list_pelanggan->nama_pelanggan }}">
                                            </option>
                                        @endforeach
                                    </datalist>
                                    <label for="exampleDataList">ID Pelanggan<span style="color: red;">*</span></label>
                                </div>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly
                                    name="no_meter" value="{{ $pelanggan ? $pelanggan->no_meter : '' }}"
                                    placeholder="Masukan No Meter" />
                                <label for="basic-default-company">Nomor Meter<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly
                                    name="nama_pelanggan" value="{{ $pelanggan ? $pelanggan->nama_pelanggan : '' }}"
                                    placeholder="Masukan Nama Pelanggan" />
                                <label for="basic-default-company">Nama Pelanggan<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly
                                    name="bulan_penggunaan" value="{{ $pelanggan ? $pelanggan->bulan_penggunaan : '' }}"
                                    placeholder="Masukan Bulan Pengggunaan" />
                                <label for="basic-default-company">Bulan Penggunaan<span
                                        style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="number" placeholder="18" id="html5-number-input" readonly
                                    name="meter_awal" value="{{ $pelanggan ? $pelanggan->meter_awal : '' }}" />
                                <label for="html5-number-input">Meter Awal<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                    name="meter_akhir" />
                                <label for="html5-number-input">Meter Akhir<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="date" id="html5-date-input"
                                    name="tanggal_pengecekan" />
                                <label for="html5-date-input">Tanggal Pengecekan<span style="color: red;">*</span></label>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('pengelolaan-tambah-penggunaan') }}" method="POST">
                            @csrf
                            <div class="d-flex mb-4 gap-2">
                                <div class="form-floating form-floating-outline" style="width: 100%">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" required
                                        {{ $pelanggan ? 'readonly' : '' }}
                                        value="{{ $pelanggan ? $pelanggan->id_pelanggan : '' }}" name="id_pelanggan"
                                        placeholder="Type to search...">
                                    <datalist id="datalistOptions">
                                        @foreach ($list_pelanggans as $list_pelanggan)
                                            <option
                                                value="{{ $list_pelanggan->id_pelanggan }}-{{ $list_pelanggan->nama_pelanggan }}">
                                            </option>
                                        @endforeach
                                    </datalist>
                                    <label for="exampleDataList">ID Pelanggan<span style="color: red;">*</span></label>
                                </div>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly required
                                    name="no_meter" value="{{ $pelanggan ? $pelanggan->no_meter : '' }}"
                                    placeholder="Masukan No Meter" />
                                <label for="basic-default-company">Nomor Meter<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly required
                                    name="nama_pelanggan" value="{{ $pelanggan ? $pelanggan->nama_pelanggan : '' }}"
                                    placeholder="Masukan Nama Pelanggan" />
                                <label for="basic-default-company">Nama Pelanggan<span
                                        style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly required
                                    name="bulan_penggunaan" value="{{ $pelanggan ? $pelanggan->bulan_penggunaan : '' }}"
                                    placeholder="Masukan Bulan Pengggunaan" />
                                <label for="basic-default-company">Bulan Penggunaan<span
                                        style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                    required readonly name="meter_awal"
                                    value="{{ $pelanggan ? $pelanggan->meter_awal : '' }}" />
                                <label for="html5-number-input">Meter Awal<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                    required name="meter_akhir" />
                                <label for="html5-number-input">Meter Akhir<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="date" id="html5-date-input" required
                                    name="tanggal_pengecekan" />
                                <label for="html5-date-input">Tanggal Pengecekan<span style="color: red;">*</span></label>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            @if ($pelanggan)
                                <button type="button" class="btn btn-danger"
                                    onclick="location.href='{{ route('pengelolaan-input-penggunaan') }}'">Batal</button>
                            @endif
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->


@endsection
