<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Models\Penduduk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PendudukController extends Controller
{
    /**
     * List all penduduk.
     */
    public function index()
    {
        $penduduks = Penduduk::latest()->paginate(10);
        return view('admin.penduduk.index', compact('penduduks'));
    }

    /**
     * Show form to create a new penduduk.
     */
    public function create()
    {
        return view('admin.penduduk.create');
    }

    /**
     * Store a newly created penduduk.
     */
    public function store(StorePendudukRequest $request)
    {
        $data = $request->validated();

        // Normalisasi tanggal lahir
        if (!empty($data['tanggal_lahir'])) {
            $data['tanggal_lahir'] = Carbon::parse($data['tanggal_lahir'])->format('Y-m-d');
        }

        try {
            Penduduk::create($data);
            return redirect()
                ->route('admin.penduduk.index')
                ->with('success', 'Data penduduk berhasil ditambahkan.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Show details of a penduduk.
     */
    public function show(Penduduk $penduduk)
    {
        return view('admin.penduduk.show', compact('penduduk'));
    }

    /**
     * Show form to edit an existing penduduk.
     */
    public function edit(Penduduk $penduduk)
    {
        return view('admin.penduduk.edit', compact('penduduk'));
    }

    /**
     * Update an existing penduduk.
     */
    public function update(UpdatePendudukRequest $request, Penduduk $penduduk)
    {
        $data = $request->validated();

        if (!empty($data['tanggal_lahir'])) {
            $data['tanggal_lahir'] = Carbon::parse($data['tanggal_lahir'])->format('Y-m-d');
        }

        try {
            $penduduk->update($data);
            return redirect()
                ->route('admin.penduduk.index')
                ->with('success', 'Data penduduk berhasil diperbarui.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Delete a penduduk.
     */
    public function destroy(Penduduk $penduduk)
    {
        try {
            $penduduk->delete();
            return redirect()
                ->route('admin.penduduk.index')
                ->with('success', 'Data penduduk berhasil dihapus.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
