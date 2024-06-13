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
                    @if ($edit_data)
                        <form action="{{ route('pengelolaan-ubah-penggunaan', $edit_data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="d-flex mb-4 gap-2">
                                <div class="form-floating form-floating-outline" style="width: 100%">
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" required
                                        {{ $pelanggan ? 'readonly' : '' }}
                                        value="{{ $edit_data ? $edit_data->no_meter . '-' . $edit_data->nama_pelanggan . '-' . $edit_data->alamat_pelanggan : '' }}"
                                        name="id_pelanggan" placeholder="Type to search...">
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
                                    name="no_meter" value="{{ $edit_data ? $edit_data->no_meter : '' }}"
                                    placeholder="Masukan No Meter" />
                                <label for="basic-default-company">Nomor Meter<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly required
                                    name="nama_pelanggan" value="{{ $edit_data ? $edit_data->nama_pelanggan : '' }}"
                                    placeholder="Masukan Nama Pelanggan" />
                                <label for="basic-default-company">Nama Pelanggan<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly required
                                    name="bulan_penggunaan" value="{{ $edit_data ? $edit_data->bulan_penggunaan : '' }}"
                                    placeholder="Masukan Bulan Pengggunaan" />
                                <label for="basic-default-company">Bulan Penggunaan<span
                                        style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="number" placeholder="18" id="meter_awal" required
                                    name="meter_awal" value="{{ $edit_data ? $edit_data->meter_awal : '' }}" />
                                <label for="meter_awal">Meter Awal<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="number" placeholder="18" id="meter_akhir" required
                                    value="{{ $edit_data ? $edit_data->meter_akhir : '' }}" name="meter_akhir" />
                                <label for="meter_akhir">Meter Akhir<span style="color: red;">*</span></label>
                                <div id="error-message" style="color: red; display: none;">Meter Akhir tidak boleh lebih
                                    kecil</div>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="date" id="html5-date-input" required readonly
                                    value="{{ $edit_data ? $edit_data->tanggal_pengecekan : '' }}"
                                    name="tanggal_pengecekan" />
                                <label for="html5-date-input">Tanggal Pengecekan<span style="color: red;">*</span></label>
                            </div>
                            <div class="d-flex gap-2">
                                <button id="simpanbutton" type="submit" class="btn btn-warning">Ubah</button>
                                @if ($edit_data)
                                    <button type="button" class="btn btn-danger"
                                        onclick="location.href='{{ route('pengelolaan-daftar-penggunaan') }}'">Batal</button>
                                @endif
                            </div>
                        </form>
                    @elseif (!$pelanggan)
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
                                                value="{{ $list_pelanggan->no_meter }}-{{ $list_pelanggan->nama_pelanggan }}-{{ $list_pelanggan->alamat_pelanggan }}">
                                            </option>
                                        @endforeach
                                    </datalist>
                                    <label for="exampleDataList"> Info Pelanggan [Tekan Tab]<span
                                            style="color: red;">*</span></label>
                                </div>
                                <button id="searchButton" type="submit" class="btn btn-primary">Cari</button>
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
                                <label for="basic-default-company">Nama Pelanggan<span
                                        style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="basic-default-company" readonly
                                    name="bulan_penggunaan" value="{{ $pelanggan ? $pelanggan->bulan_penggunaan : '' }}"
                                    placeholder="Masukan Bulan Pengggunaan" />
                                <label for="basic-default-company">Bulan Penggunaan<span
                                        style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                    readonly name="meter_awal" value="{{ $pelanggan ? $pelanggan->meter_awal : '' }}" />
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
                                        value="{{ $pelanggan ? $pelanggan->no_meter . '-' . $pelanggan->nama_pelanggan . '-' . $pelanggan->alamat_pelanggan : '' }}"
                                        name="id_pelanggan" placeholder="Type to search...">
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
                                <input class="form-control" type="number" placeholder="18" id="meter_awal" required
                                    readonly name="meter_awal" value="{{ $pelanggan ? $pelanggan->meter_awal : '' }}" />
                                <label for="meter_awal">Meter Awal<span style="color: red;">*</span></label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="number" placeholder="18" id="meter_akhir" required
                                    name="meter_akhir" />
                                <label for="meter_akhir">Meter Akhir<span style="color: red;">*</span></label>
                                <div id="error-message" style="color: red; display: none;">Meter Akhir tidak boleh lebih
                                    kecil</div>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input class="form-control" type="date" id="html5-date-input" required readonly
                                    value="{{ $pelanggan ? $pelanggan->work_date : '' }}" name="tanggal_pengecekan" />
                                <label for="html5-date-input">Tanggal Pengecekan<span style="color: red;">*</span></label>
                            </div>
                            <div class="d-flex gap-2">
                                <button id="simpanbutton" type="submit" class="btn btn-primary">Simpan</button>
                                @if ($pelanggan)
                                    <button type="button" class="btn btn-danger"
                                        onclick="location.href='{{ route('pengelolaan-input-penggunaan') }}'">Batal</button>
                                @endif
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('exampleDataList').addEventListener('keydown', function(event) {
            if (event.key === 'Tab') {
                event.preventDefault(); // Mencegah default behavior Tab
                document.getElementById('searchButton').click(); // Klik tombol Cari
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var meterAwalInput = document.getElementById('meter_awal');
            var meterAkhirInput = document.getElementById('meter_akhir');
            var errorMessage = document.getElementById('error-message');
            var simpanButton = document.getElementById('simpanbutton');

            meterAkhirInput.addEventListener('input', function() {
                var meterAwal = parseFloat(meterAwalInput.value);
                var meterAkhir = parseFloat(meterAkhirInput.value);

                if (meterAkhir < meterAwal) {
                    errorMessage.style.display = 'block';
                    simpanButton.classList.add('d-none');
                    simpanButton.classList.removw('d-block');
                } else {
                    errorMessage.style.display = 'none';
                    simpanButton.classList.add('d-block');
                    simpanButton.classList.remove('d-none');
                }
            });
        });
    </script>

    <!--/ Layout Demo -->


@endsection
