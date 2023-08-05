<?php

namespace App\Http\Controllers;

use App\Models\absen;
use App\Models\mahasiswa;
use Illuminate\Http\Request;

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
        return response()->view('Admin.absensi', compact('title'));
    }
}
