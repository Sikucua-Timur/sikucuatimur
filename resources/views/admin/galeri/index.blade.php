@extends('admin.layouts.admin')
@section('title', 'Galeri')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h2 class="text-2xl font-bold text-blue-700">Data Galeri</h2>
  <a href="{{ route('admin.galeri.create') }}"
     class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Foto</a>
</div>

<div class="overflow-x-auto bg-white rounded shadow">
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      @forelse($galeris as $galeri)
      <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration + ($galeris->currentPage() - 1) * $galeris->perPage() }}</td>
        <td class="px-6 py-4 whitespace-nowrap">
          <img src="{{ asset('storage/'.$galeri->gambar) }}" class="w-20 h-16 object-cover rounded" alt="{{ $galeri->judul }}">
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $galeri->judul }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ Str::limit($galeri->keterangan, 50, '...') }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
          {{ $galeri->tanggal ? $galeri->tanggal->format('d M Y') : '-' }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
          <div class="flex justify-center space-x-4">
            <a href="{{ route('admin.galeri.edit', $galeri) }}" class="text-indigo-600 hover:underline">Edit</a>
            <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" class="delete-galeri-form" data-title="{{ $galeri->judul }}">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data galeri.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $galeris->links() }}
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.delete-galeri-form').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      const title = form.dataset.title;
      Swal.fire({
        title: `Hapus "${title}"?`,
        text: 'Foto akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
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
});
</script>
@endpush
