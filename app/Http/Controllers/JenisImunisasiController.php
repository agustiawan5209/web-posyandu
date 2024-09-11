<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\JenisImunisasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreJenisImunisasiRequest;
use App\Http\Requests\UpdateJenisImunisasiRequest;

class JenisImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'jenis_imunisasis'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        return Inertia::render('JenisImunisasi/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'posyandus_id', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'deskripsi'])),
            'data' => JenisImunisasi::filter(Request::only('search', 'order'))
                ->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add sertifikat'),
                'edit' => Auth::user()->can('edit sertifikat'),
                'show' => Auth::user()->can('show sertifikat'),
                'delete' => Auth::user()->can('delete sertifikat'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('JenisImunisasi/Form', [
            'user' => User::role('Kader')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenisImunisasiRequest $request)
    {
        $data = $request->all();
        $jenisImunisasi = JenisImunisasi::create($data);
        return redirect()->route('JenisImunisasi.index')->with('message', 'data jadwal imunisasi berhasil di tambah!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisImunisasi $jenisImunisasi)
    {
        Request::validate([
            'slug' => 'required|exists:jadwal_imunisasis,id',
        ]);
        return Inertia::render('JenisImunisasi/Show', [
            'jadwal' => JenisImunisasi::find(Request::input('slug'))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisImunisasi $jenisImunisasi)
    {
        return response()->json($jenisImunisasi->find(Request::input('slug')), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisImunisasiRequest $request, JenisImunisasi $jenisImunisasi)
    {
        $jenisImunisasi = JenisImunisasi::find($request->id)->update($request->all());
        return redirect()->route('JenisImunisasi.index')->with('message', 'data jadwal imunisasi berhasil di Update!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisImunisasi $jenisImunisasi)
    {
        $jenisImunisasi = JenisImunisasi::find(Request::input('slug'))->delete();
        return redirect()->route('JenisImunisasi.index')->with('message', 'data jadwal imunisasi berhasil di Hapus!!!');
    }
}
