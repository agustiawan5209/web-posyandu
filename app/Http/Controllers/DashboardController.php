<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Balita;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(User::role('Orang Tua')->count());
        // dd(Balita::all()->count());
        return Inertia::render('Dashboard',[
            'pengguna'=> User::role('Orang Tua')->count(),
            'balita'=> Balita::all()->count(),
        ]);
    }
}
