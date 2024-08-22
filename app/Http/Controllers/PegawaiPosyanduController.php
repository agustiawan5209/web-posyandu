<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\PegawaiPosyandu;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StorePegawaiPosyanduRequest;
use App\Http\Requests\UpdatePegawaiPosyanduRequest;
use App\Models\Posyandu;

class PegawaiPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'pegawai_posyandus'; // Ganti dengan nama tabel yang Anda inginkan
        // dd(PegawaiPosyandu::with(['posyandus']));
        $columns[] = 'nama_posyandu';
        $columns = array_merge($columns, DB::getSchemaBuilder()->getColumnListing($tableName));
        array_splice($columns, 0, 2, array("id", "nama_posyandu"));
        // dd($columns);
        return Inertia::render('Pegawai/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['posyandus_id', 'remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => PegawaiPosyandu::filter(Request::only('search', 'order'))->with(['user', 'posyandus'])
                ->when(Auth::user()->hasRole('Kader') ?? null, function ($query) {
                    $query->where('posyandus_id', Auth::user()->staff->posyandus_id);
                })
                ->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add staff'),
                'edit' => Auth::user()->can('edit staff'),
                'show' => Auth::user()->can('show staff'),
                'delete' => Auth::user()->can('delete staff'),
                'reset' => Auth::user()->can('reset staff'),
            ]
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
            'name' => 'jabatan',
            'value' => Role::whereNot('name', 'Orang Tua')->get(),
        ];
        // dd($colums);
        return Inertia::render('Pegawai/Form', [
            'jabatan' => Role::whereNot('name', 'Orang Tua')->get(),
            'colums' => array_values($colums),
            'linkCreate' => 'Pegawai.store',
            'posyandus' => Posyandu::all(),

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
            'remember_token' => Str::random(60),
        ]);
        $user->syncRoles([]);

        // Remove all permissions
        $user->syncPermissions([]);
        $role = Role::findByName($request->jabatan);

        if ($role) {
            $user->assignRole($role); // Assign 'user' role to the user
            if ($role->name == 'Kader') {
                $user->givePermissionTo([
                    'add riwayat',
                    'edit riwayat',
                    'delete riwayat',
                    'show riwayat',
                    // Balita
                    'add balita',
                    'edit balita',
                    'delete balita',
                    'show balita',
                    // orang tua
                    'add orangtua',
                    'edit orangtua',
                    'delete orangtua',
                    'show orangtua',
                    // jadwal
                    'add jadwal',
                    'edit jadwal',
                    'delete jadwal',
                    'show jadwal',
                    // Sertifikat
                    'show sertifikat',

                    'show staff',
                    'reset orangtua'
                ]);
            } else {
                $user->givePermissionTo([
                    // 'add riwayat',
                    // 'edit riwayat',
                    // 'delete riwayat',
                    'show riwayat',
                    // Balita
                    // 'add balita',
                    // 'edit balita',
                    // 'delete balita',
                    'show balita',
                    // orang tua
                    // 'add orangtua',
                    // 'edit orangtua',
                    // 'delete orangtua',
                    'show orangtua',
                    // jadwal
                    // 'add jadwal',
                    // 'edit jadwal',
                    // 'delete jadwal',
                    'show jadwal',
                    // staff
                    'add staff',
                    'edit staff',
                    // 'delete staff',
                    'show staff',
                    // 'reset staff',
                    // Sertifikat
                    // 'add sertifikat',
                    // 'edit sertifikat',
                    // 'delete sertifikat',
                    'show sertifikat',
                ]);
            }
        }


        event(new Registered($user));

        PegawaiPosyandu::create([
            'user_id' => $user->id,
            'posyandus_id' => $request->posyandus_id,
            'nama' => $user->name,
            'jabatan' => $request->jabatan,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('Pegawai.index')->with('message', 'Data Pegawai Posyandu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PegawaiPosyandu $pegawaiPosyandu)
    {
        Request::validate([
            'slug' => 'required|exists:pegawai_posyandus,id',
        ]);
        return Inertia::render('Pegawai/Show', [
            'pegawai' => $pegawaiPosyandu->find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PegawaiPosyandu $pegawaiPosyandu)
    {
        Request::validate([
            'slug' => 'required|exists:pegawai_posyandus,id',
        ]);
        return Inertia::render('Pegawai/Edit', [
            'pegawai' => $pegawaiPosyandu->with(['user'])->find(Request::input('slug')),
            'jabatan' => Role::whereNot('name', 'Orang Tua')->get(),
            'posyandus' => Posyandu::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiPosyanduRequest $request, PegawaiPosyandu $pegawaiPosyandu)
    {

        $pegawai = PegawaiPosyandu::find(Request::input('slug'));

        $user = User::find($pegawai->user_id);
        $user->update([
            'name' => $request->name,
            // 'username' => $request->username,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password),
            // 'remember_token' => Str::random(60),

        ]);
        // Remove a role
        $user->syncRoles([]);

        // Remove all permissions
        $user->syncPermissions([]);

        $pegawai->update([
            'posyandus_id' => $request->posyandus_id,
            'nama' => $request->name,
            'jabatan' => $request->jabatan,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
        ]);

        $role = Role::findByName($request->jabatan);
        if ($role) {
            $user->assignRole($role); // Assign 'user' role to the user
            if ($role->name == 'Kader') {
                $user->givePermissionTo([
                    'add riwayat',
                    'edit riwayat',
                    'delete riwayat',
                    'show riwayat',
                    // Balita
                    'add balita',
                    'edit balita',
                    'delete balita',
                    'show balita',
                    // orang tua
                    'add orangtua',
                    'edit orangtua',
                    'delete orangtua',
                    'show orangtua',
                    // jadwal
                    'add jadwal',
                    'edit jadwal',
                    'delete jadwal',
                    'show jadwal',
                    // Sertifikat
                    'show sertifikat',

                    'show staff',
                    'reset orangtua'
                ]);
            } else {
                $user->givePermissionTo([
                    // 'add riwayat',
                    // 'edit riwayat',
                    // 'delete riwayat',
                    'show riwayat',
                    // Balita
                    // 'add balita',
                    // 'edit balita',
                    // 'delete balita',
                    'show balita',
                    // orang tua
                    // 'add orangtua',
                    // 'edit orangtua',
                    // 'delete orangtua',
                    'show orangtua',
                    // jadwal
                    // 'add jadwal',
                    // 'edit jadwal',
                    // 'delete jadwal',
                    'show jadwal',
                    // staff
                    'add staff',
                    'edit staff',
                    // 'delete staff',
                    'show staff',
                    // 'reset staff',
                    // Sertifikat
                    // 'add sertifikat',
                    // 'edit sertifikat',
                    // 'delete sertifikat',
                    'show sertifikat',
                ]);
            }
        }

        return redirect()->route('Pegawai.index')->with('message', 'Data Pegawai Posyandu berhasil Di Edit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PegawaiPosyandu $pegawaiPosyandu)
    {
        $pegawaiPosyandu = PegawaiPosyandu::with(['user'])->find(Request::input('slug'));
        $user_id = $pegawaiPosyandu->user->id;
        User::find($user_id)->delete();
        return redirect()->route('Pegawai.index')->with('message', 'Data Pegawai Posyandu berhasil Di Hapus!');
    }



    /**
     * Display the specified resource.
     */
    public function resetpassword(PegawaiPosyandu $pegawaiPosyandu)
    {

        return Inertia::render('Pegawai/UpdatePassword', [
            'user' => User::find(Request::input('slug')),
        ]);
    }
    public function resetpasswordUpdate(PegawaiPosyandu $pegawaiPosyandu)
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
        return redirect()->route('Pegawai.index')->with('message', 'Password Pegawai Posyandu berhasil Di Ubah!');
    }
}
