<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\auth;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\usersController;
use App\Models\mahasiswa;
use App\Models\matkul;
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

    Route::controller(MahasiswaController::class)->group(function () {
        Route::get('/mahasiswa', 'viewListMahasiswa')->name('mahasiswa');
        Route::get('/form_mahasiswa', 'validationMahasiswa');
        Route::get('/form_editMahasiswa/{id}', 'form_editMahasiswa');
        Route::get('/deleteMahasiswa/{id}', 'deletedDatas');    

        // operations datas
        Route::post('/newMahasiswa', 'storeMahasiswa')->name('newMahasiswa');
        Route::post('/updateMahasiswa/{id}', 'validationEditMahasiswa')->name('updatedMahasiswa');
    });

    Route::controller(DosenController::class)->group(function () {
        Route::get('/dosen', 'viewListDosen');
        Route::get('/form_dosen', 'validationDosen');
        Route::get('/form_editDosen/{id}', 'form_editDosen');
        Route::get('/delete/{id}', 'deletedDatas');
        
        // operations datas
        Route::post('/newDosen', 'storeDosen')->name('newDosen');
        Route::post('/updateDosen/{id}', 'validationEditDosen')->name('updatedDosen');
    });
    
    Route::controller(MatkulController::class)->group(function () {
        Route::get('/Mata-Kuliah', 'viewListMatkul');
        Route::get('/form_matkul', 'validationMatkul');
        Route::get('/form_editMatkul/{id}', 'form_editMatkul');
        Route::get('/delete/{id}', 'deletedDatas');
        
        // operations datas
        Route::post('/newMatkul', 'storeMatkul')->name('newMatkul');
        Route::post('/updateMatkul/{id}', 'validationEditMatkul')->name('updatedMatkul');
    });
});

Route::get('/signOut', [loginController::class, 'signOut'])->name('signOut');
