<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class MahasiswaController extends Controller
{
    protected function validationMahasiswa(Request $request)
    {
        return response()->view('Admin.Form.createdMahasiswa', ['title' => 'Form Mahasiswa']);
    }

    protected function storeMahasiswa(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'npm' => 'required|string|max:10|unique:mahasiswas,npm',
            'name' => 'required|string|max:255',
            'tanggal' => 'required|date|before:today',
            'semester' => 'required|integer|min:1|max:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:mahasiswas,email',
            'tlp' =>  'required|string|max:20|unique:mahasiswas,phone',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if ($request->file('image')) {
            $request->file('image')->store('images');
        }

        $code = Str::uuid();
        try {
            mahasiswa::create(
                [
                    'code' => $code,
                    'npm' => $request->input('npm'),
                    'name' => $request->input('name'),
                    'birth_date' => $request->input('tanggal'),
                    'semester' => $request->input('semester'),
                    'image' => $request->file('image'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('tlp'),
                ]
            );
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_mahasiswa')->with('failed', "failed");
        }
        return response()->redirectTo('/admin/mahasiswa')->with('success', 'User created successfully.');
    }
}
