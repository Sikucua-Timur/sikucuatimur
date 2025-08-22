@extends('admin.layouts.admin')
@section('title', 'Data Aparatur')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold text-blue-700">Data Aparatur</h2>
  <a href="{{ route('admin.aparatur.create') }}"
     class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
    Tambah Aparatur
  </a>
</div>

<div class="overflow-x-auto bg-white rounded shadow">
  <table class="min-w-full text-sm text-left">
    <thead class="bg-gray-100 text-gray-700">
      <tr>
        <th class="px-3 py-2">#</th>
        <th class="px-3 py-2">Foto</th>
        <th class="px-3 py-2">Nama</th>
        <th class="px-3 py-2">NIP</th>
        <th class="px-3 py-2">Jabatan</th>
        <th class="px-3 py-2">TTL</th>
        <th class="px-3 py-2">JK</th>
        <th class="px-3 py-2">Agama</th>
        <th class="px-3 py-2">HP</th>
        <th class="px-3 py-2">Email</th>
        <th class="px-3 py-2">Pendidikan</th>
        <th class="px-3 py-2">Status</th>
        <th class="px-3 py-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($aparatur as $item)
        <tr class="border-t hover:bg-gray-50">
          <td class="px-3 py-2">{{ $loop->iteration }}</td>
          <td class="px-3 py-2">
            @if($item->foto)
              <img src="{{ asset('storage/'.$item->foto) }}" class="h-8 w-8 rounded-full object-cover" alt="">
            @else
              <div class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center text-xs text-gray-400">N/A</div>
            @endif
          </td>
          <td class="px-3 py-2">{{ $item->nama }}</td>
          <td class="px-3 py-2">{{ $item->nip ?? '-' }}</td>
          <td class="px-3 py-2">{{ $item->jabatan }}</td>
          <td class="px-3 py-2">
            {{ $item->tempat_lahir ?? '-' }},
            {{ optional($item->tanggal_lahir)->format('d-m-Y') ?? '-' }}
          </td>
          <td class="px-3 py-2">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : ($item->jenis_kelamin=='P'?'Perempuan':'-') }}</td>
          <td class="px-3 py-2">{{ $item->agama ?? '-' }}</td>
          <td class="px-3 py-2">{{ $item->no_hp ?? '-' }}</td>
          <td class="px-3 py-2">{{ $item->email ?? '-' }}</td>
          <td class="px-3 py-2">{{ $item->pendidikan ?? '-' }}</td>
          <td class="px-3 py-2">
            <span class="text-xs px-2 py-1 rounded {{ $item->is_aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
              {{ $item->is_aktif ? 'Aktif' : 'Nonaktif' }}
            </span>
          </td>
          <td class="px-3 py-2">
            <div class="flex items-center gap-2">
              <a href="{{ route('admin.aparatur.edit', $item) }}"
                 class="text-blue-600 hover:underline text-sm">Edit</a>
              <form action="{{ route('admin.aparatur.destroy', $item) }}"
                    method="POST"
                    class="delete-form inline"
                    data-nama="{{ $item->nama }}">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="14" class="p-4 text-center text-gray-500 italic">
            Belum ada data aparatur.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const nama = form.dataset.nama;
      Swal.fire({
        title: `Hapus "${nama}"?`,
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
    });
  });
});
</script>
@endpush
