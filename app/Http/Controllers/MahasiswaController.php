<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class MahasiswaController extends Controller
{

    protected function viewMahasiswa(Request $request)
    {
        $title = 'Mahasiswa';
        $mahasiswas = mahasiswa::all();
        return response()->view('User.mahasiswa', compact('title', 'mahasiswas'));
    }

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
        return response()->view('Admin.Form.createdMahasiswa', ['title' => 'Mahasiswa']);
    }

    protected function storeMahasiswa(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'npm' => 'required|string|max:11|min:10|unique:mahasiswas,npm',
            'name' => 'required|string|max:255',
            'tanggal' => 'required|date|before:today',
            'semester' => 'required|integer|min:1|max:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:mahasiswas,email',
            'tlp' =>  'required|string|max:13|min:12|unique:mahasiswas,phone',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
            $code = Str::uuid();
            try {
                mahasiswa::create(
                    [
                        'code' => $code,
                        'npm' => $request->input('npm'),
                        'name' => $request->input('name'),
                        'birth_date' => $request->input('tanggal'),
                        'semester' => $request->input('semester'),
                        'image' => $image,
                        'email' => $request->input('email'),
                        'phone' => $request->input('tlp'),
                    ]
                );
            } catch (Throwable $e) {
                $error = $e->getMessage();
                return response()->redirectTo('/admin/form_mahasiswa')->with('failed', "$error");
            }

        Alert::success('success', 'Data Success Di Create!!');
            return response()->redirectTo('/admin/mahasiswa')->with('success', 'User created successfully.');
        }
    }

    protected function validationEditMahasiswa(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'npm' => 'required|string|max:11|min:10',
            'name' => 'required|string|max:255',
            'tanggal' => 'required|date|before:today',
            'semester' => 'required|integer|min:1|max:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255',
            'tlp' =>  'required|string|max:13|min:12',
        ]);


        $mahasiswa = mahasiswa::where('code', $id)->first();
        $existingPhotoPath = $mahasiswa->image;

        if ($request->hasFile('image') && $request->file('image')) {
            if ($validate->fails()) {
                return redirect()->back()
                    ->withErrors($validate)
                    ->withInput();
            }

            $newImage = $request->file('image')->store('images', 'public');

            $value = [
                'code' => $id,
                'npm' => $request->input('npm'),
                'name' => $request->input('name'),
                'birth_date' => $request->input('tanggal'),
                'semester' => $request->input('semester'),
                'image' => $newImage,
                'email' => $request->input('email'),
                'phone' => $request->input('tlp'),
            ];

            if (Storage::disk('public')->exists($existingPhotoPath)) {
                Storage::disk('public')->delete($existingPhotoPath);
            }
        } else {
            $value = [
                'code' => $id,
                'npm' => $request->input('npm'),
                'name' => $request->input('name'),
                'birth_date' => $request->input('tanggal'),
                'semester' => $request->input('semester'),
                'email' => $request->input('email'),
                'phone' => $request->input('tlp'),
            ];
        }

        try {
            DB::table('mahasiswas')
                ->where('code', $id)
                ->update($value);
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_mahasiswa')->with('failed', "failed");
        }

        Alert::success('success', 'Data Success Di Update!!');
        return response()->redirectTo('/admin/mahasiswa')->with('success', 'User created successfully.');
    }

    protected function deletedDatas(Request $request, string $id)
    {
        $mahasiswa = mahasiswa::where('code', $id)->first();
        $existingPhotoPath = $mahasiswa->image;
        try {
            Storage::disk('public')->delete($existingPhotoPath);
            DB::table('mahasiswas')->where('code', $id)->delete();
        } catch (ModelNotFoundException $e) {
            return response()->redirectTo('/mahasiswa')->with('error', 'Record not found.');
        } catch (\Exception $e) {
            return response()->redirectTo('/mahasiswa')->with('error', 'An error occurred.');
        }

        Alert::success('success', 'Data Success Di Delete!!');
        return response()->redirectTo('/admin/mahasiswa')->with('message', 'Data success deleted');
    }
}
