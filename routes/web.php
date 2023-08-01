<?php

use App\Http\Controllers\auth;
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

Route::controller(usersController::class)->group(function () {
    Route::get('/', 'viewSignIn')->name('viewSignIn');
    Route::post('/', 'validationSignIn')->name('validateSignIn');
    Route::get('/signUp', 'viewSignUp');
    Route::post('/signUp', 'validationSignUp')->name('validateSignUp');
});

Route::get('/dashboard', function () {
    return view('absensiMahasiswa', ['title' => 'Absensi Mahasiswa']);
})->middleware('auth');

Route::get('/dosen', function () {
    return view('dosen', ['title' => 'Dosen']);
});

Route::get('/Mata-Kuliah', function () {
    return view('matkul', ['title' => 'Mata Kuliah']);
});

Route::get('/form', function () {
    return view('Dosen.created', ['title' => 'Mata Kuliah']);
});