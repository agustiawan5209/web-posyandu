<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Puskesmas;
use App\Http\Requests\StorePuskesmasRequest;
use App\Http\Requests\UpdatePuskesmasRequest;
use Illuminate\Support\Facades\Request;

class SettingPuskesmasController extends Controller
{
    /**
     * Tampilan daftar Puskesmas
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $puskesmass = Puskesmas::all();
        return Inertia::render('Puskesmas/index', ['puskesmas' => $puskesmass]);
    }

    /**
     * Tampilan form pembuatan Puskesmas baru
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Puskesmas/create');
    }

    /**
     * Menyimpan data Puskesmas baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePuskesmasRequest $request)
    {
        $validatedData = $request->all();

        Puskesmas::create($validatedData);

        return redirect()->route('SettingPuskesmas.index')->with('message', 'Puskesmas baru berhasil ditambahkan!');
    }

    /**
     * Tampilan form edit Puskesmas
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(Puskesmas $puskesmas)
    {
        return Inertia::render('Puskesmas/edit', ['puskesmas' => $puskesmas]);
    }

    /**
     * Memperbarui data Puskesmas
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePuskesmasRequest $request, Puskesmas $puskesmas)
    {
        $validatedData = $request->all();

        $puskesmas->find($request->slug)->update($validatedData);

        return redirect()->route('SettingPuskesmas.index')->with('message', 'Data Puskesmas berhasil diperbarui!');
    }

    /**
     * Menghapus data Puskesmas
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puskesmas $puskesmas,)
    {
        $puskesmas->find(Request::input('slug'))->delete();

        return redirect()->route('SettingPuskesmas.index')->with('message', 'Data Puskesmas berhasil dihapus!');
    }
}
