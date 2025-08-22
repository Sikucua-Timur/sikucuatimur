@extends('layouts.public')

@section('title', $item->nama)

@section('content')
<div class="container mx-auto px-4 py-10 max-w-4xl">
    <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">{{ $item->nama }}</h1>

    <div class="space-y-6 text-gray-700 bg-white p-6 rounded-2xl shadow">
        @if($item->kategori)
            <div>
                <p class="text-sm text-gray-500">Kategori</p>
                <p class="font-medium">{{ $item->kategori }}</p>
            </div>
        @endif

        @if($item->waktu_layanan)
            <div>
                <p class="text-sm text-gray-500">Waktu Layanan</p>
                <p class="font-medium">{{ $item->waktu_layanan }}</p>
            </div>
        @endif

        @if($item->syarat)
            <div>
                <p class="text-sm text-gray-500">Syarat</p>
                <div class="prose max-w-none">{!! nl2br(e($item->syarat)) !!}</div>
            </div>
        @endif

        @if($item->deskripsi)
            <div>
                <p class="text-sm text-gray-500">Deskripsi</p>
                <div class="prose max-w-none">{!! nl2br(e($item->deskripsi)) !!}</div>
            </div>
        @endif
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('public.layanan.index') }}" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200">
            &larr; Kembali ke Daftar Layanan
        </a>
    </div>
</div>
@endsection
