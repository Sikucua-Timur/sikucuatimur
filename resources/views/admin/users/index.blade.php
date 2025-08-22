@extends('admin.layouts.admin')
@section('title', 'Manajemen Pengguna')

@section('content')
<div class="mb-6">
  <div class="flex justify-between items-center">
    <h2 class="text-2xl font-bold text-blue-700">Manajemen Pengguna</h2>
    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Tambah User</a>
  </div>
</div>

<div class="overflow-x-auto bg-white shadow rounded">
  <table class="min-w-full text-sm text-left">
    <thead class="bg-gray-100 text-gray-700">
      <tr>
        <th class="px-4 py-2">#</th>
        <th class="px-4 py-2">Nama</th>
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($users as $user)
        <tr class="border-t hover:bg-gray-50">
          <td class="px-4 py-2">{{ $loop->iteration }}</td>
          <td class="px-4 py-2">{{ $user->name }}</td>
          <td class="px-4 py-2">{{ $user->email }}</td>
          <td class="px-4 py-2">
            <div class="flex gap-2 items-center">
              <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
              <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="delete-form inline" data-nama="{{ $user->name }}">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center text-gray-500 py-4 italic">Belum ada pengguna.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.delete-form').forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const nama = form.dataset.nama;

        Swal.fire({
          title: `Hapus pengguna "${nama}"?`,
          text: "Data ini akan dihapus permanen.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal',
          reverseButtons: true
        }).then(result => {
          if (result.isConfirmed) {
            form.submit();
          }
        });

      }); // penutup addEventListener submit
    }); // penutup forEach
  }); // penutup DOMContentLoaded
</script>
@endpush

