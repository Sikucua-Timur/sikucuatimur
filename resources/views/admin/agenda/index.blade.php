@extends('admin.layouts.admin')
@section('title', 'Agenda')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h1 class="text-2xl font-bold text-blue-800">Daftar Agenda</h1>
  <a href="{{ route('admin.agenda.create') }}"
     class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
    Tambah Agenda
  </a>
</div>

<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full text-sm text-left">
    <thead class="bg-gray-100 text-gray-700 font-semibold">
      <tr>
        <th class="p-3">#</th>
        <th class="p-3">Judul</th>
        <th class="p-3">Tanggal</th>
        <th class="p-3">Lokasi</th>
        <th class="p-3">Deskripsi</th>
        <th class="p-3 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($agendas as $agenda)
        <tr class="border-t hover:bg-gray-50">
          <td class="p-3">{{ $loop->iteration + ($agendas->currentPage() - 1) * $agendas->perPage() }}</td>
          <td class="p-3 border">{{ $agenda->judul }}</td>
          <td class="p-3 border">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</td>
          <td class="p-3 border">{{ $agenda->lokasi ?? '-' }}</td>
          <td class="p-3 border">{{ Str::limit($agenda->deskripsi, 50, '...') }}</td>
          <td class="p-3 border text-center space-x-2">
            <a href="{{ route('admin.agenda.edit', $agenda) }}"
               class="text-indigo-600 hover:underline">Edit</a>
            <form action="{{ route('admin.agenda.destroy', $agenda) }}"
                  method="POST"
                  class="inline delete-agenda-form"
                  data-title="{{ $agenda->judul }}">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data agenda.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $agendas->links() }}
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.delete-agenda-form').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      const title = form.dataset.title;
      Swal.fire({
        title: `Hapus agenda "${title}"?`,
        text: 'Data agenda akan dihapus permanen.',
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

