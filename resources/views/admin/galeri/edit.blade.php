@extends('admin.layouts.admin')
@section('title', 'Edit Galeri')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Foto Galeri</h2>
  <form id="editGaleriForm"
        action="{{ route('admin.galeri.update', $galeri) }}"
        method="POST"
        enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.galeri.form', ['galeri' => $galeri])
    
    <div class="mt-6 flex justify-end space-x-2">
      <a href="{{ route('admin.galeri.index') }}"
         class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
      <button type="submit"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Perbarui
      </button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('editGaleriForm');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Yakin ingin menyimpan perubahan?',
      text: 'Detail galeri akan diperbarui.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, simpan!',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      focusCancel: true,
    }).then(result => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
});
</script>
@endpush
