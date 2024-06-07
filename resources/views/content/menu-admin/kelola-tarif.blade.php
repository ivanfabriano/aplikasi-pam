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
                            <h5 class="card-title">Data Tarif</h5>
                            <h6 class="card-subtitle text-muted">Informasi detail data tarif</h6>
                        </div>
                        @php
                            $tarif_id = null;
                        @endphp
                        <div class="card-body">
                            @if (!$initial_tarif)
                                <form method="POST" action="{{ route('datamaster-tambah-tarif') }}">
                                    @csrf
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company"
                                            name="golongan" placeholder="Masukan Nama Golongan" />
                                        <label for="basic-default-company">Golongan</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company"
                                            name="abonemen" placeholder="Masukan Abonemen" />
                                        <label for="basic-default-company">Abonemen</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" name="tarif"
                                            placeholder="Masukan Jumlah Tarif" />
                                        <label for="basic-default-company">Tarif</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('datamaster-ubah-tarif', $initial_tarif->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company"
                                            value="{{ $initial_tarif->golongan }}" name="golongan"
                                            placeholder="Masukan Nama Golongan" />
                                        <label for="basic-default-company">Golongan</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company"
                                            value="{{ $initial_tarif->abonemen }}" name="abonemen"
                                            placeholder="Masukan Abonemen" />
                                        <label for="basic-default-company">Abonemen</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" name="tarif"
                                            value="{{ $initial_tarif->tarif }}" placeholder="Masukan Jumlah Tarif" />
                                        <label for="basic-default-company">Tarif</label>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="location.href='{{ route('datamaster-kelola-tarif') }}'">Batal</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-8 mt-3">
                    <div class="card">
                        <h5 class="card-header">Daftar Tarif</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Tarif</th>
                                        <th>Golongan</th>
                                        <th>Abonemen</th>
                                        <th>Tarif/M<sup>3</sup></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($tarifs as $tarif)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $tarif->kode_tarif }}</td>
                                            <td>{{ $tarif->golongan }}</td>
                                            <td>{{ $tarif->abonemen }}</td>
                                            <td>{{ $tarif->tarif }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <form action="{{ route('datamaster-kelola-tarif', $tarif->id) }}">
                                                        @method('GET')
                                                        <button type="sumbit" class="btn btn-warning">Edit</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('datamaster-hapus-tarif', $tarif->id) }}"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
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
