<?php

namespace App\Http\Controllers;

use App\Models\matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class MatkulController extends Controller
{
    protected function validationMatkul(Request $request)
    {
        return response()->view('Admin.Form.createdMatkul', ['title' => 'Form Mata Kuliah']);
    }

    protected function storeMatkul(Request $request)
    {
        $validate = Validator($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $code = Str::uuid();

        try {
            matkul::create(
                [
                    'code' => $code,
                    'name' => $request->input('name'),
                ]
            );
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_matkul')->with('failed', "failed");
        }
        return response()->redirectTo('/admin/Mata-Kuliah')->with('success', 'User created successfully.');
    }
}
