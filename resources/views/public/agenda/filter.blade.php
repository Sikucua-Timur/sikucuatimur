@extends('layouts.public')

@section('title', 'Filter Agenda')

@section('content')
<div class="container mx-auto px-4 py-10 max-w-5xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Filter Agenda</h1>
        <a href="{{ route('home') }}" class="text-sm text-indigo-600 hover:underline">
            ← Kembali ke Beranda
        </a>
    </div>

    <form method="GET" action="{{ route('public.agenda.filter') }}" class="bg-white p-6 rounded-xl shadow mb-8 flex flex-col md:flex-row gap-4">
        <div class="w-full md:w-1/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Bulan</label>
            <select name="bulan" class="w-full border-gray-300 rounded-lg">
                <option value="">Semua Bulan</option>
                @foreach(range(1, 12) as $bulan)
                    <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Tahun</label>
            <select name="tahun" class="w-full border-gray-300 rounded-lg">
                <option value="">Semua Tahun</option>
                @for($tahun = now()->year; $tahun >= 2020; $tahun--)
                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endfor
            </select>
        </div>
        <div class="w-full md:w-1/3 flex items-end">
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg">
                Filter
            </button>
        </div>
    </form>

    @if($agendas->count())
        <div class="space-y-4">
            @foreach($agendas as $agenda)
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                    <h2 class="text-xl font-bold">
                        <a href="{{ route('public.agenda.show', $agenda->id) }}" class="text-indigo-700 hover:underline">
                            {{ $agenda->judul }}
                        </a>
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}
                        @if($agenda->lokasi) — {{ $agenda->lokasi }} @endif
                    </p>
                    <p class="mt-2 text-gray-600 line-clamp-2">{{ $agenda->deskripsi }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $agendas->withQueryString()->links() }}
        </div>
    @else
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-lg">
            Tidak ada agenda ditemukan untuk filter yang dipilih.
        </div>
    @endif
</div>
@endsection
