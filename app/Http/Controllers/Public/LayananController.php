<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Menampilkan daftar layanan publik.
     */
    public function index()
    {
        $layanan = Layanan::where('status_aktif', true)
                    ->orderBy('nama')
                    ->paginate(9);

        return view('public.layanan.index', compact('layanan'));
    }

    /**
     * Menampilkan detail layanan tertentu.
     */
    public function show($id)
    {
        $item = Layanan::where('status_aktif', true)->findOrFail($id);
        return view('public.layanan.show', compact('item'));
    }
}
