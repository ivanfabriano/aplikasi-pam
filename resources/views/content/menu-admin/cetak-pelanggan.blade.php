@extends('layouts/printLayout')

@section('title', 'Cetak Struk')

@section('content')
    <div style="width: 1000px; color:black;">
        @if (session('penggunaan'))
            @foreach (array_chunk(session('penggunaan')->toArray(), 100) as $batch)
                <div style="text-align:center">
                    <h4>Sumber Tirta Sendangguwo</h4>
                    <p>Bulan : {{ session('bulan') . ' ' . session('tahun') }}</p>
                </div>
                <div class="d-flex">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-dark"
                                    style="width: 20px; border: 1px solid #000; padding: 0; text-align:center;">
                                    No pgl</th>
                                <th class="text-dark"
                                    style="width: 200px; border: 1px solid #000; padding: 0; text-align:center;">Nama</th>
                                <th class="text-dark"
                                    style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">
                                    Meter Awal</th>
                                <th class="text-dark"
                                    style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">Meter Akhir
                                </th>
                                <th class="text-dark"
                                    style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">
                                    M<sup>3</sup>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batch as $index => $row)
                                @if ($index < 50)
                                    <tr>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->no_meter }}
                                        </td>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->nama_pelanggan }}
                                        </td>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->meter_awal }}
                                        </td>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->meter_akhir }}
                                        </td>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->meter_akhir - $row->meter_awal == 0 ? '' : $row->meter_akhir - $row->meter_awal }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-dark"
                                    style="width: 20px; border: 1px solid #000; padding: 0; text-align:center;">No pgl</th>
                                <th class="text-dark"
                                    style="width: 200px; border: 1px solid #000; padding: 0; text-align:center;">Nama</th>
                                <th class="text-dark"
                                    style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">Meter Awal
                                </th>
                                <th class="text-dark"
                                    style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">Meter Akhir
                                </th>
                                <th class="text-dark"
                                    style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">
                                    M<sup>3</sup>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batch as $index => $row)
                                @if ($index >= 50)
                                    <tr>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->no_meter }}
                                        </td>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->nama_pelanggan }}
                                        </td>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->meter_awal }}
                                        </td>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->meter_akhir }}
                                        </td>
                                        <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                            {{ $row->meter_akhir - $row->meter_awal == 0 ? '' : $row->meter_akhir - $row->meter_awal }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
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
