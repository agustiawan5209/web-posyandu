<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreBalitaRequest;
use App\Http\Requests\UpdateBalitaRequest;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'balitas'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        $columns[] = 'hitung_usia';
        $columns[] = 'nama_orang_tua';

        return Inertia::render('Balita/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'org_tua_id', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => Balita::filter(Request::only('search', 'order'))->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Balita/Form", [
            'balita' => Balita::where('org_tua_id', '=', Request::input('orang_tua'))->get(),
            'orangTua'=> OrangTua::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForm(StoreBalitaRequest $request)
    {
        Balita::create($request->all());
        return redirect()->route('Balita.index')->with('message', 'Data Balita Berhasil Di tambah!!');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBalitaRequest $request)
    {
        Balita::create($request->all());
        return redirect()->back()->with('message', 'Data Balita Berhasil Di tambah!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Balita $balita)
    {
        return Inertia::render("Balita/Show", [
            'balita' => Balita::with(['orangTua'])->find(Request::input('slug')),
            'orangTua'=> OrangTua::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Balita $balita)
    {
        // dd(Balita::find(Request::input('slug')));
        return Inertia::render("Balita/Edit", [
            'balita' => Balita::find(Request::input('slug')),
            'orangTua'=> OrangTua::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBalitaRequest $request, Balita $balita)
    {
        Balita::find(Request::input('slug'))->update($request->all());
        return redirect()->route('Balita.index')->with('message', 'Data Balita Berhasil Di Edit!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Balita $balita)
    {
        Balita::find(Request::input('slug'))->delete();
        return redirect()->route('Balita.index')->with('message', 'Data Balita Berhasil Di Hapus!!');
    }
}
