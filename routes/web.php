<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\auth;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(loginController::class)->group(function () {
    Route::get('/', 'viewSignIn')->name('viewSignIn');
    Route::post('/', 'validationSignIn')->name('validateSignIn');
    Route::get('/signUp', 'viewSignUp');
    Route::post('/signUp', 'validationSignUp')->name('validateSignUp');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.absensi', ['title' => 'Absensi Mahasiswa']);
    });
    
    Route::get('/mahasiswa', function () {
        return view('Admin.mahasiswa', ['title' => 'Mahasiswa']);
    });
    
    Route::get('/dosen', function () {
        return view('Admin.dosen', ['title' => 'Dosen']);
    });
    
    Route::get('/Mata-Kuliah', function () {
        return view('Admin.matkul', ['title' => 'Mata Kuliah']);
    });

    Route::middleware(['auth', 'admin'])->group(function ()
    {
        Route::controller(MahasiswaController::class)->group(function () {
            Route::get('/form_mahasiswa', 'validationMahasiswa');
        });
        
        Route::controller(DosenController::class)->group(function () {
            Route::get('/form_dosen', 'validationDosen');
        });
        
        Route::controller(MatkulController::class)->group(function () {
            Route::get('/form_matkul', 'validationMatkul');
        });
    });
    
});

Route::get('/signOut', [loginController::class, 'signOut'])->name('signOut');