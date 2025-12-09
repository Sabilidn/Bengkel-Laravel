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

        th, td {
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

    <h2>Laporan Data Pelanggan</h2>
    <div class="tanggal">Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Nomor Handphone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $key => $member)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->nomor_handphone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Admin,</p>
        <p class="nama">{{ Auth()->user()->name }}</p>
    </div>

</body>
</html>
