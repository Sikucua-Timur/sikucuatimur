@extends('admin.layouts.admin')
@section('title', 'Edit Aparatur')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Aparatur</h2>

  <form id="editAparaturForm"
        action="{{ route('admin.aparatur.update', $aparatur) }}"
        method="POST"
        enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Field Nama --}}
    <div class="mb-4">
      <label class="block text-gray-700">Nama</label>
      <input type="text" name="nama"
             value="{{ old('nama', $aparatur->nama) }}"
             class="w-full border rounded p-2"
             required>
    </div>

    {{-- Field NIP --}}
    <div class="mb-4">
      <label class="block text-gray-700">NIP</label>
      <input type="text" name="nip"
             value="{{ old('nip', $aparatur->nip) }}"
             class="w-full border rounded p-2">
    </div>

    {{-- Field Jabatan --}}
    <div class="mb-4">
      <label class="block text-gray-700">Jabatan</label>
      <input type="text" name="jabatan"
             value="{{ old('jabatan', $aparatur->jabatan) }}"
             class="w-full border rounded p-2"
             required>
    </div>

    {{-- Tempat & Tanggal Lahir --}}
    <div class="grid grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block text-gray-700">Tempat Lahir</label>
        <input type="text" name="tempat_lahir"
               value="{{ old('tempat_lahir', $aparatur->tempat_lahir) }}"
               class="w-full border rounded p-2">
      </div>
      <div>
        <label class="block text-gray-700">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir"
               value="{{ old('tanggal_lahir', optional($aparatur->tanggal_lahir)->format('Y-m-d')) }}"
               class="w-full border rounded p-2">
      </div>
    </div>

    {{-- Jenis Kelamin & Agama --}}
    <div class="grid grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block text-gray-700">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="w-full border rounded p-2">
          <option value="">Pilih</option>
          <option value="L" {{ old('jenis_kelamin', $aparatur->jenis_kelamin)=='L' ? 'selected' : '' }}>Laki‑laki</option>
          <option value="P" {{ old('jenis_kelamin', $aparatur->jenis_kelamin)=='P' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>
      <div>
        <label class="block text-gray-700">Agama</label>
        <input type="text" name="agama"
               value="{{ old('agama', $aparatur->agama) }}"
               class="w-full border rounded p-2">
      </div>
    </div>

    {{-- Kontak --}}
    <div class="mb-4">
      <label class="block text-gray-700">No. HP</label>
      <input type="text" name="no_hp"
             value="{{ old('no_hp', $aparatur->no_hp) }}"
             class="w-full border rounded p-2">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700">Email</label>
      <input type="email" name="email"
             value="{{ old('email', $aparatur->email) }}"
             class="w-full border rounded p-2">
    </div>

    {{-- Alamat & Pendidikan --}}
    <div class="mb-4">
      <label class="block text-gray-700">Alamat</label>
      <textarea name="alamat" rows="3" class="w-full border rounded p-2">{{ old('alamat', $aparatur->alamat) }}</textarea>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700">Pendidikan</label>
      <input type="text" name="pendidikan"
             value="{{ old('pendidikan', $aparatur->pendidikan) }}"
             class="w-full border rounded p-2">
    </div>

    {{-- Foto --}}
    <div class="mb-4">
      <label class="block text-gray-700">Foto (opsional)</label>
      <input type="file" name="foto" class="w-full border p-2 rounded">
      @if($aparatur->foto)
        <img src="{{ asset('storage/'.$aparatur->foto) }}"
             class="h-20 mt-2 rounded shadow" alt="Foto">
      @endif
    </div>

    {{-- Status --}}
    <div class="mb-4">
      <label class="block text-gray-700">Status Aktif</label>
      <select name="is_aktif" class="w-full border rounded p-2">
        <option value="1" {{ old('is_aktif', $aparatur->is_aktif) ? 'selected' : '' }}>Aktif</option>
        <option value="0" {{ old('is_aktif', $aparatur->is_aktif)==0 ? 'selected' : '' }}>Nonaktif</option>
      </select>
    </div>

    {{-- Tombol --}}
    <div class="text-right mt-6">
      <a href="{{ route('admin.aparatur.index') }}"
         class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">
        Batal
      </a>
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
  const btn = document.getElementById('confirmUpdateBtn');
  const form = document.getElementById('editAparaturForm');

  if (btn && form) {
    btn.addEventListener('click', function () {
      Swal.fire({
        title: 'Yakin ingin menyimpan perubahan?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan!',
        cancelButtonText: 'Batal',
        reverseButtons: true
      }).then(result => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  } else {
    console.warn('Element tidak ditemukan:', { btn, form });
  }
});
</script>
@endpush

