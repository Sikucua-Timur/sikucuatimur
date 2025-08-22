<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aparatur extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'no_hp',
        'email',
        'alamat',
        'pendidikan',
        'foto',
        'is_aktif',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'is_aktif' => 'boolean',
    ];
}
