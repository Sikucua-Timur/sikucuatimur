<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <div>
    <label class="block text-gray-700">Nama</label>
    <input type="text" name="nama" value="{{ old('nama', $aparatur->nama) }}" class="w-full border rounded p-2" required>
  </div>
  <div>
    <label class="block text-gray-700">NIP</label>
    <input type="text" name="nip" value="{{ old('nip', $aparatur->nip) }}" class="w-full border rounded p-2">
  </div>
  <div>
    <label class="block text-gray-700">Jabatan</label>
    <input type="text" name="jabatan" value="{{ old('jabatan', $aparatur->jabatan) }}" class="w-full border rounded p-2" required>
  </div>
  <div>
    <label class="block text-gray-700">Tempat Lahir</label>
    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $aparatur->tempat_lahir) }}" class="w-full border rounded p-2">
  </div>
  <div>
    <label class="block text-gray-700">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($aparatur->tanggal_lahir)->format('Y-m-d')) }}" class="w-full border rounded p-2">
  </div>
  <div>
    <label class="block text-gray-700">Jenis Kelamin</label>
    <select name="jenis_kelamin" class="w-full border rounded p-2">
      <option value="">-</option>
      <option value="L" {{ old('jenis_kelamin', $aparatur->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
      <option value="P" {{ old('jenis_kelamin', $aparatur->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
  </div>
  <div>
    <label class="block text-gray-700">Agama</label>
    <input type="text" name="agama" value="{{ old('agama', $aparatur->agama) }}" class="w-full border rounded p-2">
  </div>
  <div>
    <label class="block text-gray-700">No. HP</label>
    <input type="text" name="no_hp" value="{{ old('no_hp', $aparatur->no_hp) }}" class="w-full border rounded p-2">
  </div>
  <div>
    <label class="block text-gray-700">Email</label>
    <input type="email" name="email" value="{{ old('email', $aparatur->email) }}" class="w-full border rounded p-2">
  </div>
  <div>
    <label class="block text-gray-700">Alamat</label>
    <textarea name="alamat" rows="2" class="w-full border rounded p-2">{{ old('alamat', $aparatur->alamat) }}</textarea>
  </div>
  <div>
    <label class="block text-gray-700">Pendidikan</label>
    <input type="text" name="pendidikan" value="{{ old('pendidikan', $aparatur->pendidikan) }}" class="w-full border rounded p-2">
  </div>
  <div>
    <label class="block text-gray-700">Foto</label>
    <input type="file" name="foto" class="w-full border p-2 rounded">
    @if($aparatur->foto)
      <img src="{{ asset('storage/' . $aparatur->foto) }}" class="h-20 mt-2 rounded shadow">
    @endif
  </div>
  <div>
    <label class="block text-gray-700">Status</label>
    <select name="is_aktif" class="w-full border rounded p-2">
      <option value="1" {{ old('is_aktif', $aparatur->is_aktif) ? 'selected' : '' }}>Aktif</option>
      <option value="0" {{ old('is_aktif', $aparatur->is_aktif) == 0 ? 'selected' : '' }}>Nonaktif</option>
    </select>
  </div>
</div>
