<?php

namespace App\Http\Controllers;

use PDF;
use Inertia\Inertia;
use App\Models\Balita;
use App\Models\Posyandu;
use App\Models\LaporanImunisasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreLaporanImunisasiRequest;
use App\Http\Requests\UpdateLaporanImunisasiRequest;

class LaporanImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("LaporanImunisasi/Index", [
            'balita' => Balita::filter(Request::only('search'))
                ->with(['orangTua', 'riwayatImunisasis'])
                ->when(Auth::user()->hasRole('Kader') ?? null, function ($query) {
                    $query->whereHas('orangTua', function ($query) {
                        $query->where('posyandus_id', Auth::user()->staff->posyandus_id);
                    });
                })
                ->when(Request::input('posyandus_id'), function ($query) {
                    $query->whereHas('orangTua', function ($query) {
                        $query->where('posyandus_id', Request::input('posyandus_id'));
                    });

                })
                ->orderBy('nama', 'asc')
                ->paginate(10),
            'datelaporan' => Request::only('posyandus_id'),
            'posyandu' => Posyandu::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('LaporanImunisasi/Form', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLaporanImunisasiRequest $request)
    {
        $posyandu_id = Request::input('posyandus_id');
        if(Auth::user()->hasRole('kader')){
            $posyandu_id = Auth::user()->staff->posyandus_id;
        }
        $posyandu = Posyandu::find($posyandu_id);

        $jenis_imunisasi = [
            'Vitamin A - 1',
            'Vitamin A - 2',
            'Oralit',
            'BH (NOL)',
            'BCG',
            'POLIO - 1',
            'POLIO - 2',
            'POLIO - 3',
            'DPT/HB - 1',
            'DPT/HB - 2',
            'DPT/HB - 3',
            'Campak',
        ];
        $balita = Balita::filter(Request::only('search', 'order'))
            ->with(['orangTua', 'riwayatImunisasis'])
            ->when(Auth::user()->hasRole('Kader') ?? null, function ($query) {
                $query->whereHas('orangTua', function ($query) {
                    $query->where('posyandus_id', Auth::user()->staff->posyandus_id);
                });
            })
            ->when(Request::input('posyandus_id'), function ($query) {
                $query->whereHas('orangTua', function ($query) {
                    $query->where('posyandus_id', Request::input('posyandus_id'));
                });

            })
            ->get()->toArray();

        $pdf = PDF::loadView('pdf.laporan', compact('jenis_imunisasi', 'posyandu', 'balita'));
        $pdf->setPaper('a4', 'landscape');
        // Unduh PDF
        return $pdf->stream('laporan.pdf');
    }


    /**
     * Display the specified resource.
     */
    public function show(LaporanImunisasi $laporanImunisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanImunisasi $laporanImunisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaporanImunisasiRequest $request, LaporanImunisasi $laporanImunisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanImunisasi $laporanImunisasi)
    {
        //
    }
}
