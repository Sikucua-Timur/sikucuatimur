@extends('admin.layouts.admin')
@section('title', 'Tambah User')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-blue-700 mb-6">Tambah Pengguna</h2>

  <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label class="block text-gray-700">Nama</label>
      <input type="text" name="name" value="{{ old('name') }}"
             class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
      @error('name') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Email</label>
      <input type="email" name="email" value="{{ old('email') }}"
             class="w-full border rounded p-2 @error('email') border-red-500 @enderror">
      @error('email') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Password</label>
      <input type="password" name="password"
             class="w-full border rounded p-2 @error('password') border-red-500 @enderror">
      @error('password') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-6">
      <label class="block text-gray-700">Konfirmasi Password</label>
      <input type="password" name="password_confirmation"
             class="w-full border rounded p-2">
    </div>

    <div class="flex justify-between">
      <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:underline">← Kembali</a>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </div>
  </form>
</div>
@endsection
