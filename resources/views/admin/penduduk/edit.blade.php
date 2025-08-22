@extends('admin.layouts.admin')
@section('title','Edit Penduduk')
@section('content')
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Penduduk</h2>

  <form id="confirmForm" action="{{ route('admin.penduduk.update', $penduduk) }}"
        method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.penduduk.form', ['penduduk' => $penduduk])
    <div class="mt-4 flex justify-end space-x-2">
      <a href="{{ route('admin.penduduk.index') }}"
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
        Batal
      </a>
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Perbarui
      </button>
    </div>
  </form>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('confirmForm');

    form.addEventListener('submit', function (e) {
      e.preventDefault(); // stop native submit

      Swal.fire({
        title: 'Yakin?',
        text: 'Data penduduk akan diperbarui.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, perbarui!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        focusCancel: true,
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit(); // lanjutkan submit
        }
      });
    });
  });
  </script>

  </div>
@endsection
