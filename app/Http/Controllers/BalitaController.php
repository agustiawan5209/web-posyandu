<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Http\Requests\StoreBalitaRequest;
use App\Http\Requests\UpdateBalitaRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Balita/Index", [
            'balita' => Balita::where('org_tua_id', '=', Request::input('orang_tua'))->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Balita/create", [
            'balita' => Balita::where('org_tua_id', '=', Request::input('orang_tua'))->get(),
        ]);
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
            'balita' => Balita::find(Request::input('orang_tua')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Balita $balita)
    {
        return Inertia::render("Balita/Edit", [
            'balita' => Balita::find(Request::input('orang_tua')),
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
