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
                            <h5 class="card-title">Data Petugas</h5>
                            <h6 class="card-subtitle text-muted">Informasi detail data petugas</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        placeholder="Masukan Username Petugas" />
                                    <label for="basic-default-company">Username</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        placeholder="Masukan Password Petugas" />
                                    <label for="basic-default-company">Password</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        placeholder="Masukan Nomor telepon Petugas" />
                                    <label for="basic-default-company">Nomor Telepon</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8 mt-3">
                    <div class="card">
                        <h5 class="card-header">Daftar Petugas</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>No Telepon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>petugas.ivan</td>
                                        <td>test123</td>
                                        <td>088221532894</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-warning">Edit</button>
                                                <button type="button" class="btn btn-danger">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
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
