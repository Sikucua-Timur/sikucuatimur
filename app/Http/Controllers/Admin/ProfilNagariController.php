<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilNagari;
use Illuminate\Http\Request;

class ProfilNagariController extends Controller
{
    public function show()
    {
        $profil = ProfilNagari::first();
        return view('admin.profil-nagari.show', compact('profil'));
    }

    public function create()
    {
        return view('admin.profil-nagari.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_nagari'            => 'required|string|max:255',
            'kepala_nagari'          => 'required|string|max:255',
            'alamat'                 => 'required|string',
            'telepon'                => 'nullable|string|max:50',
            'email'                  => 'nullable|email|max:255',
            'website'                => 'nullable|string|max:255',
            'visi'                   => 'nullable|string',
            'misi'                   => 'nullable|string',
            'sejarah'                => 'nullable|string',
            'tanggal_berdiri'        => 'nullable|date',
            'luas_wilayah'           => 'nullable|string|max:255',
            'jumlah_penduduk'        => 'nullable|integer',
            'latitude'               => 'nullable|string|max:255',
            'longitude'              => 'nullable|string|max:255',
            'logo'                   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'struktur_organisasi'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('profil-nagari/logo', 'public');
        }

        if ($request->hasFile('struktur_organisasi')) {
            $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('profil-nagari/struktur', 'public');
        }

        ProfilNagari::create($data);

        return redirect()->route('admin.dashboard');
    }

    public function edit()
    {
        $profil = ProfilNagari::first();

        if (! $profil) {
            return redirect()->route('admin.profil-nagari.create');
        }

        return view('admin.profil-nagari.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilNagari::firstOrFail();

        $data = $request->validate([
            'nama_nagari'            => 'required|string|max:255',
            'kepala_nagari'          => 'required|string|max:255',
            'alamat'                 => 'required|string',
            'telepon'                => 'nullable|string|max:50',
            'email'                  => 'nullable|email|max:255',
            'website'                => 'nullable|string|max:255',
            'visi'                   => 'nullable|string',
            'misi'                   => 'nullable|string',
            'sejarah'                => 'nullable|string',
            'tanggal_berdiri'        => 'nullable|date',
            'luas_wilayah'           => 'nullable|string|max:255',
            'jumlah_penduduk'        => 'nullable|integer',
            'latitude'               => 'nullable|string|max:255',
            'longitude'              => 'nullable|string|max:255',
            'logo'                   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'struktur_organisasi'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('profil-nagari/logo', 'public');
        }

        if ($request->hasFile('struktur_organisasi')) {
            $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('profil-nagari/struktur', 'public');
        }

        $profil->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Profil Nagari berhasil diperbarui.');
    }
}
