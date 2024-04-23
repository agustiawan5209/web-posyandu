<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Balita;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        if(Auth::check()){
            abort(401, 'Maaf Akses anda Ditolak');
        }
        // dd(Auth::user());

    }

    public function validate(Request $request, array $rules, array $messages = [], array $attributes = [])
    {
        $role = Auth::user()->getRoleNames()->toArray();

        if(in_array('Kepala', $role) || in_array('Kader', $role)){
            return redirect()->route('dashboard');
        }

        if(in_array('Orang Tua', $role)){
            return redirect()->route('dashboard.pengguna');
        }
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard',[
            'pengguna'=> User::role('Orang Tua')->count(),
            'balita'=> Balita::all()->count(),
        ]);
    }

    public function dashboardPengguna()
    {
        return Inertia::render('User/Dashboard',[
            'pengguna'=> User::role('Orang Tua')->count(),
            'balita'=> Balita::all()->count(),
        ]);
    }
}
