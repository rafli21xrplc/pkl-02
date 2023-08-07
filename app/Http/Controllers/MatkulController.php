<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\jadwal;
use App\Models\matkul;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;
use RealRashid\SweetAlert\Facades\Alert;

class MatkulController extends Controller
{

    protected function viewMataKuliah(Request $request)
    {
        $title = 'Mata Kuliah';
        $matkuls = matkul::all();
        return response()->view('User.matkul', compact('title', 'matkuls'));
    }

    protected function viewListMatkul(Request $request)
    {
        $title = 'Mata Kuliah';
        $matkuls = matkul::all();
        return response()->view('Admin.matkul', compact('title', 'matkuls'));
    }

    protected function validationMatkul(Request $request)
    {
        return response()->view('Admin.Form.createdMatkul', ['title' => 'Form Mata Kuliah']);
    }

    protected function form_editMatkul(Request $request, string $id)
    {
        $title = 'Mata Kuliah';
        $matkuls = DB::table('matkuls')->where('code', $id)->first();
        return response()->view('Admin.Form.updatedMatkul', compact('title', 'matkuls'));
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
        Alert::success('success', 'Data Success Di Buat!!');
        return response()->redirectTo('/admin/Mata-Kuliah')->with('success', 'User created successfully.');
    }

    protected function validationEditMatkul(Request $request, string $id)
    {
        $validate = Validator($request->all(), [
            'name' => 'required|string|max:255|unique:matkuls,name',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        $value = [
            'code' => $id,
            'name' => $request->input('name'),
        ];

        try {
            DB::table('matkuls')
                ->where('code', $id)
                ->update($value);
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_matkul')->with('failed', "failed");
        }
        Alert::success('success', 'Data Success Di Update!!');
        return response()->redirectTo('/admin/Mata-Kuliah')->with('success', 'User created successfully.');
    }

    protected function deletedDatas(Request $request, string $id)
    {

        // $datasRelations = dosen::find('code', $id);
        // dd($datasRelations);

        try {
            DB::table('matkuls')->where('code', $id)->delete();
        } catch (QueryException $e) {
            return response()->redirectTo('/admin/Mata-Kuliah')->with('error', 'Data Masih Digunakan.');
        }

        Alert::success('success', 'Data Success Di Delete!!');
        return response()->redirectTo('/admin/Mata-Kuliah')->with('message', 'Data success deleted');
    }
}
