<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    protected function validationMahasiswa(Request $request)
    {
        return response()->view('Admin.Form.createdMahasiswa', ['title' => 'Form Mahasiswa']);
    }
}
