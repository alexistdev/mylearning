<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{LoginController as AuthApi,MapelController as MapelApi,JadwalController as JadApi,TugasController as TgsApi};
//use App\Http\Controllers\Api\{MapelController as MapelApi};
//use

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthApi::class, 'validasi_login']);
Route::get('/mapel', [MapelApi::class, 'get_data_mapel']);
Route::get('/pertemuan', [MapelApi::class, 'get_materi']);
Route::get('/jadwal', [JadApi::class, 'get_data_jadwal']);
Route::get('/tugas', [TgsApi::class, 'get_data_tugas']);
Route::get('/pertemuan/detail', [MapelApi::class, 'get_detail_pertemuan']);
