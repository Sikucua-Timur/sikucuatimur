@extends('admin.layouts.admin')

@section('title', 'Edit Profil Nagari')

@section('content')
  <h1 class="text-2xl font-bold text-blue-700 mb-6">Edit Profil Nagari</h1>

  <form id="profilForm" action="{{ route('admin.profil-nagari.update', $profil->id) }}"
        method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @include('admin.profil-nagari.form', ['profil' => $profil])

      <div class="mt-6">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Perbarui
          </button>
          <a href="{{ route('admin.dashboard') }}"
             class="ml-3 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
      </div>
  </form>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('profilForm');

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      Swal.fire({
        title: 'Yakin ingin memperbarui Profil Nagari?',
        text: 'Perubahan akan tersimpan permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, perbarui!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        focusCancel: true,
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
</script>
@endpush