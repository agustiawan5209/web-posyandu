<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\RiwayatImunisasi;
use Illuminate\Support\Facades\DB;
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
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        return Inertia::render('Riwayat/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => RiwayatImunisasi::filter(Request::only('search', 'order'))->with(['balita'])->paginate(10),
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
        $data = $request->all();
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
        $data = $request->all();
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
