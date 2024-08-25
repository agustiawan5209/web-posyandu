<html>

<head>
    <title>{{ $title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        * {
            margin: 0;
            letter-spacing: 0px;

        }

        .page-break {
            page-break-after: always;
        }

        h1 .title {
            font-weight: 900;
            border-bottom: 3px solid #000000;
            border-spacing: 3px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        tr td {
            font-size: 13px;
        }

        .keterangan {
            padding-left: 20px;
            padding-right: 20px;
        }

        .keterangan table,
        .keterangan th,
        .keterangan td {
            border: 1px solid black;
        }

        .keterangan th,
        .keterangan td {
            padding: 0px;
            text-align: left;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <header style="width: 100%;  padding: 30px 30px 0px 30px; ">
        <table class="margin-left:30px;">
            <tr style="width: 150px;">
                <td>
                    <img src="{{ public_path('images/logo/logo-dark.png') }}" alt="Logo" width="100"
                        style="max-width: 100%; height: auto; display: block;">
                </td>
                <td style="max-width: 600px; margin: 0 auto; text-align: center;">
                    <h1 style="color: #333333; margin: 0;">Dinas Kesehatan Kabupaten Bulukumba</h1>
                    <p style="color: #666666; margin: 10px 0;">UPT PUSKESMAS KARASSING</p>
                    <p style="color: #666666; margin: 10px 0;">Telepon: 085331347469 |
                        email:puskesmaskarassing@gmail.com </p>
                </td>
            </tr>
        </table>
        <hr style="width: 94%;">
    </header>
    <h1 style="margin-top: 0px;">
        <span style="border-bottom: 3px solid #000000;font-size:15px;">
            Jadwal Imunisasi :{{ $posyandu->nama }}</span>
        @if (isset($tanggal['start_date']) && isset($tanggal['end_date']))
            <br>
            <span style="border-spacing: 3px; font-size:15px;">
                Periode :{{ $tanggal['start_date'] }}-{{ $tanggal['end_date'] }} </span>
        @endif
    </h1>

    <table class="keterangan">
        <thead>
            <tr>
                <th style="padding: 6px 2px; font-weight:700;">No. </th>
                <th style="padding: 6px 2px; font-weight:700;">Usia </th>
                <th style="padding: 6px 2px; font-weight:700;">Tanggal Imunisasi </th>
                <th style="padding: 6px 2px; font-weight:700;">Tempat Imunisasi </th>
                <th style="padding: 6px 2px; font-weight:700;">Keterangan </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->usia }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->tempat }}</td>
                    <td>{!! $item->deskripsi !!} </td>
                </tr>
            @endforeach
        </tbody>


    </table>

    <table style="margin-left: 60px;">
        <tr>
            <td colspan="2" style="padding: 6px 2px; font-weight:0;">Demikian Surat Digunakan Sebagaimana
                Mestinya</td>
        </tr>
    </table>

    {{-- TTD --}}
    <div style="width:100%; position: relative; padding: 0px 0px; ">
        <table style="width: 300px; position: absolute; right:30px; top:0; margin-top: 30px;">
            <tr>
                <td style="font-weight: 0; padding: 4px 0px;"> Desa Karassing, {{ date('j F Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 0; padding: 20px 0px;"></td>
            </tr>
            <tr>
                <td style="font-weight: 0; padding: 20px 0px;"></td>
            </tr>
            <tr>
                <td style="font-weight: 0; padding: 4px 0px; text-align: center;">
                    <span>Darmalam S.Kep.,Ns
                    </span>
                    <hr>
                </td>
            </tr>
            <tr>
                <td style="font-weight: 0; padding: 4px 0px;"> NIP: 19770128 200212 2 006</td>
            </tr>
        </table>
    </div>

</body>

</html>
