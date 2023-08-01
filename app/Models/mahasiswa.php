<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
    ];

    public function guru(): HasOne
    {
        return $this->hasOne(guru::class, 'guru_id');
    }

}
