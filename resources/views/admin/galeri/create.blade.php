@extends('admin.layouts.admin')
@section('title', 'Tambah Galeri')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-blue-700 mb-4">Tambah Foto Galeri</h2>

  <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.galeri.form', ['galeri' => null])

    {{-- Tombol Aksi --}}
    <div class="mt-6 flex justify-end space-x-2">
      <a href="{{ route('admin.galeri.index') }}"
         class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
        Batal
      </a>
      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
        Simpan
      </button>
    </div>
  </form>
</div>
@endsection
