<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name') . ' Admin')</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased flex flex-col min-h-screen">
  {{-- Header --}}
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-4">
      <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-indigo-600">
        {{ config('app.name', 'Nagari') }} Admin
      </a>
      @auth
      <div>
        <span class="text-gray-700 mr-4">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
          @csrf
          <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
        </form>
      </div>
      @endauth
  </header>

  {{-- Main --}}
  <main class="flex-grow">
    {{-- Hero Section for Admin --}}
    <section class="bg-indigo-600 text-white py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold">@yield('title')</h1>
      </div>
    </section>

    {{-- Content Section --}}
    <section class="py-10 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @yield('content')
      </div>
    </section>
  </main>

  {{-- Footer --}}
  <footer class="bg-white border-t py-4 text-center text-gray-500">
    &copy; {{ date('Y') }} {{ config('app.name', 'Nagari Sikucua Timur') }} Admin Panel
  </footer>
  
  @stack('scripts')
</body>
</html>