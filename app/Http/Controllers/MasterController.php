<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class MasterController extends Controller
{
    public function index()
    {

        $tableName = 'users'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        return Inertia::render('Master/Index', [
            'search' =>  Request::input('search'),
            'table_colums'=> array_values(array_diff($columns, ['remember_token','password', 'email_verified_at', 'created_at', 'updated_at'])),
            'data'=> User::paginate(10),
        ]);
    }
}
