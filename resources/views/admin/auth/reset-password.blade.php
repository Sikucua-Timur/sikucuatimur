@extends('admin.layouts.admin')

@section('title', 'Reset Password')

@section('content')
  <div class="max-w-md mx-auto py-12">
    <form method="POST" action="{{ route('password.store') }}">
      @csrf

      <input type="hidden" name="token" value="{{ request()->route('token') }}">

      <!-- Email Address -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', request()->email) }}" required autofocus
               class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
        @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input id="password" type="password" name="password" required
               class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
        @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      <!-- Confirm Password -->
      <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
               class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
      </div>

      <div class="flex justify-end"> 
        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
          Reset Password
        </button>
      </div>
    </form>
  </div>
@endsection
