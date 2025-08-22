@php
    $profil = $profil ?? new \App\Models\ProfilNagari;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Nama Nagari -->
    <div>
        <label for="nama_nagari" class="block font-medium">Nama Nagari</label>
        <input type="text" name="nama_nagari" id="nama_nagari" value="{{ old('nama_nagari', $profil->nama_nagari) }}" required class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Kepala Nagari -->
    <div>
        <label for="kepala_nagari" class="block font-medium">Kepala Nagari</label>
        <input type="text" name="kepala_nagari" id="kepala_nagari" value="{{ old('kepala_nagari', $profil->kepala_nagari) }}" required class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Telepon -->
    <div>
        <label for="telepon" class="block font-medium">Telepon</label>
        <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $profil->telepon) }}" class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block font-medium">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $profil->email) }}" class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Website -->
    <div>
        <label for="website" class="block font-medium">Website</label>
        <input type="text" name="website" id="website" value="{{ old('website', $profil->website) }}" class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Tanggal Berdiri -->
    <div>
        <label for="tanggal_berdiri" class="block font-medium">Tanggal Berdiri</label>
        <input type="date" name="tanggal_berdiri" id="tanggal_berdiri" value="{{ old('tanggal_berdiri', $profil->tanggal_berdiri) }}" class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Luas Wilayah -->
    <div>
        <label for="luas_wilayah" class="block font-medium">Luas Wilayah</label>
        <input type="text" name="luas_wilayah" id="luas_wilayah" value="{{ old('luas_wilayah', $profil->luas_wilayah) }}" class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Jumlah Penduduk -->
    <div>
        <label for="jumlah_penduduk" class="block font-medium">Jumlah Penduduk</label>
        <input type="number" name="jumlah_penduduk" id="jumlah_penduduk" value="{{ old('jumlah_penduduk', $profil->jumlah_penduduk) }}" class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Latitude -->
    <div>
        <label for="latitude" class="block font-medium">Latitude</label>
        <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $profil->latitude) }}" class="w-full border border-gray-300 rounded p-2">
    </div>

    <!-- Longitude -->
    <div>
        <label for="longitude" class="block font-medium">Longitude</label>
        <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $profil->longitude) }}" class="w-full border border-gray-300 rounded p-2">
    </div>
</div>

<div class="mt-4">
    <label for="alamat" class="block font-medium">Alamat</label>
    <textarea name="alamat" id="alamat" rows="3" class="w-full border border-gray-300 rounded p-2">{{ old('alamat', $profil->alamat) }}</textarea>
</div>

<div class="mt-4">
    <label for="visi" class="block font-medium">Visi</label>
    <textarea name="visi" id="visi" rows="3" class="w-full border border-gray-300 rounded p-2">{{ old('visi', $profil->visi) }}</textarea>
</div>

<div class="mt-4">
    <label for="misi" class="block font-medium">Misi</label>
    <textarea name="misi" id="misi" rows="4" class="w-full border border-gray-300 rounded p-2">{{ old('misi', $profil->misi) }}</textarea>
</div>

<div class="mt-4">
    <label for="sejarah" class="block font-medium">Sejarah</label>
    <textarea name="sejarah" id="sejarah" rows="5" class="w-full border border-gray-300 rounded p-2">{{ old('sejarah', $profil->sejarah) }}</textarea>
</div>

<div class="mt-4">
    <label for="logo" class="block font-medium">Logo (gambar)</label>
    <input type="file" name="logo" id="logo" class="w-full border border-gray-300 rounded p-2">
    @if($profil->logo)
        <img src="{{ asset('storage/' . $profil->logo) }}" class="w-24 h-auto mt-2" alt="Logo">
    @endif
</div>

<div class="mt-4">
    <label for="struktur_organisasi" class="block font-medium">Struktur Organisasi (gambar)</label>
    <input type="file" name="struktur_organisasi" id="struktur_organisasi" class="w-full border border-gray-300 rounded p-2">
    @if($profil->struktur_organisasi)
        <img src="{{ asset('storage/' . $profil->struktur_organisasi) }}" class="w-full max-w-md mt-2" alt="Struktur Organisasi">
    @endif
</div>
