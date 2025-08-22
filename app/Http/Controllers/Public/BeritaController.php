<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Tampilkan semua berita terbaru.
     */
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'desc')->paginate(9);
        return view('public.berita.index', compact('berita'));
    }

    /**
     * Tampilkan detail satu berita berdasarkan ID.
     */
    public function show($id)
    {
        $item = Berita::findOrFail($id);
        return view('public.berita.show', compact('item'));
    }
}
