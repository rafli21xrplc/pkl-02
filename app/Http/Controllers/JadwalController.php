<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\jadwal;
use App\Models\matkul;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Support\Str;

class JadwalController extends Controller
{
    protected function jadwalMatkuls(int $id)
    {
        $title = "Absensi";
        $matkuls = jadwal::with('matkul', 'dosen')->find($id);
        return response()->json([
            'data' => $matkuls
        ]);
    }

    protected function jadwalDosen(int $id)
    {
        $dosen = jadwal::with('dosen')->find($id);
        return response()->json([
            'data' => $dosen
        ]);
    }

    protected function viewListJadwal()
    {
        $title = "Jadwal";
        $jadwal = jadwal::with('matkul', 'dosen')->get();
        return response()->view('Admin.jadwal', compact('title', 'jadwal'));
    }

    protected function validationJadwal()
    {
        $title = "Form Jadwal";
        $dosens = dosen::all();
        $matkuls = matkul::all();
        return response()->view('Admin.Form.createdJadwal', compact('title', 'dosens', 'matkuls'));
    }

    protected function form_EditJadwal(string $id)
    {
        $title = "Jadwal";
        $dosens = dosen::all();
        $matkuls = matkul::all();
        $jadwals = jadwal::with('matkul', 'dosen')->where('code', $id)->first();
        return response()->view('Admin.Form.updatedJadwal', compact('title', 'jadwals', 'dosens', 'matkuls'));
    }

    protected function storeJadwal(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'dosen_id' => 'required|exists:dosens,id',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i|before:12:00',
            'end_time' => 'required|date_format:H:i|before:12:00',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if ($dosen_id = $request->input('dosen_id')) {
            $dosen = dosen::where('id', $dosen_id)->first();
            $mata_kuliah_id = matkul::where('name', $dosen->bidang_mengajar)->first();
        }

        $code = Str::uuid();

        try {
            jadwal::create(
                [
                    'code' => $code,
                    'dosen_id' => $request->input('dosen_id'),
                    'mata_kuliah_id' => $mata_kuliah_id->id,
                    'day_of_week' => $request->input('day_of_week'),
                    'start_time' => $request->date('start_time'),
                    'end_time' => $request->input('end_time'),
                ]
            );
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_Jadwal')->with('failed', 'failed');
        }
        return response()->redirectTo('/admin/jadwal')->with('success', 'User created successfully.');
    }

    protected function validationEditJadwal(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'dosen_id' => 'required',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i|before:12:00',
            'end_time' => 'required|date_format:H:i|before:12:00',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        if ($dosen_id = $request->input('dosen_id')) {
            $dosen = dosen::where('id', $dosen_id)->first();
            $mata_kuliah_id = matkul::where('name', $dosen->bidang_mengajar)->first();
        }

        $value =
            [
                'code' => $id,
                'dosen_id' => $request->input('dosen_id'),
                'mata_kuliah_id' => $mata_kuliah_id->id,
                'day_of_week' => $request->input('day_of_week'),
                'start_time' => $request->date('start_time'),
                'end_time' => $request->input('end_time'),
            ];

        try {
            DB::table('jadwals')
                ->where('code', $id)
                ->update($value);
        } catch (Throwable $e) {
            return response()->redirectTo('/admin/form_Jadwal')->with('failed', 'failed');
        }
        return response()->redirectTo('/admin/jadwal')->with('success', 'User created successfully.');
    }

    protected function deletedDatas(string $id)
    {
        try {
            DB::table('jadwals')->where('code', $id)->delete();
        } catch (ModelNotFoundException $e) {
            return response()->redirectTo('/jadwal')->with('error', 'Record not found.');
        } catch (\Exception $e) {
            return response()->redirectTo('/jadwal')->with('error', 'An error occurred.');
        }

        return response()->redirectTo('/admin/jadwal')->with('message', 'Data success deleted');
    }
}
