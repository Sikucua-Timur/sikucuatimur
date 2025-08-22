@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

<!-- Hero Section -->
<section class="relative h-screen bg-cover bg-center" style="background-image: url('{{ asset('storage/images/hero.jpg') }}');">
  <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
  <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
    <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">Selamat Datang di Sikucua Timur</h1>
    <p class="text-lg md:text-xl max-w-2xl mb-6 drop-shadow-md">Mari Jelajahi Indahnya Nagari Kami</p>
  </div>
</section>

<!-- Introduction Section -->
<section class="py-32 bg-gray-100">
  <div class="max-w-4xl mx-auto text-center px-4">
    <h2 class="text-3xl font-bold mb-4">Tentang Kota Kami</h2>
    <p class="text-gray-700 leading-relaxed">Kota ini dikenal sebagai pusat kebudayaan dan inovasi. Kami berkomitmen untuk menyediakan layanan terbaik bagi warga, memajukan pembangunan infrastruktur, dan menjaga warisan sejarah yang kaya.</p>
  </div>
</section>

<!-- Aparatur Section -->
<section id="aparatur" class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-12">Aparatur Kota</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      @foreach($aparatur as $person)
        <div class="bg-gray-50 rounded-lg shadow p-6 text-center hover:shadow-lg transition">
          <img src="{{ $person->foto ? asset('storage/' . $person->foto) : asset('images/default-user.png') }}" alt="{{ $person->nama }}" class="mx-auto w-24 h-24 rounded-full object-cover mb-4">
          <h3 class="text-xl font-semibold mb-1">{{ $person->nama }}</h3>
          <p class="text-sm text-gray-600">{{ $person->jabatan }}</p>
        </div>
      @endforeach
    </div>
    <div class="mt-10 text-center">
      <a href="{{ route('public.aparatur.index') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full">Lihat Semua Aparatur</a>
    </div>
  </div>
</section>

<!-- News Section -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold mb-10">Berita Terbaru</h2>
    @if($berita->count())
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($berita as $item)
          <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
            @if($item->gambar)
              <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
            @endif
            <div class="p-4 text-left">
              <h3 class="text-lg font-semibold mb-2 truncate">
                <a href="{{ route('public.berita.show', $item->id) }}" class="hover:text-indigo-600">{{ $item->judul }}</a>
              </h3>
              <p class="text-sm text-gray-600 mb-3 line-clamp-3">{{ strip_tags($item->konten) }}</p>
              <a href="{{ route('public.berita.show', $item->id) }}" class="text-sm text-indigo-600 font-medium hover:underline">Baca Selengkapnya</a>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-gray-600">Belum ada berita terbaru saat ini.</p>
    @endif

    <div class="mt-10">
      <a href="{{ route('public.berita.index') }}" class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full">Lihat Semua Berita</a>
    </div>
  </div>
</section>

@endsection
