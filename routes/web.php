<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalImunisasiController;
use App\Http\Controllers\JenisImunisasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanImunisasiController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PegawaiPosyanduController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatImunisasiController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\SettingPuskesmasController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jadwal-imunisasi-puskesmas', [HomeController::class, 'jadwal'])->name('Home.jadwal');
Route::get('/informasi-puskesmas', [HomeController::class, 'informasi'])->name('Home.informasi');

Route::get('/validate-user', [DashboardController::class, 'validate'])->middleware(['auth', 'verified'])->name('validate');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified', 'role:Kepala|Kader'])->name('dashboard');
Route::get('/dashboard/orang-tua', [DashboardController::class, 'dashboardPengguna'])->middleware(['auth', 'verified', 'role:Orang Tua'])->name('dashboard.pengguna');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/data.php';


Route::middleware(['auth', 'verified', 'role:Kepala|Kader|Orang Tua'])->group(function () {

    // Router Orang Tua
    Route::group(['prefix' => 'orang-tua', 'as' => "OrangTua.",], function () {
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

    // Route Bayi/Balita
    Route::group(['prefix' => 'balita', 'as' => "Balita."], function () {
        Route::controller(BalitaController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data-balita', 'create')->name('create');
            Route::get('/ubah-data-balita', 'edit')->name('edit');
            Route::get('/detail-data-balita', 'show')->name('show');

            Route::post('/store-data-balita', 'store')->name('store');
            Route::post('/storeForm-data-balita', 'storeForm')->name('storeForm');

            Route::put('/update-data-balita', 'update')->name('update');
            Route::delete('/hapus-data-balita', 'destroy')->name('destroy');
        });
    });
    // Route Jenis Imunisasi
    Route::group(['prefix' => 'jenis-imunisasi', 'as' => "JenisImunisasi."], function () {
        Route::controller(JenisImunisasiController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data/jenis-imunisasi', 'create')->name('create');
            Route::get('/ubah-data/jenis-imunisasi', 'edit')->name('edit');
            Route::get('/detail-data/jenis-imunisasi', 'show')->name('show');

            Route::post('/store-data/jenis-imunisasi', 'store')->name('store');
            Route::post('/storeForm-data/jenis-imunisasi', 'storeForm')->name('storeForm');

            Route::put('/update-data/jenis-imunisasi', 'update')->name('update');
            Route::delete('/hapus-data/jenis-imunisasi', 'destroy')->name('destroy');
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

    // Router Jadwal
    Route::group(['prefix' => 'jadwal-imunisasi', 'as' => "Jadwal."], function () {
        Route::controller(JadwalImunisasiController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data/jadwal-imunisasi', 'create')->name('create');
            Route::get('/edit-data/jadwal-imunisasi', 'edit')->name('edit');
            Route::get('/detail-data/jadwal-imunisasi', 'show')->name('show');
            Route::post('/store-data/jadwal-imunisasi', 'store')->name('store');
            Route::put('/update-data/jadwal-imunisasi', 'update')->name('update');
            Route::delete('/hapus-data/jadwal-imunisasi', 'destroy')->name('destroy');
            Route::get('/cetak-data/jadwal-imunisasi/{id}', 'cetak')->name('cetak_by_id');
            Route::get('/cetak-semua-data/jadwal-imunisasi/all', 'cetak_all')->name('cetak');
        });
    });


    // Router Riwayat
    Route::group(['prefix' => 'riwayat-imunisasi', 'as' => "Riwayat."], function () {
        Route::controller(RiwayatImunisasiController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data/riwayat-imunisasi', 'create')->name('create');
            Route::get('/edit-data/riwayat-imunisasi', 'edit')->name('edit');
            Route::get('/detail-data/riwayat-imunisasi', 'show')->name('show');
            Route::post('/store-data/riwayat-imunisasi', 'store')->name('store');
            Route::put('/update-data/riwayat-imunisasi', 'update')->name('update');
            Route::delete('/hapus-data/riwayat-imunisasi', 'destroy')->name('destroy');
        });
    });


    // Router Sertifikat
    Route::group(['prefix' => 'data-imunisasi', 'as' => "Sertifikat."], function () {
        Route::controller(SertifikatController::class)->group(function () {
            Route::get('/data-imunisasi', 'index')->name('index');
            Route::get('/tambah-data-imunisasi/sertifikat-imunisasi', 'create')->name('create');
            Route::get('/edit-data-imunisasi/sertifikat-imunisasi', 'edit')->name('edit');
            Route::get('/detail-data-imunisasi/sertifikat-imunisasi', 'show')->name('show');
            Route::post('/store-data-imunisasi/sertifikat-imunisasi', 'store')->name('store');
            Route::put('/update-data-imunisasi/sertifikat-imunisasi', 'update')->name('update');
            Route::delete('/hapus-data-imunisasi/sertifikat-imunisasi', 'destroy')->name('destroy');
        });
    });

    // Route Setting Puskesma
    Route::group(['prefix' => 'setting-puskesmas', 'as' => "SettingPuskesmas."], function () {
        Route::controller(SettingPuskesmasController::class)->group(function () {
            Route::get('/', 'create')->name('create');
            Route::post('/store-data-puskesmas', 'store')->name('store');
        });
    });

    // Router Posyandus
    Route::group(['prefix' => 'posyandus', 'as' => "Posyandus."], function () {
        Route::controller(PosyanduController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data/posyandus', 'create')->name('create');
            Route::get('/edit-data/posyandus', 'edit')->name('edit');
            Route::get('/detail-data/posyandus', 'show')->name('show');
            Route::post('/store-data/posyandus', 'store')->name('store');
            Route::put('/update-data/posyandus', 'update')->name('update');
            Route::delete('/hapus-data/posyandus', 'destroy')->name('destroy');
        });
    });

    // Laporan Per Posyandu Kepada Kepala
    // Router Posyandus
    Route::group(['prefix' => 'laporan', 'as' => "Laporan."], function () {
        Route::controller(LaporanController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cetak', 'cetakPDF')->name('cetak');
        });
    });

    Route::group(['prefix' => 'laporan-imunisasi', 'as' => "Laporan-imunisasi."], function () {
        Route::controller(LaporanImunisasiController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/buat', 'create')->name('create');
            Route::get('/cetak', 'store')->name('store');
        });
    });
});


Route::get('pdf-document', [PDFController::class, 'generatePDF'])->name('pdf');
