@extends('admin.layouts.admin')
@section('title', 'Data Layanan')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold text-blue-700">Data Layanan</h2>
  <div class="flex gap-2">
    <a href="{{ route('admin.layanan.export.csv') }}"
       class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-2 rounded text-sm">
      Export CSV
    </a>
    <a href="{{ route('admin.layanan.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
      Tambah Layanan
    </a>
  </div>
</div>

<div class="bg-white rounded shadow overflow-x-auto" style="overflow-y: hidden;">
  <table class="min-w-full divide-y text-sm text-left">
    <thead class="bg-gray-100 text-gray-700">
      <tr>
        <th class="px-4 py-2 text-center">#</th>
        <th class="px-4 py-2 text-center">Ikon</th>
        <th class="px-4 py-2">Nama</th>
        <th class="px-4 py-2">Kategori</th>
        <th class="px-4 py-2">Waktu</th>
        <th class="px-4 py-2 text-center">Status</th>
        <th class="px-4 py-2 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($layanans as $layanan)
        <tr class="border-t hover:bg-gray-50">
          <!-- Nomor -->
          <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>

          <!-- Ikon -->
          <td class="px-4 py-2 text-center">
            @if($layanan->ikon)
              <img src="{{ asset('storage/' . $layanan->ikon) }}"
                   class="inline-block w-6 h-6 object-contain" alt="Ikon Layanan">
            @else
              <span class="text-gray-400">—</span>
            @endif
          </td>

          <!-- Nama -->
          <td class="px-4 py-2">{{ $layanan->nama }}</td>

          <!-- Kategori -->
          <td class="px-4 py-2">{{ $layanan->kategori }}</td>

          <!-- Waktu Layanan -->
          <td class="px-4 py-2">{{ $layanan->waktu_layanan }}</td>

          <!-- Status -->
          <td class="px-4 py-2 text-center">
            <span class="text-xs px-2 py-1 rounded {{ $layanan->status_aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
              {{ $layanan->status_aktif ? 'Aktif' : 'Nonaktif' }}
            </span>
          </td>

          <!-- Aksi -->
          <td class="px-4 py-2 text-center">
            <div class="flex justify-center gap-2">
              <a href="{{ route('admin.layanan.edit', $layanan) }}"
                 class="text-blue-600 hover:underline text-sm">Edit</a>
              <form action="{{ route('admin.layanan.destroy', $layanan) }}"
                    method="POST"
                    class="delete-layanan-form inline"
                    data-name="{{ $layanan->nama }}">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-gray-500 py-6">
            Belum ada data layanan.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-6">
  {{ $layanans->links() }}
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.delete-layanan-form').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      const name = form.dataset.name;
      Swal.fire({
        title: `Hapus layanan "${name}"?`,
        text: 'Data layanan akan dihapus permanen.',
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
