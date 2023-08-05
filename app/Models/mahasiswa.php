<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class mahasiswa extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];

    protected $fillable = [
        'code',
        'npm',
        'name',
        'birth_date',
        'semester',
        'image',
        'email',
        'phone',
    ];

}
