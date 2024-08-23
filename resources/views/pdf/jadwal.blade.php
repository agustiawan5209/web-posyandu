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
        tr td{
            font-size: 14px;
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
                    <p style="color: #666666; margin: 10px 0;">Telepon: 085331347469 | email:puskesmaskarassing@gmail.com| email:puskesmaskarassing@gmail.com </p>
                </td>
            </tr>
        </table>
        <hr style="width: 94%;">
    </header>
    <h1 style="margin-top: 0px;">
        <span style=" width : 300px ;border-bottom: 3px solid #000000; border-spacing: 3px;">
            Jadwal Imunisasi :{{ $posyandu->nama }}</span>
    </h1>

    <table style="margin-left: 60px; margin-top:30px;">
        <thead>
            <tr>
                <td style="padding: 6px 2px; font-weight:700;" colspan="2">Dengan Ini Menyatakan Bahwa Jadwal Imunisasi.</td>
            </tr>
            <tr>
                <td style="padding: 6px 2px; font-weight:700;">Usia </td>
                <td style="padding: 6px 2px; font-weight:700;"> : {{ $data['usia'] }}</td>
            </tr>
            <tr>
                <td style="padding: 6px 2px; font-weight:700;">Tanggal Imunisasi </td>
                <td style="padding: 6px 2px; font-weight:700;"> :
                    {{ $data['tempat_lahir'] }}/ {{ $data['tanggal'] }}</td>
            </tr>
            <tr>
                <td style="padding: 6px 2px; font-weight:700;">Tempat Imunisasi </td>
                <td style="padding: 6px 2px; font-weight:700;"> : {{ $data['tempat'] }} </td>
            </tr>
            <tr>
                <td style="padding: 6px 2px; font-weight:700;">Keterangan </td>
                <td style="padding: 6px 2px; font-weight:700;"> : {!! $data['deskripsi'] !!} </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 6px 2px; font-weight:700;">Telah Mendapatkan Lima Imunisasi Dasar
                    Lengkap (LIL).</td>
            </tr>
        </thead>


    </table>

    <table style="margin-left: 60px;">
        <tr>
            <td colspan="2" style="padding: 6px 2px; font-weight:700;">Demikian Surat Digunakan Sebagaimana
                Mestinya</td>
        </tr>
    </table>

    {{-- TTD --}}
    <div style="width:100%; padding: 0px 0px; ">
        <table style="position: absolute; right:150px; bottom:270px; margin-top: 30px;">
            <tr>
                <td style="font-weight: 700; padding: 4px 0px;"> Desa Karassing, {{ date('j F Y') }}</td>
            </tr>
            <tr>
                <td style="font-weight: 700; padding: 20px 0px;"></td>
            </tr>
            <tr>
                <td style="font-weight: 700; padding: 20px 0px;"></td>
            </tr>
            <tr>
                <td style="font-weight: 700; padding: 4px 0px; text-align: center;">
                    <span>{{ $jadwal->penanggung_jawab }}</span>
                    <hr>
                </td>
            </tr>
            <tr>
                <td style="font-weight: 700; padding: 4px 0px;"> NIP: </td>
            </tr>
        </table>
    </div>

</body>

</html>
