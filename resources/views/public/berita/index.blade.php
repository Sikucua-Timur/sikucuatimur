@extends('layouts.public')

@section('title', 'Berita Nagari')

@section('content')
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-10">
      <h1 class="text-4xl font-bold text-gray-800 mb-2">Berita Nagari Sikucua Timur</h1>
      <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800 text-sm inline-flex items-center gap-1 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
          <path d="M9.707 14.707a1 1 0 01-1.414 0L3.586 10l4.707-4.707a1 1 0 111.414 1.414L6.414 10l3.293 3.293a1 1 0 010 1.414z"/>
        </svg>
        Kembali ke Beranda
      </a>
    </div>

    @if($berita->count())
      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($berita as $item)
          <a href="{{ route('public.berita.show', $item->id) }}"
             class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group flex flex-col">
            
            @if($item->gambar)
              <img src="{{ asset('storage/' . $item->gambar) }}"
                   alt="{{ $item->judul }}"
                   class="w-full h-48 object-cover group-hover:scale-105 transform transition duration-300">
            @endif

            <div class="p-5 flex-grow flex flex-col">
              <h2 class="text-xl font-bold text-gray-800 mb-1 group-hover:text-indigo-600 transition">{{ $item->judul }}</h2>
              <p class="text-xs text-gray-500 mb-3">{{ $item->created_at->translatedFormat('d F Y') }}</p>
              <p class="text-sm text-gray-700 line-clamp-3 flex-grow">{{ strip_tags($item->konten) }}</p>
            </div>
          </a>
        @endforeach
      </div>

      <div class="mt-12">
        {{ $berita->links('pagination::tailwind') }}
      </div>
    @else
      <div class="text-center text-gray-500 mt-20">
        <p class="text-lg">Belum ada berita yang tersedia saat ini.</p>
      </div>
    @endif
  </div>
</section>
@endsection
