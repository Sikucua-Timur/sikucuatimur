@extends('layouts.public')

@section('title', 'Agenda Nagari')

@section('content')
<div class="container mx-auto px-4 py-10">

    {{-- Judul --}}
    <div class="flex flex-col items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-2">Agenda Nagari Sikucua Timur</h1>
        <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800 text-sm inline-flex items-center gap-1 mt-2 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.707 14.707a1 1 0 01-1.414 0L3.586 10l4.707-4.707a1 1 0 111.414 1.414L6.414 10l3.293 3.293a1 1 0 010 1.414z"/>
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    {{-- Filter --}}
    <div>
        <form action="{{ route('public.agenda.filter') }}" method="GET" class="flex flex-col sm:flex-row items-center justify-center gap-4">
            {{-- Bulan --}}
            <div class="relative w-full sm:w-auto">
                <select name="bulan" class="appearance-none border border-gray-300 rounded-lg px-4 py-2 text-sm pr-8 w-full sm:w-44 focus:outline-none focus:ring focus:ring-indigo-200">
                    @foreach(range(1,12) as $b)
                        <option value="{{ $b }}">{{ DateTime::createFromFormat('!m', $b)->format('F') }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 12a1 1 0 01-.7-.29l-4-4a1 1 0 011.4-1.42L10 9.59l3.3-3.3a1 1 0 111.4 1.42l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            {{-- Tahun --}}
            <div class="relative w-full sm:w-auto">
                <select name="tahun" class="appearance-none border border-gray-300 rounded-lg px-4 py-2 text-sm pr-8 w-full sm:w-32 focus:outline-none focus:ring focus:ring-indigo-200">
                    @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
                <div class="pointer-events-none absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 12a1 1 0 01-.7-.29l-4-4a1 1 0 011.4-1.42L10 9.59l3.3-3.3a1 1 0 111.4 1.42l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            {{-- Tombol Filter --}}
            <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-indigo-700 transition w-full sm:w-auto">
                Filter
            </button>
        </form>
    </div>

    {{-- Agenda List --}}
    @if($agenda->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($agenda as $item)
                <a href="{{ route('public.agenda.show', $item->id) }}" class="bg-white rounded-2xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="p-5">
                        <h2 class="text-lg font-semibold text-indigo-700 mb-1">{{ $item->judul }}</h2>
                        <p class="text-sm text-gray-500 mb-1">
                            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </p>
                        @if($item->lokasi)
                            <p class="text-sm text-gray-500 mb-1">
                                <strong>Lokasi:</strong> {{ $item->lokasi }}
                            </p>
                        @endif
                        <div class="mt-3">
                            <span class="text-sm font-medium text-indigo-600 hover:underline">Lihat Detail →</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $agenda->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center text-gray-500 mt-12">
            <p class="text-lg">Belum ada agenda ditemukan.</p>
        </div>
    @endif

</div>
@endsection
