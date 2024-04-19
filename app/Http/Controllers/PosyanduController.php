<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Posyandu;
use App\Http\Requests\StorePosyanduRequest;
use App\Http\Requests\UpdatePosyanduRequest;
use Illuminate\Support\Facades\Request;

class PosyanduController extends Controller
{
    /**
     * Tampilan daftar Posyandu
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $posyandus = Posyandu::all();
        return Inertia::render('Posyandu/index', ['posyandu' => $posyandus]);
    }

    /**
     * Tampilan form pembuatan Posyandu baru
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Posyandu/create');
    }

    /**
     * Menyimpan data Posyandu baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePosyanduRequest $request)
    {
        $validatedData = $request->all();

        Posyandu::create($validatedData);

        return redirect()->route('Posyandus.index')->with('message', 'Posyandu baru berhasil ditambahkan!');
    }

    /**
     * Tampilan form edit Posyandu
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(Posyandu $posyandu)
    {
        return Inertia::render('Posyandu/edit', ['posyandu' => $posyandu]);
    }

    /**
     * Memperbarui data Posyandu
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePosyanduRequest $request, Posyandu $posyandu)
    {
        $validatedData = $request->all();

        $posyandu->find($request->slug)->update($validatedData);

        return redirect()->route('Posyandus.index')->with('message', 'Data Posyandu berhasil diperbarui!');
    }

    /**
     * Menghapus data Posyandu
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posyandu $posyandu,)
    {
        $posyandu->find(Request::input('slug'))->delete();

        return redirect()->route('Posyandus.index')->with('message', 'Data Posyandu berhasil dihapus!');
    }
}
