@extends('admin.layouts.admin')

@section('title', 'Verify Email')

@section('content')
  <div class="max-w-md mx-auto py-12">
    <div class="mb-4 text-sm text-gray-600">
      {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
      <div class="mb-4 text-green-600 text-sm">
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
      </div>
    @endif

    <div class="flex items-center justify-between">
      <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
          {{ __('Resend Verification Email') }}
        </button>
      </form>

      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
          {{ __('Log Out') }}
        </button>
      </form>
    </div>
  </div>
@endsection