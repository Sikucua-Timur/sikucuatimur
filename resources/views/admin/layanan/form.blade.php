@php $layanan = $layanan ?? null; @endphp

<div class="grid gap-4">
  <div>
    <label class="text-gray-700">Nama Layanan</label>
    <input type="text" name="nama" value="{{ old('nama', $layanan->nama ?? '') }}"
           class="w-full border rounded p-2 @error('nama') border-red-500 @enderror">
    @error('nama') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="text-gray-700">Deskripsi</label>
    <textarea name="deskripsi" rows="3" class="w-full border rounded p-2 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="text-gray-700">Syarat</label>
    <textarea name="syarat" rows="3" class="w-full border rounded p-2 @error('syarat') border-red-500 @enderror">{{ old('syarat', $layanan->syarat ?? '') }}</textarea>
    @error('syarat') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="text-gray-700">Waktu Layanan</label>
      <input type="text" name="waktu_layanan" value="{{ old('waktu_layanan', $layanan->waktu_layanan ?? '') }}"
             class="w-full border rounded p-2">
    </div>

    <div>
      <label class="text-gray-700">Kategori</label>
      <input type="text" name="kategori" value="{{ old('kategori', $layanan->kategori ?? '') }}"
             class="w-full border rounded p-2">
    </div>

    <div>
      <label class="text-gray-700">Status Aktif</label>
      <select name="status_aktif" class="w-full border rounded p-2">
        <option value="1" {{ old('status_aktif', $layanan->status_aktif ?? '') == 1 ? 'selected' : '' }}>Aktif</option>
        <option value="0" {{ old('status_aktif', $layanan->status_aktif ?? '') == 0 ? 'selected' : '' }}>Nonaktif</option>
      </select>
    </div>

    <div>
      <label class="text-gray-700">Ikon Layanan</label>
      <input type="file" name="ikon" class="w-full border rounded p-2">
      @error('ikon') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

      @if(!empty($layanan->ikon))
        <img src="{{ asset('storage/'.$layanan->ikon) }}" class="w-20 mt-2 rounded shadow" />
      @endif
    </div>
  </div>
</div>
