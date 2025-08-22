@extends('admin.layouts.admin')

@section('title', 'Confirm Password')

@section('content')
  <div class="max-w-md mx-auto py-12">
    <div class="mb-4 text-sm text-gray-600">
      {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
      @csrf

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
        <input id="password" type="password" name="password" required autocomplete="current-password"
               class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end mt-4">
        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
          {{ __('Confirm') }}
        </button>
      </div>
    </form>
  </div>
@endsection
