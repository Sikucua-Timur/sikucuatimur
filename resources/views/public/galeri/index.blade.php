@extends('layouts.public')

@section('title', 'Galeri Nagari')

@section('content')

<div class="container mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-center mb-8">Galeri Nagari Sikucua Timur</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($galeri as $item)
            <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
                <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-60 object-cover">
                </a>
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $item->judul }}</h2>

                    @if($item->tanggal)
                        <p class="text-sm text-gray-500 mb-1">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </p>
                    @endif

                    @if($item->keterangan)
                        <p class="text-gray-600 text-sm">{{ Str::limit($item->keterangan, 80) }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-3">Belum ada galeri yang tersedia.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $galeri->links() }}
    </div>
</div>

@endsection
