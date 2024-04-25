<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Puskesmas;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePuskesmasRequest;
use App\Http\Requests\UpdatePuskesmasRequest;

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
        return Inertia::render('SettingPuskesmas/index', ['puskesmas' => $puskesmass]);
    }

    /**
     * Tampilan form pembuatan Puskesmas baru
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('SettingPuskesmas/Update', [
            'puskesmas' => Puskesmas::find(1),
        ]);
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

        // Foto Profile
        if ($request->file('foto_profile') != null) {
            $this->destroyFotoProfile();
            $nama_foto_profile = $request->file('foto_profile')->getClientOriginalName();
            $ext_foto_profile = $request->file('foto_profile')->getClientOriginalExtension();
            $file_foto_profile = 'puskesmas/' . md5($nama_foto_profile) . '.' . $ext_foto_profile;
            $request->file('foto_profile')->storeAs('public/', $file_foto_profile);
        } else {
            $file_foto_profile = null;
        }

        // Logo
        if ($request->file('logo') != null) {
            $this->destroyFotoProfile();
            $nama_logo = $request->file('logo')->getClientOriginalName();
            $ext_logo = $request->file('logo')->getClientOriginalExtension();
            $file_logo = 'puskesmas/' . md5($nama_logo) . '.' . $ext_logo;
            $request->file('logo')->storeAs('public/', $file_logo);
        } else {
            $file_logo = null;
        }


        $validatedData['foto_profile'] = $file_foto_profile;
        $validatedData['logo'] = $file_logo;

        $puskesmass = Puskesmas::find(1);
        if ($puskesmass == null) {
            Puskesmas::create($validatedData);
        }else{
            $puskesmass->update($validatedData);
        }

        return redirect()->route('SettingPuskesmas.create')->with('message', 'Puskesmas baru berhasil Di Update!');
    }

    public function destroyFotoProfile()
    {
        $puskesmass = Puskesmas::find(1);
        if ($puskesmass !== null && $puskesmass->foto_profile !== null) {
            $name = $puskesmass->foto_profile;
            if (Storage::disk('public')->exists($name)) {
                Storage::disk('public')->delete($name);
            }
        }
    }
    public function destroyLogo()
    {
        $puskesmass = Puskesmas::find(1);
        if ($puskesmass !== null && $puskesmass->logo !== null) {
            $name = $puskesmass->logo;
            if (Storage::disk('public')->exists($name)) {
                Storage::disk('public')->delete($name);
            }
        }
    }
}
