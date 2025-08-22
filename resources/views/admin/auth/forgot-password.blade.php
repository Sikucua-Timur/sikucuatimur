@extends('admin.layouts.admin')

@section('title', 'Forgot Password')

@section('content')
  <div class="max-w-md mx-auto py-12">
    <div class="mb-4 text-sm text-gray-600">
      {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    @if (session('status'))
      <div class="mb-4 text-green-600 text-sm">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <!-- Email Address -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full mt-1 p-2 border rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none" />
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end mt-4">
        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
          {{ __('Email Password Reset Link') }}
        </button>
      </div>
    </form>
  </div>
@endsection