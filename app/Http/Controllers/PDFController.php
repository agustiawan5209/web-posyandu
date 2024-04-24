<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $carbon = Carbon::setLocale('id');
        if ($request->nik != null) {
            $doc = [
                'nik' => $request->nik,
                'nama_anak' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => Carbon::parse($request->tgl_lahir)->translatedFormat('j F Y'),
                'nama_orang_tua' => $request->nama_orang_tua,
                'alamat_orang_tua' => $request->alamat_orang_tua,
                'no_telpon_orang_tua' => $request->no_telpon_orang_tua,
                'jenis_imunisasi' => [
                    'Vitamin A - 1' => 'false',
                    'Vitamin A - 2' => 'false',
                    'Oralit' => 'false',
                    'BH (NOL)' => 'false',
                    'BCG' => 'false',
                    'POLIO - 1' => 'false',
                    'POLIO - 2' => 'false',
                    'POLIO - 3' => 'false',
                    'DPT/HB - 1' => 'false',
                    'DPT/HB - 2' => 'false',
                    'DPT/HB - 3' => 'false',
                    'Campak' => 'false',
                ],
            ];
        } else {
            $doc =  [
                'nik' => '282928928928',
                'nama_anak' => 'Andi',
                'tempat_lahir' => 'Makassar',
                'tgl_lahir' => Carbon::parse('20-02-2024')->translatedFormat('j F Y'),
                'alamat' => 'Jl. Sungai Bakti, Lorong 11',
                'nama_orang_tua' => 'Sukarji',
                'alamat_orang_tua' => 'Jl. Selamat Pulang',
                'no_telpon_orang_tua' => '019209200300',
                'jenis_imunisasi' => [
                    'Vitamin A - 1' => 'true',
                    'Vitamin A - 2' => 'true',
                    'Oralit' => 'true',
                    'BH (NOL)' => 'true',
                    'BCG' => 'true',
                    'POLIO - 1' => 'false',
                    'POLIO - 2' => 'false',
                    'POLIO - 3' => 'false',
                    'DPT/HB - 1' => 'false',
                    'DPT/HB - 2' => 'false',
                    'DPT/HB - 3' => 'false',
                    'Campak' => 'false',
                ],
            ];
        }
        $data = [
            'title' => 'Sertifikat Imunisasi',
            'nomor' => $request->nomor,
            'data' => $doc,
        ];
        $namaPDF = 'sertifikat/' . $data['nomor'] . '.pdf';
        $pdf = PDF::loadView('pdf.document', $data);

        // $filePATH = public_path() . '/storage/' . $namaPDF;
        // if (Storage::disk('public')->exists('PdfFile/PDFExport.pdf')) {
        //     Storage::disk('public')->delete('PdfFile/PDFExport.pdf');
        // }
        Storage::put('public/' . $namaPDF, $pdf->download()->getOriginalContent());
        return $namaPDF;
    }
}
