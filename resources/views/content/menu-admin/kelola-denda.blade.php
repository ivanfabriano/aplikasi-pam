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
                <div class="col-4">
                    <div class="card h-100 mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Data Denda</h5>
                            <h6 class="card-subtitle text-muted mb-5">Isian dengan tanda <span style="color: red;">*</span>
                                wajib
                                diisi</h6>
                            @if (!$initial_denda)
                                <form method="POST" action="{{ route('datamaster-tambah-denda') }}">
                                    @csrf
                                    <div class="d-flex gap-2">
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="text" class="form-control" id="basic-default-company" required
                                                name="hari_awal" placeholder="Masukan Hari Awal" />
                                            <label for="basic-default-company">Hari Awal<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="text" class="form-control" id="basic-default-company" required
                                                name="hari_akhir" placeholder="Masukan Hari Akhir" />
                                            <label for="basic-default-company">Hari Akhir<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" name="denda"
                                            required placeholder="Masukan Nilai Denda" />
                                        <label for="basic-default-company">Denda<span style="color: red;">*</span></label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('datamaster-ubah-denda', $initial_denda->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex gap-2">
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="text" class="form-control" id="basic-default-company" required
                                                value="{{ $initial_denda->hari_awal }}" name="hari_awal"
                                                placeholder="Masukan Hari Awal" />
                                            <label for="basic-default-company">Hari Awal<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="text" class="form-control" id="basic-default-company" required
                                                value="{{ $initial_denda->hari_akhir }}" name="hari_akhir"
                                                placeholder="Masukan Hari Akhir" />
                                            <label for="basic-default-company">Hari Akhir<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" name="denda"
                                            required value="{{ $initial_denda->denda }}"
                                            placeholder="Masukan Nilai Denda" />
                                        <label for="basic-default-company">Denda<span style="color: red;">*</span></label>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="location.href='{{ route('datamaster-kelola-denda') }}'">Batal</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-8 mt-3">
                    <div class="card">
                        <h5 class="card-header">Daftar Denda</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Keterlambatan</th>
                                        <th>Denda</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($dendas as $denda)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $denda->keterlambatan }}</td>
                                            <td>Rp. {{ number_format($denda->denda, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <form action="{{ route('datamaster-kelola-denda', $denda->id) }}">
                                                        @method('GET')
                                                        <button type="sumbit" class="btn btn-warning">Edit</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('datamaster-hapus-denda', $denda->id) }}"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
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
