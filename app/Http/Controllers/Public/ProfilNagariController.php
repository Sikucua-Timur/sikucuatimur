<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ProfilNagari;

class ProfilNagariController extends Controller
{
    /**
     * Tampilkan halaman profil nagari.
     */
    public function index()
    {
        $profil = ProfilNagari::first(); // Ambil data pertama dari tabel
        return view('public.profil-nagari.index', compact('profil'));
    }
}
