<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreSertifikatRequest;
use App\Http\Requests\UpdateSertifikatRequest;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'sertifikats'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd(OrangTua::with(['balita'])->find(1));

        return Inertia::render('Sertifikat/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id','balita_id'])),
            'data' => Sertifikat::filter(Request::only('search', 'order'))->with(['balita'])->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add sertifikat'),
                'edit' => Auth::user()->can('edit sertifikat'),
                'show' => Auth::user()->can('show sertifikat'),
                'delete' => Auth::user()->can('delete sertifikat'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Sertifikat/Form',[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSertifikatRequest $request)
    {
        $sertifikat = Sertifikat::create($request->all());
        return redirect()->route('Sertifikat.index')->with('message','Data Sertifikat Berhasil Di Tambah!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sertifikat $sertifikat)
    {
        return Inertia::render('Sertifikat/Show',[
            'sertfikat'=> $sertifikat->find(Request::input('slug')),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sertifikat $sertifikat)
    {
        return Inertia::render('Sertifikat/Edit',[
            'sertfikat'=> $sertifikat->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSertifikatRequest $request, Sertifikat $sertifikat)
    {

        $sertifikat = Sertifikat::find($request->slug)->update($request->all());
        return redirect()->route('Sertifikat.index')->with('message','Data Sertifikat Berhasil Di Edit!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sertifikat $sertifikat)
    {
        $sertifikat = Sertifikat::find(Request::input('slug'))->delete();
        return redirect()->route('Sertifikat.index')->with('message','Data Sertifikat Berhasil Di Hapus!!');
    }
}
