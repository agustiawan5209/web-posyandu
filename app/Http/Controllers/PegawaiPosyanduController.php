<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\PegawaiPosyandu;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StorePegawaiPosyanduRequest;
use App\Http\Requests\UpdatePegawaiPosyanduRequest;

class PegawaiPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'pegawai_posyandus'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd(OrangTua::with(['anak'])->find(1));

        return Inertia::render('Pegawai/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => PegawaiPosyandu::filter(Request::only('search', 'order'))->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $columns_pegawai = DB::getSchemaBuilder()->getColumnListing('pegawai_posyandus');
        $columns_user = DB::getSchemaBuilder()->getColumnListing('users');
        $columns_hide = ['remember_token', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'id', 'name'];
        $colums = array_diff(array_merge($columns_pegawai, $columns_user), $columns_hide);
        $colums['2'] =  [
            'name'=> 'jabatan',
            'value'=> Role::whereNot('name', 'Orang Tua')->get(),
        ];
        // dd($colums);
        return Inertia::render('Pegawai/Form', [
            'jabatan'=> Role::whereNot('name', 'Orang Tua')->get(),
            'colums'=> array_values($colums),
            'linkCreate'=> 'Pegawai.store',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiPosyanduRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $role = Role::findByName('Orang Tua');
        if ($role) {
            $user->assignRole($role); // Assign 'user' role to the user
        }

        PegawaiPosyandu::create([
            'user_id'=> $user->id,
            'nama'=> $user->name,
            'jabatan'=> $request->jabatan,
            'no_telpon'=> $request->no_telpon,
            'alamat'=> $request->alamat,
        ]);
        return redirect()->route('Pegawai.index')->with('message', 'Data Pegawai Posyandu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PegawaiPosyandu $pegawaiPosyandu)
    {
        return Inertia::render('Pegawai/Show', [
            'pegawai'=> $pegawaiPosyandu->find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PegawaiPosyandu $pegawaiPosyandu)
    {
        return Inertia::render('Pegawai/Edit', [
            'pegawai'=> $pegawaiPosyandu->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiPosyanduRequest $request, PegawaiPosyandu $pegawaiPosyandu)
    {
        $pegawaiPosyandu->find($request->slug)->update($request->all());
        return redirect()->route('Pegawai.index')->with('message', 'Data Pegawai Posyandu berhasil Di Edit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PegawaiPosyandu $pegawaiPosyandu)
    {
        $pegawaiPosyandu->find(Request::input('slug'))->delete();
        return redirect()->route('Pegawai.index')->with('message', 'Data Pegawai Posyandu berhasil Di Hapus!');
    }
}
