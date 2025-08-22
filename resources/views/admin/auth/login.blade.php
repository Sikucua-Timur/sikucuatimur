@extends('admin.layouts.admin')

@section('title', 'Admin Login')

@section('content')
  <div class="flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
      <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Masuk Admin Sikucua Timur</h2>

      @if (session('status'))
        <div class="mb-4 text-green-600 text-sm">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4">
        @csrf

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input id="email" type="email" name="email" required autofocus
                 class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
          @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input id="password" type="password" name="password" required
                 class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
          @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
          <button type="submit" class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
            Masuk
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection