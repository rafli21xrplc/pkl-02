<?php

namespace App\Http\Controllers;

use App\Models\matkul;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class MatkulController extends Controller
{
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
        return response()->redirectTo('/admin/Mata-Kuliah')->with('success', 'User created successfully.');
    }

    protected function validationEditMatkul(Request $request, string $id)
    {
        $validate = Validator($request->all(), [
            'name' => 'required|string|max:255',
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
        return response()->redirectTo('/admin/Mata-Kuliah')->with('success', 'User created successfully.');
    }

    protected function deletedDatas(Request $request, string $id)
    {
        try {
            DB::table('matkuls')->where('code', $id)->delete();
        } catch (ModelNotFoundException $e) {
            return response()->redirectTo('/admin/Mata-Kuliah')->with('error', 'Record not found.');
        } catch (\Exception $e) {
            return response()->redirectTo('/admin/Mata-Kuliah')->with('error', 'An error occurred.');
        }

        return response()->redirectTo('/admin/Mata-Kuliah')->with('message', 'Data success deleted');
    }
}
