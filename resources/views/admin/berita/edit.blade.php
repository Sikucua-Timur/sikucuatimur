@extends('admin.layouts.admin')
@section('title', 'Edit Berita')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Berita</h2>

  <form id="editBeritaForm"
        action="{{ route('admin.berita.update', ['beritum' => $berita->id]) }}"
        method="POST"
        enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('admin.berita.form', ['berita' => $berita])

    <div class="mt-6 flex justify-between">
      <a href="{{ route('admin.berita.index') }}"
         class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
        Batal
      </a>

      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Perbarui
      </button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('editBeritaForm');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Yakin ingin memperbarui berita ini?',
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
