<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Penduduk;
use App\Models\Agenda;
use App\Models\Layanan;
use App\Models\Galeri;
// Tambahkan import model Aparatur
use App\Models\Aparatur;

class HomeController extends Controller
{
    public function index()
    {
        // Berita terbaru (highlight 3)
        $berita = Berita::orderBy('created_at', 'desc')->take(3)->get();

        // Preview Aparatur (aktif, misal 8 orang)
        $aparatur = Aparatur::where('is_aktif', true)
                            ->orderBy('jabatan')
                            ->take(8)
                            ->get();

        // Statistik (jika masih dipakai di view)
        $penduduk_count = Penduduk::count();
        $berita_count   = Berita::count();
        $agenda_count   = Agenda::count();
        $layanan_count  = Layanan::count();

        // Galeri preview
        $galeri = Galeri::orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();

        return view('public.home', compact(
            'berita',
            'aparatur',
            'galeri',
            'penduduk_count',
            'berita_count',
            'agenda_count',
            'layanan_count'
        ));
    }
}
