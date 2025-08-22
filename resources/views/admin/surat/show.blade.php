<p><strong>Nama:</strong> {{ $surat->nama }}</p>
<p><strong>Email:</strong> {{ $surat->email }}</p>
<p><strong>Jenis Surat:</strong> {{ $surat->jenis_surat }}</p>
<p><strong>Isi:</strong> {{ $surat->isi }}</p>
<p><strong>Status:</strong> 
  <span class="px-2 py-1 rounded text-white text-sm
    {{ $surat->status === 'pending' ? 'bg-yellow-500' : ($surat->status === 'disetujui' ? 'bg-green-600' : 'bg-red-600') }}">
    {{ ucfirst($surat->status) }}
  </span>
</p>
