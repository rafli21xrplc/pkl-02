<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class MahasiswaController extends Controller
{

    protected function viewListMahasiswa(Request $request)
    {
        $title = 'Mahasiswa';
        $mahasiswas = mahasiswa::all();
        return response()->view('Admin.mahasiswa', compact('title', 'mahasiswas'));
    }

    protected function form_editMahasiswa(Request $request, $id)
    {
        $title = 'Mahasiswa';
        $mahasiswas = DB::table('mahasiswas')->where('code', $id)->first();
        return response()->view('Admin.Form.updatedMahasiswa', compact('title', 'mahasiswas'));
    }

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

    protected function validationEditMahasiswa(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'npm' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'tanggal' => 'required|date|before:today',
            'semester' => 'required|integer|min:1|max:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255',
            'tlp' =>  'required|string|max:20',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if ($request->file('image')) {
            $request->file('image')->store('images');
        }

        $value = [
            'code' => $id,
            'npm' => $request->input('npm'),
            'name' => $request->input('name'),
            'birth_date' => $request->input('tanggal'),
            'semester' => $request->input('semester'),
            'image' => $request->file('image'),
            'email' => $request->input('email'),
            'phone' => $request->input('tlp'),
        ];

        try {
            DB::table('mahasiswas')
                ->where('code', $id)
                ->update($value);
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_mahasiswa')->with('failed', "failed");
        }
        return response()->redirectTo('/admin/mahasiswa')->with('success', 'User created successfully.');
    }

    protected function deletedDatas(Request $request, string $id)
    {
        try {
            DB::table('mahasiswas')->where('code', $id)->delete();
        } catch (ModelNotFoundException $e) {
            return response()->redirectTo('/mahasiswa')->with('error', 'Record not found.');
        } catch (\Exception $e) {
            return response()->redirectTo('/mahasiswa')->with('error', 'An error occurred.');
        }

        return response()->redirectTo('/admin/mahasiswa')->with('message', 'Data success deleted');
    }
}
