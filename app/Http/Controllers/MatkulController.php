<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatkulController extends Controller
{
    protected function validationMatkul(Request $request)
    {
        return response()->view('Admin.Form.createdMatkul', ['title' => 'Form Mata Kuliah']);
    }
}
