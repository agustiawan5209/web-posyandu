<!DOCTYPE html>
<html>
<head>
    <title>Data Penyewaan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .header h1, .header h2, .header p {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        {{-- <img src="{{ asset('path/to/logo.png') }}" alt="Logo Perusahaan"> --}}
        <h1>UPT PUSKESMAS Desa Karassing</h1>
        <h2>Ds. Karassing, Kec. Hero Lange-Lange</h2>
        <p>Ds. Karassing, Kec. Hero Lange-Lange</p>
        <p>Telepon: 085331347469 | email:puskesmaskarassing@gmail.com</p>
        <hr>
    </div>
    <div class="content">
        <h1>Data Posyandu : {{ $posyandu->nama }}</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Balita</th>
                    <th>Usia Balita</th>
                    <th>Jenis Kelamin Balita</th>
                    <th>Jenis Imunisasi</th>
                    <th>Tanggal Imunisasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $riwayat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->nama_anak }}</td>
                        <td>{{ $riwayat->usia_anak }}</td>
                        <td>{{ $riwayat->jenkel_anak }}</td>
                        <td>{{ $riwayat->jenis_imunisasi }}</td>
                        <td>{{ $riwayat->tanggal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
