<?php

namespace App\Http\Controllers;

use PDF;
use Inertia\Inertia;
use App\Models\Penyewaan;
use App\Models\Posyandu;
use App\Models\RiwayatImunisasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LaporanController extends Controller
{

    public function index(Request $request)
    {
        $tableName = 'riwayat_imunisasis'; // Ganti dengan nama tabel yang Anda inginkan
        // $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        $columns[] = 'id';
        $columns[] = 'nama_anak';
        $columns[] = 'tanggal';
        $columns[] = 'jenis_imunisasi';
        $columns[] = 'catatan';

        $riwayatImunisasi = RiwayatImunisasi::with(['balita'])
            ->whereBetween('created_at', [Request::input('start_date'), Request::input('end_date')])
            ->where('posyandus_id', Request::input('posyandus_id'))
            ->paginate(10);
        return Inertia::render('Laporan/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'balita_id', 'created_at', 'updated_at', 'user_id'])),
            'data' => $riwayatImunisasi,
            'posyandu'=> Posyandu::all(),
            'can' => [
                'add' => false,
                'edit' => false,
                'show' => false,
                'delete' => false,
            ],
            'tipe' => 'jasa',
            'datelaporan' => Request::only('start_date', 'end_date', 'posyandus_id'),
        ]);
    }

    public function cetakPDF()
    {
        // Ambil data penyewaan berdasarkan id
        $data = RiwayatImunisasi::filter(Request::only('search', 'order'))
            ->with(['balita'])
            ->whereBetween('created_at', Request::only('start_date', 'end_date'))
            ->where('posyandus_id', Request::input('posyandus_id'))
            ->get();

        $posyandu = Posyandu::find(Request::input('posyandus_id'));
        // Definisikan kolom yang akan ditampilkan di PDF
        $columns = [
            'kode_transaksi',
            'customer_id',
            'jenis',
            'produk',
            'tgl_pengambilan',
            'tgl_pengembalian',
            'status'
        ];

        // Load view untuk PDF dan pass data riwayat
        $pdf = PDF::loadView('pdf.riwayat', compact('data', 'posyandu'));

        // Unduh PDF
        return $pdf->stream('riwayat.pdf');
    }
}
