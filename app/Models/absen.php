<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
    use HasFactory;

    public function absen()
    {
        return $this->hasOne(jadwal::class, 'id', 'jadwal_id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(absen::class, 'id', 'mahasiswa_id');
    }
}
