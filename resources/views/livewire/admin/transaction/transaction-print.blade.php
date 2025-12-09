<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .col {
            width: 45%;
            text-align: center;
        }

        /* Gaya untuk saat cetak saja */
        @media print {
            @page {
                size: A4 landscape;
                margin: 10mm;
            }

            body {
                zoom: 70%;
            }

            .row {
                display: flex;
                justify-content: space-between;
                margin-top: 40px;
            }

            .col {
                width: 45%;
                text-align: center;
            }
        }
    </style>

</head>

<body onload="window.print()">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="text-center">
                        <h4 class="fw-bold">BENGKEL SUMBER LANCAR</h4>
                        <p>LAS, KETOK, CAT, BODY REPAIR, SERVICE, MODIFIKASI</p>
                        <p>Jl. Raya Gunung Putri No. 46 Gunung Putri-Bogor HP. 082110046388</p>
                        <hr>
                    </div>

                    <div class="d-flex justify-content-between" style="display: flex; justify-content: space-between;">
                        <div>
                            <p><strong>Invoice No:</strong> {{ $transaction->invoice }}</p>
                            <p><strong>Tanggal Invoice:</strong> {{ $transaction->created_at }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ $transaction->metode_bayar }}</p>
                        </div>
                        <div>
                            <p><strong>Bill to:</strong> {{ $transaction->member->nama ?? '-' }}</p>
                            <p><strong>For:</strong> {{ $transaction->jenis_kendaraan }}</p>
                            <p><strong>No. Plat:</strong> {{ $transaction->plat_nomor }}</p>
                        </div>
                    </div>

                    <div class="section-title">BIAYA SUKU CADANG</div>
                    <table>
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Sat</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $i => $item)
                                @if ($item->jenis == 'Produk')
                                    <tr class="text-center">
                                        <td>{{ $i + 1 }}</td>
                                        <td class="text-start">{{ $item->nama_item }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp</td>
                                        <td class="text-end">{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($item->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Jumlah Total</td>
                                <td class="text-end fw-bold">Rp {{ number_format($total_sparepart, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="section-title">BIAYA JASA SERVICE</div>
                    <table>
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Description</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($details as $item)
                                @if ($item->jenis == 'Service')
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $item->nama_item }}</td>
                                        <td class="text-end">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-end fw-bold">Jumlah</td>
                                <td class="text-end fw-bold">Rp {{ number_format($total_jasa, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="section-title">JUMLAH TOTAL BIAYA</div>
                    <table>
                        <tbody>
                            <tr>
                                <td><strong>Biaya Suku Cadang</strong></td>
                                <td class="text-end">Rp {{ number_format($total_sparepart, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Biaya Jasa Service</strong></td>
                                <td class="text-end">Rp {{ number_format($total_jasa, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Grand Total</td>
                                <td class="text-end fw-bold">Rp {{ number_format($total, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                @if ($transaction->bayar)
                                <td><strong>Bayar</strong></td>
                                <td class="text-end">Rp {{ number_format($transaction->bayar ?? 0, 0, ',', '.') }}
                                </td>
                                @else
                                <td><strong>Bayar</strong></td>
                                <td class="text-end">Rp {{ number_format($transaction->nominal_debit ?? 0, 0, ',', '.') }}
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Kembalian</strong></td>
                                <td class="text-end">Rp {{ number_format($transaction->kembalian ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="row">
                        <div class="col">
                            <p>Hormat Kami</p>
                            <br><br>
                            <p><strong>{{ $transaction->user->name }}</strong><br>Admin</p>
                        </div>
                        <div class="col">
                            <p>Client/Customer</p>
                            <br><br>
                            <p><strong>{{ $transaction->member->nama ?? '-' }}</strong><br>Customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
