@extends('layouts.public')

@section('title', 'Layanan Nagari')

@section('content')
<div class="container mx-auto px-4 py-10 max-w-6xl">
    <h1 class="text-4xl font-bold text-center mb-2">Layanan Nagari</h1>
    <div class="text-center mb-8">
        <a href="{{ route('home') }}" class="text-indigo-600 hover:underline text-sm">
            ← Kembali ke Beranda
        </a>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($layanan as $item)
            <a href="{{ route('public.layanan.show', $item->id) }}" class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition duration-300 flex flex-col items-center text-center">
                @if($item->ikon)
                    <img src="{{ asset('storage/' . $item->ikon) }}" alt="Ikon" class="w-16 h-16 mb-4 object-contain">
                @else
                    <div class="w-16 h-16 mb-4 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 text-xl">
                        <i class="fas fa-cogs"></i>
                    </div>
                @endif
                <h2 class="text-lg font-semibold text-indigo-700 mb-2">{{ $item->nama }}</h2>
                <p class="text-gray-600 text-sm">{{ Str::limit(strip_tags($item->deskripsi), 80) }}</p>
            </a>
        @empty
            <div class="col-span-3 text-center text-gray-500">
                Belum ada layanan yang tersedia.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $layanan->withQueryString()->links() }}
    </div>
</div>
@endsection
