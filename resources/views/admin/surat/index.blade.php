@extends('admin.layouts.admin')
@section('title', 'Data Surat Masuk')

@section('content')
<div class="mb-4">
  <h2 class="text-2xl font-bold text-blue-700">Surat Masuk</h2>
</div>

@if(session('success'))
  <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
@endif

<table class="w-full table-auto border">
  <thead class="bg-gray-100">
    <tr>
      <th class="p-2">#</th>
      <th class="p-2">Nama</th>
      <th class="p-2">Email</th>
      <th class="p-2">Jenis Surat</th>
      <th class="p-2">Status</th>
      <th class="p-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($surats as $surat)
      <tr class="border-t hover:bg-gray-50">
        <td class="p-2">{{ $loop->iteration }}</td>
        <td class="p-2">{{ $surat->nama }}</td>
        <td class="p-2">{{ $surat->email }}</td>
        <td class="p-2">{{ $surat->jenis_surat }}</td>
        <td class="p-2">
          <span class="px-2 py-1 rounded text-white text-sm
            {{ $surat->status === 'pending' ? 'bg-yellow-500' : ($surat->status === 'disetujui' ? 'bg-green-600' : 'bg-red-600') }}">
            {{ ucfirst($surat->status) }}
          </span>
        </td>
        <td class="p-2 flex gap-2">
          <a href="{{ route('admin.surat.show', $surat) }}" class="text-blue-600">Lihat</a>
          <form action="{{ route('admin.surat.destroy', $surat) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-600">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6" class="text-center text-gray-500 py-4">Belum ada surat masuk.</td>
      </tr>
    @endforelse
  </tbody>
</table>

<div class="mt-4">
  {{ $surats->links() }} {{-- Pagination --}}
</div>
@endsection
