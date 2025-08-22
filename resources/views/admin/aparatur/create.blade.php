@extends('admin.layouts.admin')
@section('title', 'Tambah Aparatur')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-bold text-blue-700 mb-4">Tambah Aparatur</h2>

  <form action="{{ route('admin.aparatur.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.aparatur.form', ['aparatur' => new \App\Models\Aparatur])
    <div class="text-right mt-6">
      <a href="{{ route('admin.aparatur.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2">Batal</a>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </div>
  </form>
</div>
@endsection
