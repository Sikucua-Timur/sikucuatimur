@extends('admin.layouts.admin')
@section('title', 'Data Penduduk')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
  <h1 class="text-xl font-bold text-blue-800">Data Penduduk</h1>
  <a href="{{ route('admin.penduduk.create') }}"
     class="mt-4 md:mt-0 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
    Tambah Penduduk
  </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
  <table class="min-w-full text-xs text-left">
    <thead class="bg-gray-50 text-gray-700 font-semibold">
      <tr>
        <th class="p-2">#</th>
        <th class="p-2">Nama</th>
        <th class="p-2">NIK</th>
        <th class="p-2">KK</th>
        <th class="p-2">Alamat</th>
        <th class="p-2">Tempat Lahir</th>
        <th class="p-2">Tgl Lahir</th>
        <th class="p-2">JK</th>
        <th class="p-2">Agama</th>
        <th class="p-2">Pekerjaan</th>
        <th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($penduduks as $penduduk)
        <tr class="border-t hover:bg-gray-50">
          <td class="p-2">{{ $loop->iteration + ($penduduks->currentPage() - 1) * $penduduks->perPage() }}</td>
          <td class="p-2">{{ $penduduk->nama }}</td>
          <td class="p-2">{{ $penduduk->nik }}</td>
          <td class="p-2">{{ $penduduk->kk }}</td>
          <td class="p-2">{{ $penduduk->alamat }}</td>
          <td class="p-2">{{ $penduduk->tempat_lahir }}</td>
          <td class="p-2">{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d-m-Y') }}</td>
          <td class="p-2">{{ $penduduk->jenis_kelamin }}</td>
          <td class="p-2">{{ $penduduk->agama }}</td>
          <td class="p-2">{{ $penduduk->pekerjaan }}</td>
          <td class="p-2 whitespace-nowrap space-x-2">
              <a href="{{ route('admin.penduduk.edit', $penduduk) }}" class="text-indigo-600 hover:underline">Edit</a>
              <form action="{{ route('admin.penduduk.destroy', $penduduk) }}"
                    method="POST"
                    class="inline delete-form"
                    data-name="{{ $penduduk->nama }}">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="11" class="p-4 text-center text-gray-500">Belum ada data penduduk.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $penduduks->links() }}
  </div>
  @endsection

  @push('scripts')
  <!-- pastikan SweetAlert2 sudah di-include di layout -->
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    // intercept delete forms
    document.querySelectorAll('.delete-form').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        const name = form.getAttribute('data-name');
        Swal.fire({
          title: `Hapus ${name}?`,
          text: 'Data ini akan dihapus permanen.',
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

    // toast notifikasi from session
    @if(session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
      });
    @endif
  });
  </script>
  @endpush