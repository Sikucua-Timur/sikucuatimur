<div class="grid gap-4">
  {{-- Judul --}}
  <div>
    <label class="block text-gray-700 font-medium">Judul</label>
    <input type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}"
           class="w-full border rounded p-2 @error('judul') border-red-500 @enderror">
    @error('judul') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
  </div>

  {{-- Keterangan --}}
  <div>
    <label class="block text-gray-700 font-medium">Keterangan</label>
    <textarea name="keterangan" rows="4"
              class="w-full border rounded p-2 @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $galeri->keterangan ?? '') }}</textarea>
    @error('keterangan') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
  </div>

  {{-- Tanggal --}}
  <div>
    <label class="block text-gray-700 font-medium">Tanggal</label>
    <input type="date" name="tanggal"
           value="{{ old('tanggal', isset($galeri->tanggal) ? \Carbon\Carbon::parse($galeri->tanggal)->format('Y-m-d') : '') }}"
           class="w-full border rounded p-2 @error('tanggal') border-red-500 @enderror">
    @error('tanggal') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
  </div>

  {{-- Gambar --}}
  <div>
    <label class="block text-gray-700 font-medium">Gambar</label>
    <input type="file" name="gambar" class="w-full border rounded p-2">
    @error('gambar') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

    @if(!empty($galeri->gambar))
      <img src="{{ asset('storage/'.$galeri->gambar) }}" class="w-32 mt-2 rounded shadow" />
    @endif
  </div>
</div>

