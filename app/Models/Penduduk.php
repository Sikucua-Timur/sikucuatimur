<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nik', 'kk', 'alamat',
        'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'agama', 'pekerjaan'
    ];

    // --- Tambahkan ini ---
    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];
}
