@extends('admin.layouts.admin')

@section('title','Dashboard Admin')

@section('content')
  @php
    $profilRoute = isset($profil) && $profil
      ? route('admin.profil-nagari.edit', $profil->id)
      : route('admin.profil-nagari.create');

    $commonCards = [
      ['count'=>$profilCount,'label'=>'Profil Nagari','icon'=>'🏠','route'=>$profilRoute],
      ['count'=>$pendudukCount,'label'=>'Penduduk','icon'=>'👨🏻‍👩🏻‍👧🏻','route'=>route('admin.penduduk.index')],
      ['count'=>$beritaCount,'label'=>'Berita','icon'=>'📰','route'=>route('admin.berita.index')],
      ['count'=>$galeriCount,'label'=>'Galeri','icon'=>'📷','route'=>route('admin.galeri.index')],
      ['count'=>$layananCount,'label'=>'Layanan','icon'=>'📝','route'=>route('admin.layanan.index')],
      ['count'=>$agendaCount,'label'=>'Agenda','icon'=>'🗓️','route'=>route('admin.agenda.index')],
      ['count'=>$aparaturCount,'label'=>'Aparatur','icon'=>'👤','route'=>route('admin.aparatur.index')],
      ['count'=>$suratPending,'label'=>'Surat Pending','icon'=>'✉️','route'=>route('admin.surat.index')],
      ['count'=>$suratTotal,'label'=>'Total Surat','icon'=>'📬','route'=>route('admin.surat.index')],
    ];

    $superAdminCards = [
      ['count'=>$userCount,'label'=>'User/Admin','icon'=>'🧑🏻‍💻','route'=>route('admin.users.index')],
    ];
  @endphp

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($commonCards as $card)
      <a href="{{ $card['route'] }}" class="p-6 bg-white rounded-xl shadow hover:shadow-md hover:-translate-y-1 transition transform">
        <div class="flex items-center space-x-4">
          <div class="text-4xl">{{ $card['icon'] }}</div>
          <div>
            <p class="text-xl font-bold text-gray-800">{{ $card['count'] }}</p>
            <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
          </div>
        </div>
      </a>
    @endforeach

    @if(auth()->user()->role === 'superadmin')
      @foreach($superAdminCards as $card)
        <a href="{{ $card['route'] }}" class="p-6 bg-white rounded-xl shadow hover:shadow-md hover:-translate-y-1 transition transform">
          <div class="flex items-center space-x-4">
            <div class="text-4xl">{{ $card['icon'] }}</div>
            <div>
              <p class="text-xl font-bold text-gray-800">{{ $card['count'] }}</p>
              <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
            </div>
          </div>
        </a>
      @endforeach
    @endif
  </div>
@endsection
