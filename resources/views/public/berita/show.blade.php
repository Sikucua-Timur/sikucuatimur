@extends('layouts.public')

@section('title', $item->judul)

@section('content')
<div class="container mx-auto px-4 py-10">
    <article class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow-md">
        
        {{-- Judul --}}
        <h1 class="text-4xl font-extrabold mb-4 text-gray-900 leading-snug">
            {{ $item->judul }}
        </h1>

        {{-- Metadata --}}
        <p class="text-sm text-gray-500 mb-1">
            Dipublikasikan pada {{ $item->created_at->format('d M Y') }}
        </p>
        <p class="text-sm text-gray-500 mb-6">
            Penulis: {{ $item->penulis }}
        </p>

        {{-- Gambar Utama --}}
        @if($item->gambar)
            <div class="mb-6 rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" 
                     class="w-full h-auto max-h-[800px] object-cover rounded-xl shadow-sm">
            </div>
        @endif

        {{-- Konten --}}
        <div class="konten-berita prose prose-lg max-w-none text-gray-800 leading-relaxed">
            {!! $item->konten !!}
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-10">
            <a href="{{ route('public.berita.index') }}" 
               class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-200">
                &larr; Kembali ke Daftar Berita
            </a>
        </div>
    </article>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.konten-berita img').forEach(img => {
        // hapus atribut HTML width/height agar CSS responsif bekerja
        img.removeAttribute('width');
        img.removeAttribute('height');

        // bersihkan hanya inline width/height (biarkan inline style lain tetap ada)
        try {
            img.style.width = '';
            img.style.height = '';
        } catch (e) {
            // ignore jika tidak bisa diubah
        }
    });
});
</script>
@endpush

@push('styles')
<style>
/* Styling gambar konten berita: kotak seragam dengan object-fit:cover */
.konten-berita {
  --img-height: 220px; /* ubah tinggi sesuai kebutuhan */
  --img-gap: 0.75rem;
}

/* Default: 3 kolom gambar, dipotong rapi */
.konten-berita img {
  display: inline-block;
  width: calc(33.333% - (var(--img-gap)));
  height: var(--img-height);
  object-fit: cover;
  object-position: center;
  margin: var(--img-gap) var(--img-gap) 0;
  border-radius: 0.5rem;
  vertical-align: middle;
}

/* Jika gambar berdiri sendiri (only-child) -> tampil full width & natural height */
.konten-berita p:only-child img,
.konten-berita img:only-child {
  display: block;
  width: 100%;
  height: auto;
  max-height: 800px;
  margin: 1.25rem auto;
}

/* Responsif: 2 kolom di tablet */
@media (max-width: 768px) {
  .konten-berita img {
    width: calc(50% - (var(--img-gap) / 2));
    height: 180px;
  }
}

/* Mobile: full width */
@media (max-width: 480px) {
  .konten-berita img {
    width: 100%;
    height: auto;
    display: block;
    margin: 0.75rem auto;
  }
}
</style>
@endpush
