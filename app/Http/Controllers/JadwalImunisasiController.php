<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\JadwalImunisasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreJadwalImunisasiRequest;
use App\Http\Requests\UpdateJadwalImunisasiRequest;
use App\Models\Posyandu;
use PDF;

class JadwalImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'jadwal_imunisasis'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        // $columns[] = 'jumlah_anak';
        return Inertia::render('Jadwal/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'posyandus_id', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'deskripsi'])),
            'data' => JadwalImunisasi::filter(Request::only('search', 'order'))
                ->when(Auth::user()->hasRole('Kader') ?? null, function ($query) {
                    $query->where('posyandus_id', Auth::user()->staff->posyandus_id);
                })
                ->when(Auth::user()->hasRole('Orang Tua') ?? null, function ($query) {
                    $query->where('posyandus_id', Auth::user()->orangTua->posyandus_id);
                })
                ->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add riwayat'),
                'edit' => Auth::user()->can('edit riwayat'),
                'show' => Auth::user()->can('show riwayat'),
                'delete' => Auth::user()->can('delete riwayat'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Jadwal/Form', [
            'user' => User::role('Kader')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJadwalImunisasiRequest $request)
    {
        $data = $request->all();
        $data['posyandus_id'] = Auth::user()->staff->posyandus_id;
        $jadwalImunisasi = JadwalImunisasi::create($data);
        return redirect()->route('Jadwal.index')->with('message', 'data jadwal imunisasi berhasil di tambah!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalImunisasi $jadwalImunisasi)
    {
        Request::validate([
            'slug' => 'required|exists:jadwal_imunisasis,id',
        ]);
        return Inertia::render('Jadwal/Show', [
            'jadwal' => JadwalImunisasi::find(Request::input('slug'))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalImunisasi $jadwalImunisasi)
    {
        Request::validate([
            'slug' => 'required|exists:jadwal_imunisasis,id',
        ]);
        return Inertia::render('Jadwal/Edit', [
            'user' => User::role('Kader')->get(),
            'jadwal' => JadwalImunisasi::find(Request::input('slug'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalImunisasiRequest $request, JadwalImunisasi $jadwalImunisasi)
    {
        $jadwalImunisasi = JadwalImunisasi::find($request->slug)->update($request->all());
        return redirect()->route('Jadwal.index')->with('message', 'data jadwal imunisasi berhasil di Update!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalImunisasi $jadwalImunisasi)
    {
        $jadwalImunisasi = JadwalImunisasi::find(Request::input('slug'))->delete();
        return redirect()->route('Jadwal.index')->with('message', 'data jadwal imunisasi berhasil di Hapus!!!');
    }


    public function cetak($id){
        $data = JadwalImunisasi::find($id);
        // dd($data);
        $posyandu = Posyandu::find(Auth::user()->staff->posyandus_id);
        $title = 'Jadwal Imunisasi '. $data->tanggal;
        $pdf = PDF::loadView('pdf.jadwal', compact('data', 'posyandu', 'title'));
        // Unduh PDF
        return $pdf->stream('laporan.pdf');
    }
}
