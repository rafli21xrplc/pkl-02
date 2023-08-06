<?php

namespace App\Http\Controllers;

use App\Models\absen;
use App\Models\jadwal;
use App\Models\mahasiswa;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class AbsenController extends Controller
{
    protected function absen($id)
    {
        $absen = absen::with('absen')->find($id);
        return response()->json([
            'datas' => $absen
        ]);
    }

    protected function mahasiswa($id)
    {
        $mahasiswa = absen::with('mahasiswa')->find($id);
        return response()->json([
            'data' => $mahasiswa
        ]);
    }

    protected function viewListAbsen(Request $request)
    {
        $title = 'Absensi';
        $mahasiswas = mahasiswa::all();
        $jadwals = jadwal::with('matkul', 'dosen')->get();
        $absens = absen::with('jadwal.dosen', 'jadwal.matkul', 'mahasiswa')->get();
        return response()->view('User.absensi', compact('title', 'mahasiswas', 'absens', 'jadwals'));
    }

    protected function storeAbsen(Request $request)
    {
        $validate = Validator($request->all(), [
            'code' => 'required|string|max:100',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'date' => 'required|date',
            'status' => 'required|in:Hadir,Alpha,Izin',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                absen::create(
                    [
                        'code' => $code,
                        'mahasiswa_id' => $request->input('mahasiswa_id'),
                        'jadwal_id' => $request->input('jadwal_id'),
                        'date' => $request->input('date'),
                        'status' => $request->input('status'),
                        'image' => $image,
                    ]
                );
            } catch (Throwable $e) {
                return response()->redirectTo('/dashboard')->with('failed', "failed");
            }
            return response()->redirectTo('/dashboard')->with('success', 'User created successfully.');
        }
    }

    protected function deleted(string $id)
    {
        try {
            DB::table('absens')->where('code', $id)->delete();
        } catch (ModelNotFoundException $e) {
            return response()->redirectTo('/dashboard')->with('error', 'Record not found.');
        } catch (\Exception $e) {
            return response()->redirectTo('/dashboard')->with('error', 'An error occurred.');
        }

        return response()->redirectTo('/dashboard')->with('message', 'Data success deleted');
    }
}
