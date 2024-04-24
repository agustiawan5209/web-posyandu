<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use NumberFormatter;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreSertifikatRequest;
use App\Http\Requests\UpdateSertifikatRequest;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'sertifikats'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        return Inertia::render('Sertifikat/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id','balita_id'])),
            'data' => Sertifikat::filter(Request::only('search', 'order'))->with(['balita'])->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add sertifikat'),
                'edit' => Auth::user()->can('edit sertifikat'),
                'show' => Auth::user()->can('show sertifikat'),
                'delete' => Auth::user()->can('delete sertifikat'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Sertifikat/Form',[]);
    }

    function intToRomanNumeral(int $num) {
        static $nf = new NumberFormatter('@numbers=roman', NumberFormatter::DECIMAL);
        return $nf->format($num);
    }
    public function generateNomorSurat()
    {
        // Customize this as per your format
        $prefix = 'PBU/';
        $sequentialNumber = $this->getNextSequentialNumber();
        $y = date('Y');
        $m = $this->intToRomanNumeral(date('m'));
        $d = $this->intToRomanNumeral(date('d'));
        return $prefix . "$y/$m/$d" . '/' . $sequentialNumber;
    }
    protected function getNextSequentialNumber()
    {
        // Example: Fetch the last record and increment the sequential number
        $lastRecord = Sertifikat::latest()->first();

        if ($lastRecord) {
            $lastReferenceNumber = $lastRecord->nomor;
            // Extract and increment the sequential number
            preg_match('/\/(\d+)$/', $lastReferenceNumber, $matches);
            $sequentialNumber = (int)$matches[1] + 1;
        } else {
            // If no records exist, start from 1
            $sequentialNumber = 1;
        }

        return str_pad($sequentialNumber, 4, '0', STR_PAD_LEFT); // Adjust length as needed
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSertifikatRequest $request)
    {
        $data = $request->all();
        $data['nomor']= $this->generateNomorSurat();
        // PDF
        $pdf = new PDFController();
        $data['file']=  $pdf->generatePDF($request);
        $sertifikat = Sertifikat::create($data);
        return redirect()->route('Sertifikat.index')->with('message','Data Sertifikat Berhasil Di Tambah!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sertifikat $sertifikat)
    {
        return Inertia::render('Sertifikat/Show',[
            'sertfikat'=> $sertifikat->find(Request::input('slug')),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sertifikat $sertifikat)
    {
        return Inertia::render('Sertifikat/Edit',[
            'sertfikat'=> $sertifikat->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSertifikatRequest $request, Sertifikat $sertifikat)
    {
        $data = $request->all();
        $sertifikat = Sertifikat::find($request->slug)->update($request->all());
        return redirect()->route('Sertifikat.index')->with('message','Data Sertifikat Berhasil Di Edit!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sertifikat $sertifikat)
    {
        $sertifikat = Sertifikat::find(Request::input('slug'))->delete();
        return redirect()->route('Sertifikat.index')->with('message','Data Sertifikat Berhasil Di Hapus!!');
    }
}
