<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'jadwal_id',
        'date',
        'image',
        'status'
    ];

    public function jadwal()
    {
        return $this->hasMany(jadwal::class, 'id', 'jadwal_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(mahasiswa::class, 'id', 'mahasiswa_id');
    }
}
