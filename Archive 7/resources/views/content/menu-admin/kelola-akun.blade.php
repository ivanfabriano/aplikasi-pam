@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Kelola Akun')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div clas="bg-white w-100" style="width: 100%">
            <div class="row">
                <div class="col-4">
                    <div class="card h-100 mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Data Akun</h5>
                            <h6 class="card-subtitle text-muted">Informasi detail data akun</h6>
                        </div>
                        <div class="card-body">
                            @if (!$initial_user)
                                <form method="POST" action="{{ route('datamaster-tambah-akun') }}">
                                    @csrf
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" required
                                            name="username" placeholder="Masukan Username Petugas" />
                                        <label for="basic-default-company">Username<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" required
                                            name="password" placeholder="Masukan Password Petugas" />
                                        <label for="basic-default-company">Password<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company"
                                            name="no_telepon" placeholder="Masukan Nomor telepon Petugas" />
                                        <label for="basic-default-company">Nomor Telepon</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input class="form-control" list="datalistOptions" id="exampleDataList" required
                                            name="role" placeholder="Pilih Role Akun">
                                        <datalist id="datalistOptions">
                                            <option value="Admin"></option>
                                            <option value="Petugas"></option>
                                        </datalist>
                                        <label for="exampleDataList">Role<span style="color: red;">*</span></label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('datamaster-ubah-akun', $initial_user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" required
                                            name="username" value="{{ $initial_user->username }}"
                                            placeholder="Masukan Username Petugas" />
                                        <label for="basic-default-company">Username<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company" required
                                            name="password" placeholder="Masukan Password Petugas" />
                                        <label for="basic-default-company">Password<span
                                                style="color: red;">*</span></label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="text" class="form-control" id="basic-default-company"
                                            name="no_telepon" value="{{ $initial_user->no_telepon }}"
                                            placeholder="Masukan Nomor telepon Petugas" />
                                        <label for="basic-default-company">Nomor Telepon</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input class="form-control" list="datalistOptions" id="exampleDataList" required
                                            name="role" value="{{ $initial_user->role }}" placeholder="Pilih Role Akun">
                                        <datalist id="datalistOptions">
                                            <option value="Admin"></option>
                                            <option value="Petugas"></option>
                                        </datalist>
                                        <label for="exampleDataList">Role<span style="color: red;">*</span></label>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="location.href='{{ route('datamaster-kelola-akun') }}'">Batal</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-8 mt-3">
                    <div class="card">
                        <h5 class="card-header">Daftar Akun</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>No Telepon</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->no_telepon }}</td>
                                            <td>{!! $user->role == 'Admin'
                                                ? '<span style="width: 70px;" class="badge rounded-pill bg-success">Admin</span>'
                                                : '<span style="width: 70px;" class="badge rounded-pill bg-info">Petugas</span>' !!}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <form action="{{ route('datamaster-kelola-akun', $user->id) }}">
                                                        @method('GET')
                                                        <button type="sumbit" class="btn btn-warning">Edit</button>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('datamaster-hapus-akun', $user->id) }}"
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
