@extends('layouts/printLayout')

@section('title', 'Cetak Struk')

@section('content')
    <div style="width: 1000px; color:black;">
        @if (session('list_tunggakan'))
            <div style="text-align:center">
                <h4>Sumber Tirta Sendangguwo</h4>
                <p>{{ session('currentMonthYearIndo') }} [ {{ session('wilayah') }} ]</p>
            </div>
            <div class="d-flex">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-dark"
                                style="width: 20px; border: 1px solid #000; padding: 0; font-weight: 600; text-align:center;">
                                No pgl</th>
                            <th class="text-dark"
                                style="width: 200px; border: 1px solid #000; padding: 0; font-weight: 600; text-align:center;">
                                Nama</th>
                            <th class="text-dark"
                                style="width: 30px; border: 1px solid #000; padding: 0; font-weight: 600; text-align:center;">
                                {{ session('monthOnlyAgo')[0] }}</th>
                            <th class="text-dark"
                                style="width: 30px; border: 1px solid #000; padding: 0; font-weight: 600; text-align:center;">
                                {{ session('monthOnlyAgo')[1] }}
                            </th>
                            <th class="text-dark"
                                style="width: 30px; border: 1px solid #000; padding: 0; font-weight: 600; text-align:center;">
                                {{ session('monthOnlyAgo')[2] }}
                            </th>
                            <th class="text-dark"
                                style="width: 30px; border: 1px solid #000; padding: 0; font-weight: 600; text-align:center;">
                                {{ session('monthOnlyAgo')[3] }}
                            </th>
                            <th class="text-dark"
                                style="width: 30px; border: 1px solid #000; padding: 0; font-weight: 600; text-align:center;">
                                Total Tagihan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('list_tunggakan') as $tunggakan)
                            <tr>
                                <td class="text-dark px-2" style="border: 1px solid #000; padding: 0; font-weight: 600;">
                                    {{ $tunggakan['no_meter'] }}
                                </td>
                                <td class="text-dark px-2" style="border: 1px solid #000; padding: 0; font-weight: 600;">
                                    {{ $tunggakan['nama_pelanggan'] }}
                                </td>
                                <td class="text-dark px-2" style="border: 1px solid #000; padding: 0; font-weight: 600;">
                                    {{ isset($tunggakan[session('monthOnlyAgo')[0]]) ? 'Rp. ' . number_format($tunggakan[session('monthOnlyAgo')[0]], 0, ',', '.') : 'Rp. 0' }}
                                </td>
                                <td class="text-dark px-2" style="border: 1px solid #000; padding: 0; font-weight: 600;">
                                    {{ isset($tunggakan[session('monthOnlyAgo')[1]]) ? 'Rp. ' . number_format($tunggakan[session('monthOnlyAgo')[1]], 0, ',', '.') : 'Rp. 0' }}
                                </td>
                                <td class="text-dark px-2" style="border: 1px solid #000; padding: 0; font-weight: 600;">
                                    {{ isset($tunggakan[session('monthOnlyAgo')[2]]) ? 'Rp. ' . number_format($tunggakan[session('monthOnlyAgo')[2]], 0, ',', '.') : 'Rp. 0' }}
                                </td>
                                <td class="text-dark px-2" style="border: 1px solid #000; padding: 0; font-weight: 600;">
                                    {{ isset($tunggakan[session('monthOnlyAgo')[3]]) ? 'Rp. ' . number_format($tunggakan[session('monthOnlyAgo')[3]], 0, ',', '.') : 'Rp. 0' }}
                                </td>
                                <td class="text-dark px-2" style="border: 1px solid #000; padding: 0; font-weight: 600;">
                                    {{ 'Rp. ' . number_format($tunggakan['jumlah_akhir'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h2>Tidak ada data yang ditemukan</h2>
            <p>Coba kembali ke halaman laporan pelanggan</p>
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                window.print();
            }, 1500);
        });
    </script>
@endsection
