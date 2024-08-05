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

        .header h1,
        .header h2,
        .header p {
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 0px;
            text-align: left;
            font-size: 10px;
        }
    </style>
</head>

<body>
    @php
        function getHistoryImunisasi($obj1, $current)
        {
            $array = (array) $obj1;
            // Pastikan $obj1 adalah array sebelum diproses
            if (!is_array($array) || empty($array)) {
                return $array; // Atau tangani kesalahan sesuai kebutuhan Anda
            }

            // Ambil semua jenis_imunisasi dari objek
            $data_imunisasi = array_map(function ($elem) {
                return $elem['jenis_imunisasi'];
            }, $array);

            // Periksa apakah jenis imunisasi saat ini ada dalam data_imunisasi
            if (in_array($current, $data_imunisasi)) {
                // Filter data Imunisasi sesuai dengan jenis_imunisasi yang cocok
                $matchedImunisasi = array_filter($array, function ($imun) use ($current) {
                    return $imun['jenis_imunisasi'] === $current;
                });

                // Reset array untuk mendapatkan elemen pertama
                $matchedImunisasi = array_values($matchedImunisasi);

                // Return tanggal jika data ditemukan
                return $matchedImunisasi[0]['tanggal'];
            } else {
                // Jika tidak ada yang cocok, kembalikan string '---'
                return '---';
            }
        }
    @endphp
    <div class="header">
        {{-- <img src="{{ asset('path/to/logo.png') }}" alt="Logo Perusahaan"> --}}
        <h1>UPT PUSKESMAS Desa Karassing</h1>
        <h2>Ds. Karassing, Kec. Hero Lange-Lange</h2>
        <p>Alamat Perusahaan</p>
        <p>Telepon: +62 85255814561 </p>
        <hr>
    </div>
    <div class="content">
        @if ($posyandu)
            <h1>Data Posyandu : {{ $posyandu->nama }}</h1>
        @endif
        <table>
            <thead>
                <tr>
                    <th scope="col">
                        No
                    </th>
                    <th scope="col">
                        Nama Balita
                    </th>
                    <th scope="col">
                        Jenis Kelamin
                    </th>
                    <th scope="col">
                        Tanggal Lahir
                    </th>
                    <th scope="col">
                        Nama Orang Tua
                    </th>
                    <th scope="col">
                        Alamat
                    </th>
                    @foreach ($jenis_imunisasi as $item)
                        <th scope="col">
                            {{ $item }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($balita as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['jenkel'] }}</td>
                        <td>{{ $item['tgl_lahir'] }}</td>
                        <td>{{ $item['orang_tua']['nama'] }}</td>
                        <td>{{ $item['orang_tua']['alamat'] }}</td>
                        @foreach ($jenis_imunisasi as $col)
                            <th scope="col">
                                {{ getHistoryImunisasi($item['riwayat_imunisasis'], $col) }}
                            </th>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
