@extends('layouts.public')

@section('title', $item->judul)

@section('content')
<div class="container mx-auto px-4 py-10">

    {{-- Judul dan Navigasi --}}
    <div class="flex flex-col items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2 text-center">{{ $item->judul }}</h1>
        <a href="{{ route('public.agenda.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm inline-flex items-center gap-1 mt-2 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.707 14.707a1 1 0 01-1.414 0L3.586 10l4.707-4.707a1 1 0 111.414 1.414L6.414 10l3.293 3.293a1 1 0 010 1.414z"/>
                <path d="M13 14a1 1 0 100-2 1 1 0 000 2z" />
            </svg>
            Kembali ke Agenda
        </a>
    </div>

    {{-- Detail Agenda --}}
    <div class="bg-white rounded-2xl shadow p-6 sm:p-8 space-y-4">
        <p class="text-sm text-gray-500"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>

        @if($item->lokasi)
            <p class="text-sm text-gray-500"><strong>Lokasi:</strong> {{ $item->lokasi }}</p>
        @endif

        @if($item->deskripsi)
        <div class="prose max-w-none text-gray-800 mt-4">
            {!! nl2br(e($item->deskripsi)) !!}
        </div>
        @endif
    </div>

</div>
@endsection
