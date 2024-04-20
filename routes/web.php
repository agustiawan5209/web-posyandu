<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PegawaiPosyanduController;
use App\Http\Controllers\ProfileController;
use App\Models\PegawaiPosyandu;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/master', [MasterController::class, 'index'])->middleware(['auth', 'verified'])->name('master');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth'])->group(function () {

    // Router Orang Tua
    Route::group(['prefix' => 'orang-tua', 'as' => "OrangTua."], function () {
        Route::controller(OrangTuaController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data-orangtua', 'create')->name('create');
            Route::get('/ubah-data-orangtua', 'edit')->name('edit');
            Route::get('/detail-data-orangtua', 'show')->name('show');
            Route::post('/store-data-orangtua', 'store')->name('store');
            Route::put('/update-data-orangtua', 'update')->name('update');
            Route::delete('/hapus-data-orangtua', 'destroy')->name('destroy');

            // reset password

            Route::get('/reset-password-orang-tua', 'resetpassword')->middleware(['auth', 'password.confirm'])->name('reset.password');
            Route::post('/reset-password-orang-tua', 'resetpasswordUpdate')->name('reset.password');
        });
    });
    Route::group(['prefix' => 'balita', 'as' => "Balita."], function () {
        Route::controller(BalitaController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data-balita', 'create')->name('create');
            Route::get('/ubah-data-balita', 'edit')->name('edit');
            Route::get('/detail-data-balita', 'show')->name('show');
            Route::post('/store-data-balita', 'store')->name('store');
            Route::put('/update-data-balita', 'update')->name('update');
            Route::delete('/hapus-data-balita', 'destroy')->name('destroy');
        });
    });


    // Router Pegawai
    Route::group(['prefix' => 'staff', 'as' => "Pegawai."], function () {
        Route::controller(PegawaiPosyanduController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data-pegawai', 'create')->name('create');
            Route::get('/edit-data-pegawai', 'edit')->middleware(['auth', 'password.confirm'])->name('edit');
            Route::post('/store-data-pegawai', 'store')->name('store');
            Route::put('/update-data-pegawai', 'update')->name('update');
            Route::delete('/hapus-data-pegawai', 'destroy')->name('destroy');

            // reset password

            Route::get('/reset-password-pegawai', 'resetpassword')->middleware(['auth', 'password.confirm'])->name('reset.password');
            Route::post('/reset-password-pegawai', 'resetpasswordUpdate')->name('reset.password');
        });
    });
});
