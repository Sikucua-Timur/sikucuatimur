<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AgendaController extends Controller
{
    /**
     * Menampilkan daftar semua agenda yang akan datang & sebelumnya
     */
    public function index()
    {
        // Menampilkan agenda terurut dari terbaru ke lama
        $agenda = Agenda::orderBy('tanggal', 'desc')->paginate(10);

        return view('public.agenda.index', compact('agenda'));
    }

    /**
     * Menampilkan detail satu agenda berdasarkan ID
     */
    public function show($id)
    {
        $item = Agenda::findOrFail($id);

        return view('public.agenda.show', compact('item'));
    }

    /**
     * (Opsional) Menampilkan agenda yang akan datang saja
     */
    public function upcoming()
    {
        $agenda = Agenda::where('tanggal', '>=', Carbon::now())
                        ->orderBy('tanggal')
                        ->paginate(10);

        return view('public.agenda.upcoming', compact('agenda'));
    }

    /**
     * (Opsional) Menampilkan arsip agenda (yang sudah lewat)
     */
    public function archive()
    {
        $agenda = Agenda::where('tanggal', '<', Carbon::now())
                        ->orderBy('tanggal', 'desc')
                        ->paginate(10);

        return view('public.agenda.archive', compact('agenda'));
    }

    /**
     * (Admin/public khusus) Menyaring agenda berdasarkan bulan & tahun
     */
    public function filterByMonth(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        $agenda = Agenda::whereMonth('tanggal', $request->bulan)
                        ->whereYear('tanggal', $request->tahun)
                        ->orderBy('tanggal', 'desc')
                        ->paginate(10);

        return view('public.agenda.index', compact('agenda'));
    }
    
    public function filter(Request $request)
    {
        $query = Agenda::query()->orderBy('tanggal', 'desc');

        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('tanggal', $request->tahun);
        }

        $agendas = $query->paginate(10);

        return view('public.agenda.filter', compact('agendas'));
    }
}
