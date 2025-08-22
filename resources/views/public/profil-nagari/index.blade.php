@extends('layouts.public')

@section('title', 'Profil Nagari')

@section('content')

<!-- Full Width Section -->

<div class="w-full bg-gray-50 py-14">
  <div class="max-w-6xl mx-auto px-4">

```
<!-- Page Title -->
<div class="flex flex-col items-center mb-8">
  <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 text-center mb-3">Profil Nagari Sikucua Timur</h1>
  <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800 text-sm inline-flex items-center gap-1 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
        <path d="M9.707 14.707a1 1 0 01-1.414 0L3.586 10l4.707-4.707a1 1 0 111.414 1.414L6.414 10l3.293 3.293a1 1 0 010 1.414z"/>
        <path d="M13 14a1 1 0 100-2 1 1 0 000 2z" />
    </svg>
    Kembali ke Beranda
  </a>
</div>

<!-- Main Card -->
<div class="bg-white p-6 sm:p-10 rounded-2xl shadow-md space-y-14">

  {{-- Logo --}}
  @if($profil->logo)
    <div class="flex justify-center">
      <img src="{{ asset('storage/' . $profil->logo) }}"
           alt="Logo Nagari"
           class="h-24 sm:h-32 w-auto mb-8 border border-gray-200 shadow">
    </div>
  @endif

  <!-- Info Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

    <!-- Tentang Nagari -->
    <div class="space-y-4">
      <h2 class="text-xl font-semibold text-indigo-700">Tentang Nagari</h2>
      <ul class="space-y-2 text-gray-800 text-sm leading-relaxed">
        <li><span class="font-medium">Nama Nagari:</span> {{ $profil->nama_nagari }}</li>
        <li><span class="font-medium">Kepala Nagari:</span> {{ $profil->kepala_nagari }}</li>
        <li><span class="font-medium">Alamat:</span> {{ $profil->alamat }}</li>
        <li><span class="font-medium">Telepon:</span> {{ $profil->telepon }}</li>
        <li><span class="font-medium">Email:</span> {{ $profil->email }}</li>
        <li><span class="font-medium">Website:</span>
          <a href="{{ $profil->website }}" class="text-indigo-600 hover:underline" target="_blank">
            {{ Str::after($profil->website, '://') }}
          </a>
        </li>
      </ul>
    </div>

    <!-- Statistik -->
    <div class="space-y-4">
      <h2 class="text-xl font-semibold text-indigo-700">Data Statistik</h2>
      <ul class="space-y-2 text-gray-800 text-sm leading-relaxed">
        <li><span class="font-medium">Tanggal Berdiri:</span> {{ \Carbon\Carbon::parse($profil->tanggal_berdiri)->format('d F Y') }}</li>
        <li><span class="font-medium">Luas Wilayah:</span> {{ $profil->luas_wilayah }} km²</li>
        <li><span class="font-medium">Jumlah Penduduk:</span> {{ number_format($profil->jumlah_penduduk) }} jiwa</li>
      </ul>
    </div>

  </div>

  <!-- Visi Misi -->
  <div class="space-y-5">
    <h2 class="text-xl font-semibold text-indigo-700">Visi & Misi</h2>
    @if($profil->visi)
      <p class="text-sm text-gray-800 leading-relaxed">
        <strong>Visi:</strong> {{ $profil->visi }}
      </p>
    @endif
    @if($profil->misi)
      <div class="text-sm text-gray-800 leading-relaxed">
        <p class="font-medium mb-2">Misi:</p>
        <ul class="list-decimal ml-6 space-y-1">
          @foreach(explode("\n", trim($profil->misi)) as $m)
            <li>{{ trim($m) }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>

  <!-- Sejarah -->
  @if($profil->sejarah)
    <div class="space-y-4">
      <h2 class="text-xl font-semibold text-indigo-700">Sejarah Singkat</h2>
      <p class="text-sm text-gray-700 leading-relaxed">{!! nl2br(e($profil->sejarah)) !!}</p>
    </div>
  @endif

  <!-- Struktur Organisasi -->
  @if($profil->struktur_organisasi)
    <div class="space-y-4">
      <h2 class="text-xl font-semibold text-indigo-700">Struktur Organisasi</h2>
      <div class="flex justify-center">
        <img src="{{ asset('storage/' . $profil->struktur_organisasi) }}"
             alt="Struktur Organisasi"
             class="w-full max-w-3xl rounded-xl shadow">
      </div>
    </div>
  @endif

  <!-- Lokasi -->
  @if($profil->latitude && $profil->longitude)
    <div class="space-y-4">
      <h2 class="text-xl font-semibold text-indigo-700">Lokasi Nagari</h2>
      <div class="aspect-video rounded-xl overflow-hidden shadow">
        <iframe
          src="https://www.google.com/maps?q={{ $profil->latitude }},{{ $profil->longitude }}&hl=id&z=14&output=embed"
          allowfullscreen
          class="w-full h-full border-0">
        </iframe>
      </div>
    </div>
  @endif

</div>
```

  </div>
</div>

@endsection
