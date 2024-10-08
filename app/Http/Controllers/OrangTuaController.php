<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
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

        // dd(OrangTua::with(['balita'])->find(1));

        return Inertia::render('OrangTua/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'posyandus_id', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => OrangTua::filter(Request::only('search', 'order'))->with(['balita', 'user'])
                ->when(Auth::user()->hasRole('Kader') ?? null, function ($query) {
                    $query->where('posyandus_id', Auth::user()->staff->posyandus_id);
                })
                ->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add orangtua'),
                'edit' => Auth::user()->can('edit orangtua'),
                'show' => Auth::user()->can('show orangtua'),
                'delete' => Auth::user()->can('delete orangtua'),
            ]
        ]);
    }

    /**
     * Tampilan form pembuatan orang tua baru
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('OrangTua/Form', [
            'can' => [
                'add' => Auth::user()->can('add balita'),
            ]
        ]);
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
            $user->givePermissionTo([
                'show riwayat',
                'add balita',
                'edit balita',
                'delete balita',
                'show balita',
                'show jadwal',
                'show sertifikat',
                'cetak sertifikat',
            ]);
        }


        event(new Registered($user));

        OrangTua::create([
            'posyandus_id' => Auth::user()->staff->posyandus_id,
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
        Request::validate([
            'slug' => 'required|exists:orang_tuas,id',
        ]);
        return Inertia::render('OrangTua/Show', [
            'orangTua' => $orangTua->with(['balita', 'user'])->find(Request::input('slug')),
            'can' => [
                'add' => Auth::user()->can('add balita'),
            ]
        ]);
    }
    /**
     * Tampilan form edit orang tua
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit(OrangTua $orangTua)
    {
        Request::validate([
            'slug' => 'required|exists:orang_tuas,id',
        ]);
        return Inertia::render('OrangTua/Edit', ['orangTua' => $orangTua->with(['balita', 'user'])->find(Request::input('slug'))]);
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
            'posyandus_id' => Auth::user()->staff->posyandus_id,
            'nama' => $request->name,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
        ]);


        return redirect()->route('OrangTua.index')->with('message', 'Data ' . $request->name . ' berhasil diperbarui!');
    }

    /**
     * Menghapus data orang tua
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrangTua $orangTua)
    {
        $orangTua = OrangTua::with(['balita'])->find(Request::input('slug'));
        $data = $orangTua->nama;
        $user = $orangTua->user->id;
        if ($orangTua->balita->count() > 0) {
            $data = 'Data Dihapus Dengan ' . $orangTua->balita->count() . ' Data Balita';
        }
        User::find($user)->delete();
        // $orangTua->delete();

        return redirect()->route('OrangTua.index')->with('message', 'Data orang tua berhasil dihapus!. ' . $data);
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
        return redirect()->route('OrangTua.index')->with('message', 'Password OrangTua Posyandu berhasil Di Ubah!.');
    }
}
