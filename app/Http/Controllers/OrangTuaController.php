<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\OrangTua;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreOrangTuaRequest;
use App\Http\Requests\UpdateOrangTuaRequest;

class OrangTuaController extends Controller
{
    /**
     * Tampilan daftar orang tua
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $tableName = 'orang_tuas'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        $columns[] = 'jumlah_anak';

        // dd(OrangTua::with(['anak'])->find(1));

        return Inertia::render('OrangTua/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => OrangTua::filter(Request::only('search', 'order'))->with(['anak'])->paginate(10),
        ]);
    }

    /**
     * Tampilan form pembuatan orang tua baru
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('OrangTua/create');
    }

    /**
     * Menyimpan data orang tua baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrangTuaRequest $request)
    {
        $validatedData = $request->all();

        OrangTua::create($validatedData);

        return redirect()->route('OrangTua.index')->with('message', 'Data orang tua baru berhasil ditambahkan!');
    }

    /**
     * Tampilan Show orang tua
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show(OrangTua $orangTua)
    {
        return Inertia::render('OrangTua/Show', ['orangTua' => $orangTua->find(Request::input('slug'))]);
    }
    /**
     * Tampilan form edit orang tua
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(OrangTua $orangTua)
    {
        return Inertia::render('OrangTua/edit', ['orangTua' => $orangTua->find(Request::input('slug'))]);
    }

    /**
     * Memperbarui data orang tua
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrangTuaRequest $request, OrangTua $orangTua)
    {
        $validatedData = $request->all();

        $orangTua->find(Request::input('slug'))->update($validatedData);

        return redirect()->route('OrangTua.index')->with('message', 'Data orang tua berhasil diperbarui!');
    }

    /**
     * Menghapus data orang tua
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrangTua $orangTua)
    {
        $orangTua->find(Request::input('slug'))->delete();

        return redirect()->route('OrangTua.index')->with('message', 'Data orang tua berhasil dihapus!');
    }
}
