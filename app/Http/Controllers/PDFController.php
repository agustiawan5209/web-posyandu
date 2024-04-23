<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $carbon = Carbon::setLocale('id');
        $balita = Balita::with(['orangTua', 'riwayatImunisasis'])->find($request->id);
        if ($balita != null) {
            $doc = [
                'nama_anak' => $balita->nama,
                'tempat_lahir' => $balita->tempat_lahir,
                'tgl_lahir' => Carbon::parse($balita->tgl_lahir)->translatedFormat('j F Y'),
                'alamat' => $balita->orangTua->alamat,
                'nama_orang_tua' => $balita->orangTua->nama,
            ];
        } else {
            $doc =  [
                'nama_anak' => 'Andi',
                'tempat_lahir' => 'Makassar',
                'tgl_lahir' => Carbon::parse('20-02-2024')->translatedFormat('j F Y'),
                'alamat' => 'Jl. Sungai Bakti, Lorong 11',
                'nama_orang_tua' => 'Ahmad Sukarji',
            ];
        }
        $data = [
            'title' => 'Sertifikat Imunisasi',
            'nomor' => 'PBU-XI-II-2024-'. date('i'),
            'data' => $doc,
        ];
        $pdf = PDF::loadView('pdf.document', $data);
        return $pdf->download('document.pdf');
    }
}
