@php
    /** @var \App\Models\Penduduk|null $penduduk */
@endphp

<div class="grid grid-cols-1 gap-4">
  {{-- Nama --}}
  <div>
    <label for="nama" class="block text-gray-700 font-medium">Nama <span class="text-red-500">*</span></label>
    <input
      id="nama"
      type="text"
      name="nama"
      value="{{ old('nama', $penduduk->nama ?? '') }}"
      required
      class="w-full border rounded p-2 @error('nama') border-red-500 @enderror"
    >
    @error('nama')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- NIK --}}
  <div>
    <label for="nik" class="block text-gray-700 font-medium">NIK <span class="text-red-500">*</span></label>
    <input
      id="nik"
      type="text"
      name="nik"
      value="{{ old('nik', $penduduk->nik ?? '') }}"
      required
      class="w-full border rounded p-2 @error('nik') border-red-500 @enderror"
    >
    @error('nik')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- No. KK --}}
  <div>
    <label for="kk" class="block text-gray-700 font-medium">No. KK</label>
    <input
      id="kk"
      type="text"
      name="kk"
      value="{{ old('kk', $penduduk->kk ?? '') }}"
      class="w-full border rounded p-2 @error('kk') border-red-500 @enderror"
    >
    @error('kk')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- Alamat --}}
  <div>
    <label for="alamat" class="block text-gray-700 font-medium">Alamat</label>
    <textarea
      id="alamat"
      name="alamat"
      rows="3"
      class="w-full border rounded p-2 @error('alamat') border-red-500 @enderror"
    >{{ old('alamat', $penduduk->alamat ?? '') }}</textarea>
    @error('alamat')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- Tempat & Tanggal Lahir --}}
  <div class="grid grid-cols-2 gap-4">
    <div>
      <label for="tempat_lahir" class="block text-gray-700 font-medium">Tempat Lahir</label>
      <input
        id="tempat_lahir"
        type="text"
        name="tempat_lahir"
        value="{{ old('tempat_lahir', $penduduk->tempat_lahir ?? '') }}"
        class="w-full border rounded p-2 @error('tempat_lahir') border-red-500 @enderror"
      >
      @error('tempat_lahir')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label for="tanggal_lahir" class="block text-gray-700 font-medium">Tanggal Lahir</label>
      <input
        id="tanggal_lahir"
        type="date"
        name="tanggal_lahir"
        value="{{ old('tanggal_lahir', isset($penduduk) && $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->format('Y-m-d') : '') }}"
        class="w-full border rounded p-2 @error('tanggal_lahir') border-red-500 @enderror"
      >
      @error('tanggal_lahir')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
  </div>

  {{-- Jenis Kelamin --}}
  <div>
    <label for="jenis_kelamin" class="block text-gray-700 font-medium">Jenis Kelamin <span class="text-red-500">*</span></label>
    <select
      id="jenis_kelamin"
      name="jenis_kelamin"
      required
      class="w-full border rounded p-2 @error('jenis_kelamin') border-red-500 @enderror"
    >
      <option value="">-- Pilih --</option>
      <option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>Laki‑laki</option>
      <option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
    @error('jenis_kelamin')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- Agama --}}
  <div>
    <label for="agama" class="block text-gray-700 font-medium">Agama</label>
    <input
      id="agama"
      type="text"
      name="agama"
      value="{{ old('agama', $penduduk->agama ?? '') }}"
      class="w-full border rounded p-2 @error('agama') border-red-500 @enderror"
    >
    @error('agama')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- Pekerjaan --}}
  <div>
    <label for="pekerjaan" class="block text-gray-700 font-medium">Pekerjaan</label>
    <input
      id="pekerjaan"
      type="text"
      name="pekerjaan"
      value="{{ old('pekerjaan', $penduduk->pekerjaan ?? '') }}"
      class="w-full border rounded p-2 @error('pekerjaan') border-red-500 @enderror"
    >
    @error('pekerjaan')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
  </div>
</div>
