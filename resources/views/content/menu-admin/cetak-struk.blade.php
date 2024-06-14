@extends('layouts/blankLayout')

@section('title', 'Cetak Struk')

@section('content')
    <div style="width: 1000px; color:black; font-size: 23px; font-weight:bold">
        <div class="row">
            <div class="col-12 text-center">
                <p style="font-size: 27px; font-weight:bolder">SUMBERTIRTA</p>
                <p>Jl. Karanggawang Lama Kel.Sendangguwo, Kec. Tembalang, Semarang <br>
                    Telp. (024) 6723477; HP. 081 249 7777 22 <br>
                    STRUK PEMBAYARAN TAGIHAN AIR
                </p>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                IDPEL
            </div>
            <div class="col-6">
                : {{ session('tagihan_data')->id_pelanggan }}
            </div>
            <div class="col">
                Tanggal
            </div>
            <div class="col">
                : {{ session('tagihan_data')->waktu_bayar }}
            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                NAMA
            </div>
            <div class="col-6">
                : {{ session('tagihan_data')->no_meter }} | {{ session('tagihan_data')->nama_pelanggan }}
            </div>
            <div class="col">
                BL/TH
            </div>
            <div class="col">
                : {{ session('tagihan_data')->bulan_tagihan . ' ' . explode('-', session('tagihan_data')->created_at)[0] }}
            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                TARIF
            </div>
            <div class="col-6">
                : {{ session('tagihan_data')->jenis_tarif }}
            </div>
            <div class="col">
                STAND METER
            </div>
            <div class="col">
                : {{ session('tagihan_data')->meter_awal . '-' . session('tagihan_data')->meter_akhir }}
            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                RP.TAG AIR
            </div>
            <div class="col-6">
                : Rp. {{ number_format(session('tagihan_data')->jumlah_bayar, 0, ',', '.') }},-
            </div>
            <div class="col">

            </div>
            <div class="col">
                : {{ session('tagihan_data')->meter_akhir - session('tagihan_data')->meter_awal }} m<sup>3</sup>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                DENDA
            </div>
            <div class="col-6">
                : Rp. {{ number_format(session('tagihan_data')->denda, 0, ',', '.') }},-
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                ABONEMEN
            </div>
            <div class="col-6">
                : Rp. {{ number_format(session('tagihan_data')->biaya_admin, 0, ',', '.') }},-
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
        </div>
        <div class="row mb-1">
            <div class="col">
                TOTAL BAYAR
            </div>
            <div class="col-6">
                : Rp. {{ number_format(session('tagihan_data')->total_akhir, 0, ',', '.') }},-
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <p>Untuk menghindari denda dan pemutusan, bayarlah pada tanggal 1 s/d 20 tiap bulannya <br>
                    Rincian Tagihan dapat menghubungi kami <br>
                    TERIMA KASIH
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                window.print();
            }, 1500);
        });
    </script>
@endsection
