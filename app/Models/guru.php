<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'username',
        'pelajaran',
    ];

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(mahasiswa::class, 'id', 'guru_id');
    }
}
