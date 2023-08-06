<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'dosen_id',
        'mata_kuliah_id',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    public function matkul()
    {
        return $this->hasMany(matkul::class, 'id', 'mata_kuliah_id');
    }

    public function dosen()
    {
        return $this->hasMany(dosen::class, 'id', 'dosen_id');
    }

    //  public function dosen()
    // {
    //     return $this->belongsTo(Dosen::class, 'dosen_id');
    // }

    // public function matkul()
    // {
    //     return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    // }
}
