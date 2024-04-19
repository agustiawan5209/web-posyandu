<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrangTuaRequest;
use App\Http\Requests\UpdateOrangTuaRequest;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrangTuaController extends Controller
{
    /**
     * Tampilan daftar orang tua
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $orangTuas = OrangTua::all();
        return Inertia::render('orang_tua/index', ['orangTuas' => $orangTuas]);
    }

    /**
     * Tampilan form pembuatan orang tua baru
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('orang_tua/create');
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

        return redirect()->route('orang_tua.index')->with('success', 'Data orang tua baru berhasil ditambahkan!');
    }

    /**
     * Tampilan form edit orang tua
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(OrangTua $orangTua)
    {
        return Inertia::render('orang_tua/edit', ['orangTua' => $orangTua]);
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

        $orangTua->update($validatedData);

        return redirect()->route('orang_tua.index')->with('success', 'Data orang tua berhasil diperbarui!');
    }

    /**
     * Menghapus data orang tua
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrangTua $orangTua)
    {
        $orangTua->delete();

        return redirect()->route('orang_tua.index')->with('success', 'Data orang tua berhasil dihapus!');
    }
}
