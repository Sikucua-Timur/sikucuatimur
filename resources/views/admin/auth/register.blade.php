@extends('admin.layouts.admin')

@section('title', 'Admin Register')

@section('content')
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
      <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Daftar Admin Baru</h2>
      <form method="POST" action="{{ route('admin.register.store') }}" class="space-y-4">
        @csrf
        <!-- Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                 class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
          @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required
                 class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
          @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input id="password" type="password" name="password" required
                 class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
          @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
          <input id="password_confirmation" type="password" name="password_confirmation" required
                 class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
        </div>
        <div class="flex justify-end mt-4">
          <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
            Daftar
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
