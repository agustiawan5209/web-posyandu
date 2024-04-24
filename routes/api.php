<?php

use App\Http\Controllers\Api\ApiModelController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\OrangTuaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get-user', [ApiModelController::class, 'getUser'])->name('api.user.getUser');
Route::get('get-orangtua', [ApiModelController::class, 'getOrgTua'])->name('api.orangtua.getOrgTua');
Route::get('get-anak', [ApiModelController::class, 'getBalita'])->name('api.balita.getBalita');
Route::get('get-data-balita', [ApiModelController::class, 'geDatatBalita'])->name('api.balita.getDataBalita');

Route::get('get-berat-data/{id}', [ApiModelController::class, 'getBeratBadaBalita'])->name('api.balita.getBerat');
Route::get('get-tinggi-data/{id}', [ApiModelController::class, 'getTinggiBalita'])->name('api.balita.getTinggi');
Route::get('get-lingkarkepala-data/{id}', [ApiModelController::class, 'getLingkarKepalaBalita'])->name('api.balita.getLingkarKepala');
Route::get('get-doughnat-data', [ApiModelController::class, 'getDoughnatChart'])->name('api.Chart.getDoughnatChart');
Route::get('get-jadwal-data', [ApiModelController::class, 'getJadwal'])->name('api.jadwal.getJadwal');
Route::get('get-pengguna-data/{tahun}', [ApiModelController::class, 'getJumlahPengguna'])->name('api.pengguna.jumlah');
