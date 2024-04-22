<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\OrangTua;
use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\JadwalImunisasi;
use App\Models\RiwayatImunisasi;
use Illuminate\Support\Facades\Request;

class ApiModelController extends Controller
{

    /**
     * getUser
     *
     * @return void
     */
    public function getUser(){
        $search = Request::input('search');

        $user = User::filter($search)->role('Kader')->get();

        return json_encode($user);
    }


    /**
     * getOrgTua
     *
     * @return void
     */
    public function getOrgTua(){
        $search = Request::only('search');

        $user = OrangTua::filter($search)->get();

        return json_encode($user);
    }
    public function getBalita(){
        $search = Request::only('search');

        $user = Balita::with(['orangTua'])->filter($search)->get();

        return json_encode($user);
    }

    public function getBeratBadaBalita($id){

        $riwayat = RiwayatImunisasi::where('balita_id', '=', $id)->get();
        $data = [];
        $label = [];
        foreach ($riwayat as $key => $value) {
            $data[$key]= $value->data_imunisasi['berat_badan'];
            $label[$key]= $value->tanggal;
        }

        return json_encode([
            'data_chart'=> $data,
            'label'=> $label,
        ]);
    }
    public function getTinggiBalita($id){

        $riwayat = RiwayatImunisasi::where('balita_id', '=', $id)->get();
        $data = [];
        $label = [];
        foreach ($riwayat as $key => $value) {
            $data[$key]= $value->data_imunisasi['tinggi_badan'];
            $label[$key]= $value->tanggal;
        }

        return json_encode([
            'data_chart'=> $data,
            'label'=> $label,
        ]);
    }
    public function getLingkarKepalaBalita($id){

        $riwayat = RiwayatImunisasi::where('balita_id', '=', $id)->get();
        $data = [];
        $label = [];
        foreach ($riwayat as $key => $value) {
            $data[$key]= $value->data_imunisasi['lingkar_kepala'];
            $label[$key]= $value->tanggal;
        }

        return json_encode([
            'data_chart'=> $data,
            'label'=> $label,
        ]);
    }
    public function getDoughnatChart(){

        $balita = Balita::all()->count();
        $org = User::role('Orang Tua')->get()->count();
        $kader = User::role('Kader')->get()->count();
        $data = [$balita, $org,$kader];
        $label = ['Bayi/Balita', 'Orang Tua', 'Kader'];

        return json_encode([
            'data_chart'=> $data,
            'label'=> $label,
        ]);
    }

    public function getJadwal(){
        $jadwal = JadwalImunisasi::all();
        $data = [];
        $tanggal = [];

        foreach($jadwal as $key => $value) {
            $data[] = [
                'tanggal'=> $value->tanggal,
                'deskripsi'=> $value->deskripsi,
            ];
            $tanggal[] = $value->tanggal;
        }

        return [
            'data'=> $data,
            'tanggal'=> array_values(array_unique($tanggal)),
        ];
    }
}
