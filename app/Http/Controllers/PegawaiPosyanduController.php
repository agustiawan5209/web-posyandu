<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\PegawaiPosyandu;
use App\Http\Requests\StorePegawaiPosyanduRequest;
use App\Http\Requests\UpdatePegawaiPosyanduRequest;
use Illuminate\Support\Facades\Request;

class PegawaiPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawaiPosyandu = PegawaiPosyandu::all();
        return Inertia::render('PegawaiPosyandu/index', ['pegawaiPosyandu' => $pegawaiPosyandu]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('PegawaiPosyandu/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiPosyanduRequest $request)
    {
        PegawaiPosyandu::create($request->all());
        return redirect()->route('PegawaiPosyandu.index')->with('success', 'Data Pegawai Posyandu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PegawaiPosyandu $pegawaiPosyandu)
    {
        return Inertia::render('PegawaiPosyandu/Show', [
            'pegawai'=> $pegawaiPosyandu->find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PegawaiPosyandu $pegawaiPosyandu)
    {
        return Inertia::render('PegawaiPosyandu/Edit', [
            'pegawai'=> $pegawaiPosyandu->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiPosyanduRequest $request, PegawaiPosyandu $pegawaiPosyandu)
    {
        $pegawaiPosyandu->find($request->slug)->update($request->all());
        return redirect()->route('PegawaiPosyandu.index')->with('success', 'Data Pegawai Posyandu berhasil Di Edit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PegawaiPosyandu $pegawaiPosyandu)
    {
        $pegawaiPosyandu->find(Request::input('slug'))->delete();
        return redirect()->route('PegawaiPosyandu.index')->with('success', 'Data Pegawai Posyandu berhasil Di Hapus!');
    }
}
