<?php

use App\Http\Controllers\Api\ApiModelController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\OrangTuaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:session')->group(function () {
    Route::get('get-user', [ApiModelController::class, 'getUser'])->name('data.user.getUser');
    Route::get('get-orangtua', [ApiModelController::class, 'getOrgTua'])->name('data.orangtua.getOrgTua');
    Route::get('get-anak', [ApiModelController::class, 'getBalita'])->name('data.balita.getBalita');
    Route::get('get-data-balita', [ApiModelController::class, 'geDatatBalita'])->name('data.balita.getDataBalita');

    Route::get('get-berat-data/{id}', [ApiModelController::class, 'getBeratBadaBalita'])->name('data.balita.getBerat');
    Route::get('get-tinggi-data/{id}', [ApiModelController::class, 'getTinggiBalita'])->name('data.balita.getTinggi');
    Route::get('get-lingkarkepala-data/{id}', [ApiModelController::class, 'getLingkarKepalaBalita'])->name('data.balita.getLingkarKepala');
    Route::get('get-doughnat-data', [ApiModelController::class, 'getDoughnatChart'])->name('data.Chart.getDoughnatChart');
    Route::get('get-jadwal-data', [ApiModelController::class, 'getJadwal'])->name('data.jadwal.getJadwal');
    Route::get('get-pengguna-data/{tahun}', [ApiModelController::class, 'getJumlahPengguna'])->name('data.pengguna.jumlah');
});
