<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\RiwayatImunisasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreRiwayatImunisasiRequest;
use App\Http\Requests\UpdateRiwayatImunisasiRequest;

class RiwayatImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'riwayat_imunisasis'; // Ganti dengan nama tabel yang Anda inginkan
        // $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        $columns[] = 'id';
        $columns[] = 'nama_anak';
        $columns[] = 'tanggal';
        $columns[] = 'catatan';
        // dd(RiwayatImunisasi::filter(Request::only('search', 'order'))->with(['balita'])->get());
        return Inertia::render('Riwayat/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at','balita_id', 'created_at', 'updated_at', 'user_id'])),
            'data' => RiwayatImunisasi::filter(Request::only('search', 'order'))->with(['balita'])->paginate(10),
            'can'=>[
                'add'=> Auth::user()->can('add riwayat'),
                'edit'=> Auth::user()->can('edit riwayat'),
                'show'=> Auth::user()->can('show riwayat'),
                'delete'=> Auth::user()->can('delete riwayat'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Riwayat/Form', []);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiwayatImunisasiRequest $request)
    {
        $data = [
            'balita_id'=> $request->balita_id,
            'data_imunisasi'=>[
                'berat_badan'=> $request->berat_badan,
                'tinggi_badan'=> $request->tinggi_badan,
                'lingkar_kepala'=> $request->lingkar_kepala,
                'kesehatan'=> $request->kesehatan,
                'nama_orang_tua'=> $request->nama_orang_tua,
                'nama_anak'=> $request->nama_anak,
                'usia_anak'=> $request->usia,
                'jenis_kelamin'=> $request->jenis_kelamin,
            ],
            'jenis_imunisasi'=> $request->jenis_imunisasi,
            'tanggal'=> $request->tanggal,
            'catatan'=> $request->catatan,

        ];

        $riwayatImunisasi = RiwayatImunisasi::create($data);

        return redirect()->route('Riwayat.index')->with('message','Data Riwayat Imunisasi Bayi/Balita Berhasil Di Tambah!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatImunisasi $riwayatImunisasi)
    {
        return Inertia::render('Riwayat/Show', [
            'riwayat'=> $riwayatImunisasi->find(Request::input('slug')),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatImunisasi $riwayatImunisasi)
    {
        return Inertia::render('Riwayat/Edit', [
            'riwayat'=> $riwayatImunisasi->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiwayatImunisasiRequest $request, RiwayatImunisasi $riwayatImunisasi)
    {
        $data = [
            'balita_id'=> $request->balita_id,
            'data_imunisasi'=>[
                'berat_badan'=> $request->berat_badan,
                'tinggi_badan'=> $request->tinggi_badan,
                'lingkar_kepala'=> $request->lingkar_kepala,
                'kesehatan'=> $request->kesehatan,
                'nama_orang_tua'=> $request->nama_orang_tua,
                'nama_anak'=> $request->nama_anak,
                'usia_anak'=> $request->usia,
                'jenis_kelamin'=> $request->jenis_kelamin,
            ],
            'jenis_imunisasi'=> $request->jenis_imunisasi,
            'tanggal'=> $request->tanggal,
            'catatan'=> $request->catatan,

        ];

        $riwayatImunisasi = $riwayatImunisasi->find(Request::input('slug'))->update($data);
        return redirect()->route('Riwayat.index')->with('message','Data Riwayat Imunisasi Bayi/Balita Berhasil Di Edit!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatImunisasi $riwayatImunisasi)
    {
        $riwayatImunisasi = $riwayatImunisasi->find(Request::input('slug'))->delete();
        return redirect()->route('Riwayat.index')->with('message','Data Riwayat Imunisasi Bayi/Balita Berhasil Di Hapus!!');
    }
}
