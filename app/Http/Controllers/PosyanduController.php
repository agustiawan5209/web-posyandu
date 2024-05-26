<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Posyandu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StorePosyanduRequest;
use App\Http\Requests\UpdatePosyanduRequest;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'pegawai_posyandus'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd(OrangTua::with(['anak'])->find(1));

        return Inertia::render('Posyandus/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => Posyandu::filter(Request::only('search', 'order'))->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add staff'),
                'edit' => Auth::user()->can('edit staff'),
                'show' => Auth::user()->can('show staff'),
                'delete' => Auth::user()->can('delete staff'),
                'reset' => Auth::user()->can('reset staff'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posyandus/Form', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePosyanduRequest $request)
    {
        $posyandu = Posyandu::create($request->all());

        return redirect()->route('Posyandus.index')->with('messages', 'Data Berhasil Di Tambah!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Posyandu $posyandu)
    {
        return Inertia::render('Posyandus/Form', [
            'posyandus'=> $posyandu->find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posyandu $posyandu)
    {
        return Inertia::render('Posyandus/Form', [
            'posyandus'=> $posyandu->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePosyanduRequest $request, Posyandu $posyandu)
    {
        $posyandu = Posyandu::find($request->slug)->update($request->all());

        return redirect()->route('Posyandus.index')->with('messages', 'Data Berhasil Di ubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posyandu $posyandu)
    {
        $posyandu = Posyandu::find(Request::input('slug'))->delete();

        return redirect()->route('Posyandus.index')->with('messages', 'Data Berhasil Di Hapus!!');
    }
}
