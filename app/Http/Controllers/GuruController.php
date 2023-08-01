<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\mahasiswa;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function showMahasiswa($id)
    {
        $mhs = mahasiswa::with('guru')->where('id', $id)->first();
        return response()->json([
            'data-siswa' => $mhs
        ]);
    }

    public function showGuru($id)
    {
        $guru = guru::with('mahasiswa')->where('id', $id)->first();
        return response()->json([
            'data-guru' => $guru
        ]);
    }


}
