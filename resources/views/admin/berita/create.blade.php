@extends('admin.layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<h1 class="text-2xl font-bold text-blue-700 mb-6">Tambah Berita</h1>

<form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('admin.berita.form')

    <div class="mt-6 flex justify-between">
        <a href="{{ route('admin.berita.index') }}" 
           class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
           Batal
        </a>
        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Simpan
        </button>
    </div>
</form>
@endsection
