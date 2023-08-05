<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MahasiswaController;
use App\Models\mahasiswa;
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


Route::get('matkul/{id}', [JadwalController::class, 'jadwalMatkuls']);
Route::get('jadwalDosen/{id}', [JadwalController::class, 'jadwalDosen']);
Route::get('absen/{id}', [AbsenController::class, 'absen']);
Route::get('mahasiswa/{id}', [AbsenController::class, 'mahasiswa']);