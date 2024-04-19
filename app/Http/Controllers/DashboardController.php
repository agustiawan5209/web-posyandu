<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(User::role('Orang Tua')->count());
        return Inertia::render('Dashboard',[
            'pengguna'=> User::role('Orang Tua')->count(),
        ]);
    }
}
