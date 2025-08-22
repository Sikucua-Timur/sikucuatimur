@extends('layouts.public')

@section('title', 'Aparatur')

@section('content')
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-8">Aparatur Kami</h2>
    @if($aparatur->count())
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($aparatur as $person)
          <div class="bg-gray-50 rounded-lg shadow p-6 text-center">
            @if($person->foto)
              <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}" class="mx-auto w-24 h-24 object-cover rounded-full mb-4">
            @else
              <div class="bg-gray-200 w-24 h-24 rounded-full mx-auto mb-4"></div>
            @endif
            <h3 class="text-xl font-semibold mb-2">{{ $person->nama }}</h3>
            <p class="text-sm text-gray-600 mb-4">{{ $person->jabatan }}</p>
            <a href="{{ route('public.aparatur.show', $person) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full text-sm">Lihat Profil</a>
          </div>
        @endforeach
      </div>
      <div class="mt-8 text-center">
        {{ $aparatur->links() }}
      </div>
    @else
      <p class="text-center text-gray-500">Belum ada data aparatur.</p>
    @endif
  </div>
</section>
@endsection
