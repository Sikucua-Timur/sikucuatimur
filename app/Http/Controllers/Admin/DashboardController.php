<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\Agenda;
use App\Models\Aparatur;
use App\Models\Surat;
use App\Models\User;
use App\Models\ProfilNagari;

class DashboardController extends Controller
{
    public function index()
    {
        $profil = ProfilNagari::first();

        return view('admin.dashboard', [
            'pendudukCount'   => Penduduk::count(),
            'beritaCount'     => Berita::count(),
            'galeriCount'     => Galeri::count(),
            'layananCount'    => Layanan::count(),
            'agendaCount'     => Agenda::count(),
            'aparaturCount'   => Aparatur::count(),
            'userCount'       => User::count(),
            'suratPending'    => Surat::where('status', 'pending')->count(),
            'suratTotal'      => Surat::count(),

            // Profil Nagari
            'profilNagariAda' => (bool) $profil,                  // apakah sudah ada data
            'profilCount'     => ProfilNagari::count(),            // jumlah record (0 atau 1)
            'profil'          => $profil,                          // instance ProfilNagari pertama atau null
        ]);
    }
}
