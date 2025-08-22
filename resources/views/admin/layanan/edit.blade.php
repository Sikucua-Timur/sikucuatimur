@extends('admin.layouts.admin')
@section('title', 'Edit Layanan')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-xl font-bold text-blue-700 mb-4">Edit Layanan</h2>

  <form id="editLayananForm"
        action="{{ route('admin.layanan.update', $layanan) }}"
        method="POST"
        enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.layanan.form', ['layanan' => $layanan])
    <div class="flex justify-between mt-6">
      <a href="{{ route('admin.layanan.index') }}"
         class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
        Perbarui
      </button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('editLayananForm');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Yakin ingin memperbarui layanan ini?',
      text: 'Perubahan tidak dapat dibatalkan.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, perbarui!',
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
