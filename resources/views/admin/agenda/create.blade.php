@extends('admin.layouts.admin')
@section('title', 'Tambah Agenda')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-blue-700 mb-4">Tambah Agenda</h2>

  <form method="POST" action="{{ route('admin.agenda.store') }}">
    @csrf

    @include('admin.agenda.form', ['agenda' => new \App\Models\Agenda])

    {{-- Tombol Aksi --}}
    <div class="text-right">
      <a href="{{ route('admin.agenda.index') }}"
         class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">
        Batal
      </a>
      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Simpan
      </button>
    </div>
  </form>
</div>
@endsection
