<?php

namespace App\Http\Controllers;

use App\Models\JadwalImunisasi;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function index(){
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function jadwal(){
        return Inertia::render('Home/JadwalImunisasi',[
            'jadwal'=> JadwalImunisasi::orderBy('tanggal','desc')->get(),
        ]);
    }
}
