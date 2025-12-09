<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Data Pelanggan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .logo {
            width: 150px;
        }

        .title {
            text-align: center;
            flex: 1;
            padding-left: 10px;
        }

        .title h1 {
            margin: 0;
            font-size: 20px;
        }

        .title p {
            margin: 2px 0;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin: 5px 0;
        }

        .tanggal {
            text-align: center;
            font-size: 12px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px 8px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }

        .ttd {
            width: 100%;
            margin-top: 50px;
            text-align: right;
            padding-right: 60px;
        }

        .ttd p {
            margin: 2px 0;
        }

        .ttd .nama {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('assets/img/logo.png') }}" class="logo" alt="Logo">
        <div class="title">
            <h1>Bengkel Nusantara</h1>
            <p>Jl. Merdeka No. 123, Jakarta</p>
        </div>
    </div>

    <h2>Laporan Data Transaksi</h2>
    @if (request('start_date') && request('end_date'))
        <div class="tanggal">Periode: {{ date('d-m-Y', strtotime(request('start_date'))) }} s/d
            {{ date('d-m-Y', strtotime(request('end_date'))) }}</div>
    @else
        <div class="tanggal">Periode : <i>Semua Periode</i></div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Invoice</th>
                <th>Nama Item</th>
                <th>Pelanggan</th>
                <th>Plat Nomor</th>
                <th>Jenis Kendaraan</th>
                <th>Jenis Transaksi</th>
                <th>Total</th>
                <th>Metode Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->invoice }}</td>
                    <td style="text-align: left">
                        <ul style="padding-left: 15px; margin: 0;">
                            @foreach ($item->details as $detail)
                                <li>{{ $detail->nama_item }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $item->member->nama }}</td>
                    <td>{{ $item->plat_nomor }}</td>
                    <td>{{ $item->jenis_kendaraan }}</td>
                    <td>
                        @if ($item->jenis_transaksi === 'Produk & Service')
                            Produk & Service
                        @elseif ($item->jenis_transaksi === 'Produk')
                            Produk
                        @elseif ($item->jenis_transaksi === 'Service')
                            Service
                        @else
                            -
                        @endif
                    </td>
                    <td style="text-align: right">Rp {{ number_format($item->details->sum('total'), 0, ',', '.') }}
                    </td>
                    <td>{{ $item->metode_bayar }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" style="text-align: right; font-weight: bold;">Total Keseluruhan:</td>
                <td colspan="2" style="text-align: right; font-weight: bold;">Rp
                    {{ number_format($total_semua, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="ttd">
        <p>Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Admin,</p>
        <p class="nama">{{ Auth()->user()->name }}</p>
    </div>

</body>

</html>
