<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Menampilkan semua galeri publik.
     */
    public function index()
    {
        $galeri = Galeri::orderBy('created_at', 'desc')->paginate(12);
        return view('public.galeri.index', compact('galeri'));
    }
}
