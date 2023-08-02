<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    protected function validationDosen(Request $request)
    {
        return response()->view('Admin.Form.createdDosen', ['title' => 'Form Dosen']);
    }
}
