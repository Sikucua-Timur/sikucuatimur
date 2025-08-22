<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = ['nama', 'email', 'jenis_surat', 'isi', 'status'];
}
