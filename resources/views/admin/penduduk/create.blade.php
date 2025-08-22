@extends('admin.layouts.admin')
@section('title','Tambah Penduduk')
@section('content')
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Tambah Penduduk</h2>

    <form action="{{ route('admin.penduduk.store') }}" method="POST">
      @csrf
      @include('admin.penduduk.form', ['penduduk' => null])

      <div class="mt-4 flex justify-end space-x-2">
        <a href="{{ route('admin.penduduk.index') }}"
           class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
          Batal
        </a>
        <button type="submit"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Simpan
        </button>
      </div>
    </form>
  </div>
@endsection
