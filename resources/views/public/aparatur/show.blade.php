@extends('layouts.public')

@section('title', $person->nama)

@section('content')
<section class="py-16 bg-white">
  <div class="flex justify-center px-4">
    <div class="w-full max-w-xl text-center">
      @if($person->foto)
        <img src="{{ asset('storage/' . $person->foto) }}"
             alt="{{ $person->nama }}"
             class="mx-auto w-32 h-32 object-cover rounded-full mb-6 border-4 border-indigo-600">
      @endif
      <h1 class="text-4xl font-bold mb-2 text-gray-800">{{ $person->nama }}</h1>
      <p class="text-xl text-indigo-600 mb-6">{{ $person->jabatan }}</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-left mb-8">
        <div class="space-y-2">
          <p><span class="font-semibold">NIP:</span> {{ $person->nip ?? '—' }}</p>
          <p><span class="font-semibold">Jenis Kelamin:</span> {{ $person->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
          <p><span class="font-semibold">Tempat/Tgl Lahir:</span> {{ $person->tempat_lahir ?? '—' }}, {{ $person->tanggal_lahir?->format('d M Y') ?? '—' }}</p>
          <p><span class="font-semibold">Agama:</span> {{ $person->agama ?? '—' }}</p>
        </div>
        <div class="space-y-2">
          <p><span class="font-semibold">Email:</span> {{ $person->email ?? '—' }}</p>
          <p><span class="font-semibold">No. HP:</span> {{ $person->no_hp ?? '—' }}</p>
          <p><span class="font-semibold">Pendidikan:</span> {{ $person->pendidikan ?? '—' }}</p>
          <p><span class="font-semibold">Alamat:</span> {{ $person->alamat ?? '—' }}</p>
        </div>
      </div>

      @if(!empty($person->deskripsi))
        <div class="prose prose-indigo max-w-none text-left mb-8">
          {!! nl2br(e($person->deskripsi)) !!}
        </div>
      @endif

      <a href="{{ route('public.aparatur.index') }}"
         class="inline-block px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full font-medium transition">
        &larr; Kembali ke Daftar
      </a>
    </div>
  </div>
</section>
@endsection
