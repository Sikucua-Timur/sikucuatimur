<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilNagari extends Model
{
    protected $table = 'profil_nagari';

    protected $fillable = [
        'nama_nagari',
        'kepala_nagari',
        'alamat',
        'visi',
        'misi',
        'sejarah',
        'tanggal_berdiri',
        'luas_wilayah',
        'jumlah_penduduk',
        'latitude',
        'longitude',
        'logo',
        'struktur_organisasi',
        'telepon',
        'email',
        'website',
    ];
    
    protected $casts = [
        'tanggal_berdiri' => 'date', // atau 'datetime' jika ada waktu
    ];
}


