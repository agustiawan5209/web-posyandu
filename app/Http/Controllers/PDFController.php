<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Balita;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function generatePDF($request)
    {
        $carbon = Carbon::setLocale('id');
        // dd($request);
        if (count($request) > 0) {
            $doc = $request;
        } else {
            $doc =  [
                'nik' => '282928928928',
                'nama_balita' => 'Andi',
                'tempat_lahir' => 'Makassar',
                'tgl_lahir' => Carbon::parse('20-02-2024')->translatedFormat('j F Y'),
                'alamat' => 'Jl. Sungai Bakti, Lorong 11',
                'nama_orang_tua' => 'Sukarji',
                'alamat_orang_tua' => 'Jl. Selamat Pulang',
                'no_telpon_orang_tua' => '019209200300',
                'jenis_imunisasi' => [
                    'true',
                    'true',
                    'true',
                    'true',
                    'true',
                    'false',
                    'false',
                    'false',
                    'false',
                    'false',
                    'false',
                    'false',
                ],
            ];
        }

        $data = [
            'title' => 'Sertifikat Imunisasi',
            'nomor' => $request['nomor'],
            'namaImunisasi' => [
                'Vitamin A - 1',
                'Vitamin A - 2',
                'Oralit',
                'BH (NOL)',
                'BCG',
                'POLIO - 1',
                'POLIO - 2',
                'POLIO - 3',
                'DPT/HB - 1',
                'DPT/HB - 2',
                'DPT/HB - 3',
                'Campak',
            ],
            'data' => $doc,

        ];
        // dd($data);
        $namaPDF = 'sertifikat/'. md5($data['nomor']) . '.pdf';
        $pdf = PDF::loadView('pdf.document', $data);

        Storage::put('public/' . $namaPDF, $pdf->download()->getOriginalContent());
        return $namaPDF;
    }
}
