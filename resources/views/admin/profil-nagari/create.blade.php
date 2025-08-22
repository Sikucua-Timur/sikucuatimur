@extends('admin.layouts.admin')

@section('title', 'Buat Profil Nagari')

@section('content')
<h1 class="text-2xl font-bold text-blue-700 mb-6">Buat Profil Nagari</h1>

<form action="{{ route('admin.profil-nagari.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.profil-nagari.form', ['profil' => null])
    
    <div class="mt-6">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('admin.dashboard') }}" class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
    </div>
</form>
@endsection