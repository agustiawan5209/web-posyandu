<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Sertifikat Imunisasi',
            'nomor' => 'PBU-XI-II-2024-01',
            'data' => [
                'nama_anak' => 'Andi',
                'tempat_lahir' => 'Makassar',
                'tgl_lahir' => '20-02-2024',
                'alamat' => 'Jl. Sungai Bakti, Lorong 11',
                'nama_orang_tua' => 'Ahmad Sukarji',
            ],
        ];
        $pdf = PDF::loadView('pdf.document', $data);
        return $pdf->stream('document.pdf');
    }
}
