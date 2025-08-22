<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12pt; }
    .title { text-align: center; font-size: 16pt; font-weight: bold; margin-bottom: 20px; }
  </style>
</head>
<body>
  <div class="title">Surat Keterangan</div>
  <p>Yang bertanda tangan di bawah ini menyatakan bahwa:</p>
  <ul>
    <li><strong>Nama:</strong> {{ $surat->nama }}</li>
    <li><strong>Email:</strong> {{ $surat->email }}</li>
    <li><strong>Jenis Surat:</strong> {{ $surat->jenis_surat }}</li>
  </ul>

  <p><strong>Isi Permohonan:</strong></p>
  <p>{{ $surat->isi }}</p>

  <p>Status saat ini: <strong>{{ strtoupper($surat->status) }}</strong></p>

  <br><br>
  <p>Hormat Kami,</p>
  <p><strong>Admin Nagari Sikucua Timur</strong></p>
</body>
</html>
