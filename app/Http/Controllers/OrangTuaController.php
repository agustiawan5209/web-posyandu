<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\OrangTua;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
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
        return Inertia::render('OrangTua/Form');
    }

    /**
     * Menyimpan data orang tua baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrangTuaRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);
        $role = Role::findByName('Orang Tua');
        if ($role) {
            $user->assignRole($role); // Assign 'user' role to the user
        }

        event(new Registered($user));

        OrangTua::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
        ]);

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
        return Inertia::render('OrangTua/Show', ['orangTua' => $orangTua->with(['anak', 'user'])->find(Request::input('slug'))]);
    }
    /**
     * Tampilan form edit orang tua
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(OrangTua $orangTua)
    {
        return Inertia::render('OrangTua/Edit', ['orangTua' => $orangTua->with(['anak', 'user'])->find(Request::input('slug'))]);
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
        $orangTua = OrangTua::find(Request::input('slug'));



        $user = User::find($orangTua->user_id);
        $user->update([
            'name' => $request->name,

        ]);
        $orangTua->update([
            'nama' => $request->name,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
        ]);


        return redirect()->route('OrangTua.index')->with('message', 'Data '. $request->name .' berhasil diperbarui!');
    }

    /**
     * Menghapus data orang tua
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrangTua $orangTua)
    {
        $orangTua = OrangTua::with('anak')->find(Request::input('slug'));
        $data = $orangTua->nama;

        if($orangTua->anak->count() > 0){
            $data = 'Data Dihapus Dengan '. $orangTua->anak->count() .' Data Balita';
        }
        $orangTua->delete();

        return redirect()->route('OrangTua.index')->with('message', 'Data orang tua berhasil dihapus!. '. $data);
    }




   /**
     * Display the specified resource.
     */
    public function resetpassword(OrangTua $orangTua)
    {

        return Inertia::render('OrangTua/UpdatePassword', [
            'user' => User::find(Request::input('slug')),
        ]);
    }
    public function resetpasswordUpdate(OrangTua $orangTua)
    {

        Request::validate([
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);
        $user = User::find(Request::input('slug'));
        $user->update([
            'remember_token' => Str::random(60),
            'password' => Hash::make(Request::input('password')),
        ]);
        return redirect()->route('OrangTua.index')->with('message', 'Password OrangTua Posyandu berhasil Di Ubah!.' );

    }
}
