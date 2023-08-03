<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'role',
    ];

    protected function admin()
    {
        return $this->hasOne(admin::class, 'users_id', 'code');
    }
}
