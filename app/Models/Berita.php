<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'penulis',
        'tanggal_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime', // ✅ ini wajib agar bisa ->format()
    ];
}
