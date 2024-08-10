@extends('layouts/printLayout')

@section('title', 'Cetak Struk')

@section('content')
    <div style="width: 1000px; color:black;">
        <div style="text-align:center">
            <h4>Sumber Tirta Sendangguwo</h4>
            <p>{{ $currentMonthYearIndo }}</p>
        </div>
        <div class="d-flex">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-dark" style="width: 20px; border: 1px solid #000; padding: 0; text-align:center;">
                            No pgl</th>
                        <th class="text-dark" style="width: 200px; border: 1px solid #000; padding: 0; text-align:center;">
                            Nama</th>
                        <th class="text-dark" style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">
                            {{ $monthOnlyAgo[0] }}</th>
                        <th class="text-dark" style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">
                            {{ $monthOnlyAgo[1] }}
                        </th>
                        <th class="text-dark" style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">
                            {{ $monthOnlyAgo[2] }}
                        </th>
                        <th class="text-dark" style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">
                            {{ $monthOnlyAgo[3] }}
                        </th>
                        <th class="text-dark" style="width: 30px; border: 1px solid #000; padding: 0; text-align:center;">
                            Total Tagihan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_tunggakan as $tunggakan)
                        <tr>
                            <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                {{ $tunggakan['no_meter'] }}
                            </td>
                            <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                {{ $tunggakan['nama_pelanggan'] }}
                            </td>
                            <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                {{ isset($tunggakan[$monthOnlyAgo[0]]) ? 'Rp. ' . number_format($tunggakan[$monthOnlyAgo[0]], 0, ',', '.') : 'Rp. 0' }}
                            </td>
                            <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                {{ isset($tunggakan[$monthOnlyAgo[1]]) ? 'Rp. ' . number_format($tunggakan[$monthOnlyAgo[1]], 0, ',', '.') : 'Rp. 0' }}
                            </td>
                            <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                {{ isset($tunggakan[$monthOnlyAgo[2]]) ? 'Rp. ' . number_format($tunggakan[$monthOnlyAgo[2]], 0, ',', '.') : 'Rp. 0' }}
                            </td>
                            <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                {{ isset($tunggakan[$monthOnlyAgo[3]]) ? 'Rp. ' . number_format($tunggakan[$monthOnlyAgo[3]], 0, ',', '.') : 'Rp. 0' }}
                            </td>
                            <td class="text-dark" style="border: 1px solid #000; padding: 0;">
                                {{ 'Rp. ' . number_format($tunggakan['jumlah_akhir'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
