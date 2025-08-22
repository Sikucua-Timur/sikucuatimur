@extends('admin.layouts.admin')
@section('title', 'Data Berita')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
  <h1 class="text-2xl font-bold text-blue-800">Data Berita</h1>
  <a href="{{ route('admin.berita.create') }}"
     class="mt-4 md:mt-0 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
    Tambah Berita
  </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
  <table class="min-w-full text-sm text-left">
    <thead class="bg-gray-50 text-gray-700 font-semibold">
      <tr>
        <th class="p-3">#</th>
        <th class="p-3">Gambar</th>
        <th class="p-3">Judul</th>
        <th class="p-3">Slug</th>
        <th class="p-3">Konten</th>
        <th class="p-3">Penulis</th>
        <th class="p-3">Tgl. Publish</th>
        <th class="p-3">Dibuat</th>
        <th class="p-3">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($beritas as $berita)
        <tr class="border-t hover:bg-gray-50">
          <td class="p-3">{{ $loop->iteration + ($beritas->currentPage() - 1) * $beritas->perPage() }}</td>
          <td class="p-3">
            @if($berita->gambar)
              <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-16 h-12 object-cover rounded" />
            @else
              <span class="text-gray-400">—</span>
            @endif
          </td>
          <td class="p-3 font-medium text-blue-700">{{ $berita->judul }}</td>
          <td class="p-3 text-xs text-gray-600">{{ $berita->slug }}</td>
          <td class="p-3">{{ Str::limit(strip_tags($berita->konten), 50, '...') }}</td>
          <td class="p-3">{{ $berita->penulis ?? '—' }}</td>
          <td class="p-3">{{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d M Y') : '—' }}</td>
          <td class="p-3 text-gray-500">{{ $berita->created_at->format('d M Y') }}</td>
          <td class="p-3 whitespace-nowrap space-x-2">
            <a href="{{ route('admin.berita.edit', $berita) }}"
               class="text-indigo-600 hover:underline">Edit</a>
            <form action="{{ route('admin.berita.destroy', $berita) }}"
                  method="POST"
                  class="inline delete-berita-form"
                  data-title="{{ $berita->judul }}">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="9" class="p-4 text-center text-gray-500">Belum ada data berita.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-6">
  {{ $beritas->links() }}
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.delete-berita-form').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      const title = form.getAttribute('data-title');
      Swal.fire({
        title: `Hapus "${title}"?`,
        text: 'Data akan dihapus permanen.',
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
