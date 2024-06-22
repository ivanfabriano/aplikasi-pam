@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Kelola Pelanggan')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div clas="bg-white w-100" style="width: 100%">
            <div class="row">
                <div class="col-3">
                    <div class="card h-100 mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Data Pelanggan</h5>
                            <h6 class="card-subtitle text-muted mb-5">Isian dengan tanda <span style="color: red;">*</span>
                                wajib
                                diisi</h6>
                            @if (!$initial_pelanggan)
                                <form method="POST" action="{{ route('datamaster-tambah-pelanggan') }}">
                                    @csrf
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" readonly
                                            value="{{ $last_id_pelanggan }}" name="id_pelanggan"
                                            placeholder="Masukan ID Pelanggan" />
                                        <label for="basic-default-company">ID Pelanggan<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" required
                                            name="no_meter" placeholder="Masukan No Meter" />
                                        <label for="basic-default-company">No Meter<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" required
                                            name="nama_pelanggan" placeholder="Masukan Nama Pelanggan" />
                                        <label for="basic-default-company">Nama Pelanggan<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select class="form-select" id="exampleFormControlSelect1" name="alamat_pelanggan"
                                            aria-label="Pilih alamat pelanggan">
                                            <option selected>Pilih alamat</option>
                                            <option value="kedungmundu">kedungmundu</option>
                                            <option value="sendangguwo">sendangguwo</option>
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Alamat</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select class="form-select" id="exampleFormControlSelect1" name="jenis_tarif"
                                            aria-label="Pilih Jenis Tarif">
                                            <option selected>Pilih jenis tarif</option>
                                            @foreach ($tarifs as $tarif)
                                                <option value="{{ $tarif->kode_tarif }}">{{ $tarif->kode_tarif }}</option>
                                            @endforeach
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Jenis Tarif</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            @else
                                <form method="POST"
                                    action="{{ route('datamaster-ubah-pelanggan', $initial_pelanggan->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" readonly
                                            value="{{ $initial_pelanggan->id_pelanggan }}" name="id_pelanggan"
                                            placeholder="Masukan ID Pelanggan" />
                                        <label for="basic-default-company">ID Pelanggan<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" required
                                            value="{{ $initial_pelanggan->no_meter }}" name="no_meter"
                                            placeholder="Masukan No Meter" />
                                        <label for="basic-default-company">No Meter<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" required
                                            value="{{ $initial_pelanggan->nama_pelanggan }}" name="nama_pelanggan"
                                            placeholder="Masukan Nama Pelanggan" />
                                        <label for="basic-default-company">Nama Pelanggan<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select class="form-select" id="exampleFormControlSelect1" name="alamat_pelanggan"
                                            aria-label="Pilih alamat pelanggan">
                                            <option selected>Pilih alamat</option>
                                            <option
                                                {{ $initial_pelanggan->alamat_pelanggan == 'kedungmundu' ? 'selected' : '' }}
                                                value="kedungmundu">kedungmundu</option>
                                            <option
                                                {{ $initial_pelanggan->alamat_pelanggan == 'sendangguwo' ? 'selected' : '' }}
                                                value="sendangguwo">sendangguwo</option>
                                        </select>
                                        <label for="exampleFormControlSelect1">Pilih Alamat</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input class="form-control" list="datalistOptions" id="exampleDataList" required
                                            value="{{ $initial_pelanggan->jenis_tarif }}" name="jenis_tarif"
                                            placeholder="Pilih Jenis Tarif">
                                        <datalist id="datalistOptions">
                                            @foreach ($tarifs as $tarif)
                                                <option
                                                    {{ $initial_pelanggan->jenis_tarif == '$tarif->kode_tarif' ? 'selected' : '' }}
                                                    value="{{ $tarif->kode_tarif }}"></option>
                                            @endforeach
                                        </datalist>
                                        <label for="exampleDataList">Jenis Tarif<span style="color: red;">*</span></label>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="location.href='{{ route('datamaster-kelola-pelanggan') }}'">Batal</button>
                                    </div>
                                </form>
                                <form method="POST"
                                    action="{{ route('pengelolaan-reset-penggunaan', $initial_pelanggan->id) }}"
                                    onsubmit="return confirm('Apakah Anda yakin ingin mereset meter?');">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-success mt-2">Reset Meter</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-9 mt-3">
                    <div class="card">
                        <h5 class="card-header">Daftar Pelanggan</h5>
                        <div>
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <form class="d-flex gap-2 align-items-center"
                                        action="{{ route('datamaster-kelola-pelanggan') }}" method="GET"
                                        style="width: 100%">
                                        <div class="d-flex gap-2" style="width: 460px">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="telat_bayar"
                                                    {{ request()->get('telat_bayar') == 'on' ? 'checked' : '' }}
                                                    id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"> Telat
                                                    Bayar</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="meter_rusak"
                                                    {{ request()->get('meter_rusak') == 'on' ? 'checked' : '' }}
                                                    id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"> Meter
                                                    Rusak</label>
                                            </div>
                                        </div>

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
                                            onclick="location.href='{{ route('datamaster-kelola-pelanggan') }}'">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="width: 80px;">ID Pelanggan</th>
                                        <th>No Meter</th>
                                        <th style="width: 120px;">Nama</th>
                                        <th>Alamat</th>
                                        <th>Tenggang</th>
                                        <th>Kode Tarif</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pelanggans as $pelanggan)
                                        <tr
                                            class="{{ $pelanggan->tertunggak ? 'table-danger' : '' }} {{ $pelanggan->meteran_rusak ? 'table-warning' : '' }} ">
                                            <td>{{ $no }}</td>
                                            <td>{{ $pelanggan->id_pelanggan }}</td>
                                            <td>{{ $pelanggan->no_meter }}</td>
                                            <td>{{ $pelanggan->nama_pelanggan }}</td>
                                            <td>{{ $pelanggan->alamat_pelanggan }}</td>
                                            <td>Hari ke-{{ $pelanggan->tenggang }}</td>
                                            <td>{{ $pelanggan->jenis_tarif }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="mdi mdi-dots-vertical"></i></button>
                                                    <div class="dropdown-menu p-2">
                                                        <div class="d-flex gap-1">
                                                            <form
                                                                action="{{ route('datamaster-kelola-pelanggan', $pelanggan->id) }}">
                                                                @method('GET')
                                                                <button type="sumbit"
                                                                    class="btn btn-warning">Edit</button>
                                                            </form>
                                                            <form method="POST"
                                                                action="{{ route('datamaster-hapus-pelanggan', $pelanggan->id) }}"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
