<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Aparatur;

class AparaturController extends Controller
{
    /**
     * Tampilkan daftar aparatur aktif.
     */
    public function index()
    {
        $aparatur = Aparatur::where('is_aktif', true)
                            ->orderBy('jabatan')  // atur urutan sesuai kebutuhan
                            ->paginate(8);

        return view('public.aparatur.index', compact('aparatur'));
    }

    /**
     * (Opsional) Tampilkan detail satu aparatur.
     */
    public function show($id)
    {
        $person = Aparatur::findOrFail($id);
        return view('public.aparatur.show', compact('person'));
    }
}
