<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'kategori',
        'syarat',
        'waktu_layanan',
        'status_aktif',
        'ikon',
        'form_template'
    ];
}

