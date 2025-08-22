@extends('admin.layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-blue-700 mb-6">Edit Pengguna</h2>

  <form id="editUserForm" action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-4">
      <label class="block text-gray-700">Nama</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}"
             class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
      @error('name') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}"
             class="w-full border rounded p-2 @error('email') border-red-500 @enderror">
      @error('email') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Password Baru (Opsional)</label>
      <input type="password" name="password"
             class="w-full border rounded p-2 @error('password') border-red-500 @enderror">
      @error('password') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
      <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti password.</p>
    </div>

    <div class="mb-6">
      <label class="block text-gray-700">Konfirmasi Password</label>
      <input type="password" name="password_confirmation"
             class="w-full border rounded p-2">
    </div>

    <div class="text-right">
      <button type="button" id="confirmUpdateBtn"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Perbarui
      </button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const updateBtn = document.getElementById('confirmUpdateBtn');
  const form = document.getElementById('editUserForm');

  if (updateBtn && form) {
    updateBtn.addEventListener('click', function () {
      Swal.fire({
        title: 'Simpan Perubahan?',
        text: "Data pengguna akan diperbarui.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan!',
        cancelButtonText: 'Batal',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  }
});
</script>
@endpush
