<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\matkul;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class DosenController extends Controller
{
    protected function viewDosen(Request $request)
    {
        $title = 'Dosen';
        $dosens = dosen::all();
        return response()->view('User.dosen', compact('title', 'dosens'));
    }

    protected function viewListDosen(Request $request)
    {
        $title = 'Dosen';
        $dosens = dosen::all();
        return response()->view('Admin.dosen', compact('title', 'dosens'));
    }

    protected function form_editDosen(Request $request, string $id)
    {
        $title = 'Dosen';
        $matkuls = matkul::all();
        $dosens = DB::table('dosens')->where('code', $id)->first();
        return response()->view('Admin.Form.updatedDosen', compact('title', 'dosens', 'matkuls'));
    }

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
            'tlp' =>  'required|string|min:12|max:20|unique:dosens,phone',
            'mengajar' =>  'required|string'
        ], [
            "tlp.min" => "No Harus 12!!"
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
                    'bidang_mengajar' => $request->input('mengajar'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('tlp'),
                ]
            );
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_dosen')->with('failed', "failed");
        }
        Alert::success('success', 'Data Success Di Buat!!');
        return response()->redirectTo('/admin/dosen')->with('success', 'User created successfully.');
    }

    protected function validationEditDosen(Request $request, string $id)
    {
        $validate = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'tlp' =>  'required|string|max:20|min:12',
            'mengajar' =>  'required|string'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $value =
            [
                'code' => $id,
                'name' => $request->input('name'),
                'bidang_mengajar' => $request->input('mengajar'),
                'email' => $request->input('email'),
                'phone' => $request->input('tlp'),
            ];

        try {
            DB::table('dosens')
            ->where('code', $id)
            ->update($value);
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/newDosen')->with('failed', "failed");
        }
        Alert::success('success', 'Data Success Di Update!!');
        return response()->redirectTo('/admin/dosen')->with('success', 'User created successfully.');
    }

    protected function deletedDatas(Request $request, string $id)
    {
        try {
            DB::table('dosens')->where('code', $id)->delete();
        } catch (\Exception $e) {
            return response()->redirectTo('/admin/dosen')->with('error', 'Data Masih Digunakan.');
        }

        Alert::success('success', 'Data Success Di Delete!!');
        return response()->redirectTo('/admin/dosen')->with('message', 'Data success deleted');
    }
}
