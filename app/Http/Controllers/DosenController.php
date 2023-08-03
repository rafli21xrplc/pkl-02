<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class DosenController extends Controller
{
    protected function validationDosen(Request $request)
    {
        $title = 'Dosen';
        $matkuls = matkul::all();
        return response()->view('Admin.Form.createdDosen', compact('title', 'matkuls'));
    }

    protected function storeDosen(Request $request)
    {
        $validate = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:dosens,email',
            'tlp' =>  'required|string|max:20|unique:dosens,phone',
            'mengajar' =>  'required|string'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $code = Str::uuid();

        try {
            dosen::create(
                [
                    'code' => $code,
                    'name' => $request->input('name'),
                    'bidang mengajar' => $request->input('mengajar'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('tlp'),
                ]
            );
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_dosen')->with('failed', "failed");
        }
        return response()->redirectTo('/admin/dosen')->with('success', 'User created successfully.');
    }
}
