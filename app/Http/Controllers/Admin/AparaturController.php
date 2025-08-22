<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aparatur;
use Illuminate\Http\Request;

class AparaturController extends Controller
{
    public function index()
    {
        $aparatur = Aparatur::orderBy('is_aktif', 'desc')
                            ->orderBy('nama')
                            ->get();
        return view('admin.aparatur.index', compact('aparatur'));
    }

    public function create()
    {
        return view('admin.aparatur.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'nip'           => 'nullable|string|max:100',
            'jabatan'       => 'required|string|max:255',
            'tempat_lahir'  => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama'         => 'nullable|string|max:50',
            'no_hp'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:100',
            'alamat'        => 'nullable|string',
            'pendidikan'    => 'nullable|string|max:100',
            'foto'          => 'nullable|image|max:2048',
            'is_aktif'      => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('aparatur', 'public');
        }

        Aparatur::create($data);

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil ditambahkan.');
    }

    public function edit(Aparatur $aparatur)
    {
        return view('admin.aparatur.edit', compact('aparatur'));
    }

    public function update(Request $request, Aparatur $aparatur)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'nip'           => 'nullable|string|max:100',
            'jabatan'       => 'required|string|max:255',
            'tempat_lahir'  => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama'         => 'nullable|string|max:50',
            'no_hp'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:100',
            'alamat'        => 'nullable|string',
            'pendidikan'    => 'nullable|string|max:100',
            'foto'          => 'nullable|image|max:2048',
            'is_aktif'      => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('aparatur', 'public');
        }

        $aparatur->update($data);

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil diperbarui.');
    }

    public function destroy(Aparatur $aparatur)
    {
        if ($aparatur->foto && \Storage::disk('public')->exists($aparatur->foto)) {
            \Storage::disk('public')->delete($aparatur->foto);
        }

        $aparatur->delete();

        return redirect()->route('admin.aparatur.index')
            ->with('success', 'Data aparatur berhasil dihapus.');
    }

    public function show(Aparatur $aparatur)
    {
        return view('admin.aparatur.show', compact('aparatur'));
    }
}
