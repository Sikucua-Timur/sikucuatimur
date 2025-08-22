{{-- admin/agenda/form.blade.php --}}
<div class="mb-4">
  <label class="block text-gray-700">Judul</label>
  <input type="text" name="judul" value="{{ old('judul', $agenda->judul) }}"
         class="w-full border rounded p-2" required>
</div>

<div class="mb-4">
  <label class="block text-gray-700">Tanggal</label>
  <input type="date" name="tanggal"
         value="{{ old('tanggal', optional($agenda->tanggal)->format('Y-m-d')) }}"
         class="w-full border rounded p-2" required>
</div>

<div class="mb-4">
  <label class="block text-gray-700">Lokasi</label>
  <input type="text" name="lokasi" value="{{ old('lokasi', $agenda->lokasi) }}"
         class="w-full border rounded p-2">
</div>

<div class="mb-4">
  <label class="block text-gray-700">Deskripsi</label>
  <textarea name="deskripsi" rows="5"
            class="w-full border rounded p-2">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
</div>
