@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Pembayaran Tagihan')

@section('content')
    <!-- Layout Demo -->
    <div class="layout-demo-wrapper">
        <div class="col-xl">
            <div class="card mb-4" style="width: 500px">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update-tagihan', $info_tagihan->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-company" name="id_pelanggan"
                                placeholder="Masukan ID Pelanggan" readonly value="{{ $info_tagihan->id_pelanggan }}" />
                            <label for="basic-default-company">ID Pelanggan<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-company" name="no_meter"
                                placeholder="Masukan No Meter" value="{{ $info_tagihan->no_meter }}" />
                            <label for="basic-default-company">Nomor Meter<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-company" name="nama_pelanggan"
                                placeholder="Masukan Nama Pelanggan" readonly value="{{ $info_tagihan->nama_pelanggan }}" />
                            <label for="basic-default-company">Nama Pelanggan<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="basic-default-company" name="bulan_tagihan"
                                placeholder="Masukan Bulan Tagihan" readonly value="{{ $info_tagihan->bulan_tagihan }}" />
                            <label for="basic-default-company">Bulan Tagihan<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                name="meter_awal" readonly value="{{ $info_tagihan->meter_awal }}" />
                            <label for="html5-number-input">Meter Awal<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                name="meter_akhir" readonly value="{{ $info_tagihan->meter_akhir }}" />
                            <label for="html5-number-input">Meter Akhir<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input" readonly
                                value="{{ $info_tagihan->meter_akhir - $info_tagihan->meter_awal }}" />
                            <label for="html5-number-input">Jumlah Meter<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                name="tarif" readonly value="{{ number_format($info_tagihan->tarif, 0, ',', '.') }}" />
                            <label for="html5-number-input">Tarif/M<sup>3</sup><span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                name="jumlah_bayar" readonly
                                value="{{ number_format($info_tagihan->jumlah_bayar, 0, ',', '.') }}" />
                            <label for="html5-number-input">Jumlah Bayar<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                name="biaya_admin" readonly
                                value="{{ number_format($info_tagihan->biaya_admin, 0, ',', '.') }}" />
                            <label for="html5-number-input">Biaya Admin<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="html5-number-input"
                                name="denda" readonly value="{{ number_format($info_tagihan->denda, 0, ',', '.') }}" />
                            <label for="html5-number-input">Denda<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="number" placeholder="18" id="total_akhir"
                                name="total_akhir" readonly
                                value="{{ number_format($info_tagihan->total_akhir, 0, ',', '.') }}" />
                            <label for="total_akhir">Total Akhir<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="text" placeholder="18" id="bayar" required
                                oninput="formatCurrency(this); hitungKembalian()" name="bayar" />
                            <label for="bayar">Bayar<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="text" placeholder="18" id="kembali" readonly
                                name="kembali" />
                            <label for="kembali">Kembalian<span style="color: red;">*</span></label>
                        </div>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->

    <script>
        function formatCurrency(inputElement) {
            var value = inputElement.value.replace(/\D/g, '');

            var formattedValue = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');

            inputElement.value = formattedValue;
        }

        function hitungKembalian() {
            var totalAkhir = document.getElementById('total_akhir').value.replace(/\D/g, '');;
            var bayar = document.getElementById('bayar').value.replace(/\D/g, '');

            var kembalian = bayar - totalAkhir;

            var formattedKembalian = kembalian.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');

            document.getElementById('kembali').value = formattedKembalian
        }
    </script>



@endsection
