@extends('admin.layouts.admin')
@section('title', 'Tambah Layanan')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-bold text-blue-700 mb-4">Tambah Layanan</h2>

  <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.layanan.form')
    <div class="flex justify-between mt-6">
      <a href="{{ route('admin.layanan.index') }}"
         class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">Simpan</button>
    </div>
  </form>
</div>
@endsection
