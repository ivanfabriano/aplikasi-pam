@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Container - Layouts')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <img class="mb-4" src="{{ asset('assets/img/logos/logo1.png') }}" alt="Logo" width="180px">
        <h3 class="text-center">Selamat Datang di Aplikasi <br>Pembayaran Pengelolaan Air Bersih</h3>
    </div>
    <!--/ Layout Demo -->


@endsection
