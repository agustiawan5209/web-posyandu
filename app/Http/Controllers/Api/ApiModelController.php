<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\OrangTua;
use App\Http\Controllers\Controller;
use App\Models\Balita;
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
}
