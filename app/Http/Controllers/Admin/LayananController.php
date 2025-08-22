<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreLayananRequest;
use App\Http\Requests\UpdateLayananRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::latest()->paginate(10);
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(StoreLayananRequest $request)
    {
        $data = $request->validated();

        // Handle upload ikon
        if ($request->hasFile('ikon')) {
            $data['ikon'] = $request->file('ikon')->store('layanan', 'public');
        }

        Layanan::create($data);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(UpdateLayananRequest $request, Layanan $layanan)
    {
        $data = $request->validated();

        if ($request->hasFile('ikon')) {
            // Hapus ikon lama jika ada
            if ($layanan->ikon && Storage::disk('public')->exists($layanan->ikon)) {
                Storage::disk('public')->delete($layanan->ikon);
            }

            $data['ikon'] = $request->file('ikon')->store('layanan', 'public');
        }

        $layanan->update($data);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->ikon && Storage::disk('public')->exists($layanan->ikon)) {
            Storage::disk('public')->delete($layanan->ikon);
        }

        $layanan->delete();

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }

    public function exportCsv(): StreamedResponse
    {
        $filename = 'data_layanan_' . now()->format('Ymd_His') . '.csv';

        $layanans = Layanan::all();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ];

        $callback = function () use ($layanans) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['ID', 'Nama', 'Deskripsi', 'Syarat', 'Waktu Layanan', 'Kategori', 'Status Aktif', 'Created At']);

            foreach ($layanans as $layanan) {
                fputcsv($file, [
                    $layanan->id,
                    $layanan->nama,
                    $layanan->deskripsi,
                    $layanan->syarat,
                    $layanan->waktu_layanan,
                    $layanan->kategori,
                    $layanan->status_aktif ? 'Aktif' : 'Nonaktif',
                    $layanan->created_at->format('Y-m-d H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
