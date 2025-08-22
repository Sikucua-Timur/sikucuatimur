<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    /**
     * Menampilkan daftar surat masuk.
     */
    public function index()
    {
        $surats = Surat::latest()->paginate(10);
        return view('admin.surat.index', compact('surats'));
    }

    /**
     * Menampilkan detail satu surat.
     */
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('admin.surat.show', compact('surat'));
    }

    /**
     * Menghapus surat.
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return back()->with('success', 'Surat berhasil dihapus.');
    }
    public function approve($id) {
        $surat = Surat::findOrFail($id);
        $surat->status = 'disetujui';
        $surat->save();
        return back()->with('success', 'Surat disetujui.');
    }

    public function reject($id) {
        $surat = Surat::findOrFail($id);
        $surat->status = 'ditolak';
        $surat->save();
        return back()->with('success', 'Surat ditolak.');
    }

    public function export($id) {
        $surat = Surat::findOrFail($id);
        $pdf = Pdf::loadView('admin.surat.pdf', compact('surat'));
        return $pdf->stream('surat-'.$surat->id.'.pdf');
    }
}
