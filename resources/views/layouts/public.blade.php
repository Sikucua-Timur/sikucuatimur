<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') – {{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts & Scripts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen font-sans antialiased bg-gray-100">

  {{-- Public Header --}}
  <header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">{{ config('app.name', 'Nagari') }}</a>
      <nav class="space-x-4">
        <a href="{{ route('public.profil') }}" class="text-gray-700 hover:text-indigo-600">Profil</a>
        <a href="{{ route('public.berita.index') }}" class="text-gray-700 hover:text-indigo-600">Berita</a>
        <a href="{{ route('public.agenda.index') }}" class="text-gray-700 hover:text-indigo-600">Agenda</a>
        <a href="{{ route('public.layanan.index') }}" class="text-gray-700 hover:text-indigo-600">Layanan</a>
        <a href="{{ route('public.galeri.index') }}" class="text-gray-700 hover:text-indigo-600">Galeri</a>
        <a href="{{ route('public.aparatur.index') }}" class="text-gray-700 hover:text-indigo-600">Aparatur</a>
      </nav>
    </div>
  </header>

  {{-- Main Content --}}
  <main class="flex-grow">
    @yield('content')
  </main>

  {{-- Public Footer --}}
  <footer class="bg-gray-800 text-gray-300">
    <div class="container mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-10">
      <div>
        <h3 class="font-semibold mb-2">Nagari Sikucua Timur x UNAND</h3>
        <p class="text-sm">Alamat: Jl. Raya Sikucua Timur No.1</p>
        <p class="text-sm">Email: info@sikucuatimur.id</p>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Navigasi</h3>
        <ul class="space-y-1 text-sm">
          <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
          <li><a href="{{ route('public.profil') }}" class="hover:text-white">Profil</a></li>
          <li><a href="{{ route('public.berita.index') }}" class="hover:text-white">Berita</a></li>
          <li><a href="{{ route('public.agenda.index') }}" class="hover:text-white">Agenda</a></li>
          <li><a href="{{ route('public.aparatur.index') }}" class="hover:text-white">Aparatur</a></li>
        </ul>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Ikuti Kami</h3>
        <div class="flex space-x-4">
          <a href="#" class="hover:text-white">Email</a>
          <a href="#" class="hover:text-white">Instagram</a>
          <a href="#" class="hover:text-white">Facebook</a>
          <a href="#" class="hover:text-white">X</a>
        </div>
      </div>
    </div>
    <div class="text-center text-sm bg-gray-900 py-4">
      &copy; {{ date('Y') }} Nagari Sikucua Timur. All rights reserved.
    </div>
  </footer>

</body>
</html>
