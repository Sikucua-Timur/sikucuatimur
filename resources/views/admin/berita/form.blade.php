<div class="grid gap-4">
  <div>
    <label class="block text-gray-700">Judul</label>
    <input type="text" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" class="w-full border rounded p-2">
  </div>

  <div>
    <label class="block text-gray-700">Konten</label>
    <textarea id="konten" name="konten" rows="10" class="w-full border rounded p-2">{{ old('konten', $berita->konten ?? '') }}</textarea>
  </div>

  <div>
    <label class="block text-gray-700">Gambar (Featured)</label>
    <input type="file" name="gambar" accept="image/*" class="w-full border rounded p-2">
    @if(!empty($berita->gambar))
      <div class="mt-2">
        <img src="{{ asset('storage/'.$berita->gambar) }}" class="w-32 rounded" alt="gambar berita">
      </div>
    @endif
    <p class="text-xs text-gray-500 mt-1">Gambar featured akan ditampilkan di daftar / header berita. Untuk memasukkan gambar di dalam paragraf gunakan tombol upload di editor.</p>
  </div>

  <div>
    <label class="block text-gray-700">Penulis</label>
    <input type="text" name="penulis" value="{{ old('penulis', $berita->penulis ?? '') }}" class="w-full border rounded p-2">
  </div>

  <div>
    <label class="block text-gray-700">Tanggal Publish</label>
    <input type="datetime-local" name="tanggal_publish" value="{{ old('tanggal_publish', isset($berita->tanggal_publish) ? $berita->tanggal_publish->format('Y-m-d\TH:i') : '') }}" class="w-full border rounded p-2">
  </div>
</div>

<style>
/* Membuat paragraf dalam editor menjadi rata kanan-kiri */
.ck-editor__editable_inline .ck-content p,
.ck-editor__editable .ck-content p {
  text-align: justify;
  text-justify: inter-word; /* agar kata ter-justify lebih rapi di beberapa browser */
  /* jika ingin menambah jarak antar kata ketika justify, bisa pakai:
     word-spacing: 0.02em; */
}
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

  // Resize image di browser sebelum upload
  function resizeImage(file, maxWidth) {
    return new Promise(resolve => {
      const img = new Image();
      const reader = new FileReader();
      reader.onload = e => img.src = e.target.result;
      img.onload = () => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        const scale = maxWidth / img.width;
        const width = img.width > maxWidth ? maxWidth : img.width;
        const height = img.width > maxWidth ? img.height * scale : img.height;

        canvas.width = width;
        canvas.height = height;
        ctx.drawImage(img, 0, 0, width, height);

        canvas.toBlob(blob => {
          resolve(new File([blob], file.name, { type: file.type }));
        }, file.type);
      };
      reader.readAsDataURL(file);
    });
  }

  class MyUploadAdapter {
    constructor(loader) {
      this.loader = loader;
      this.url = '{{ route("admin.ckeditor.upload") }}';
      this._token = '{{ csrf_token() }}';
    }

    upload() {
      return this.loader.file
        .then(file => resizeImage(file, 800)) // max width 800px
        .then(resizedFile => new Promise((resolve, reject) => {
          this._initRequest();
          this._initListeners(resolve, reject, resizedFile);
          this._sendRequest(resizedFile);
        }));
    }

    abort() {
      if (this.xhr) this.xhr.abort();
    }

    _initRequest() {
      const xhr = this.xhr = new XMLHttpRequest();
      xhr.open('POST', this.url, true);
      xhr.responseType = 'json';
      xhr.setRequestHeader('X-CSRF-TOKEN', this._token);
      xhr.setRequestHeader('Accept', 'application/json');
    }

    _initListeners(resolve, reject, file) {
      const xhr = this.xhr;
      const loader = this.loader;
      const genericErrorText = `Gagal mengunggah file: ${ file.name }`;

      xhr.addEventListener('error', () => reject(genericErrorText));
      xhr.addEventListener('abort', () => reject());
      xhr.addEventListener('load', () => {
        const response = xhr.response;
        if (!response) return reject(genericErrorText);
        if (response.url) return resolve({ default: response.url });
        if (response.data && response.data.url) return resolve({ default: response.data.url });
        reject(response.message || genericErrorText);
      });

      if (xhr.upload) {
        xhr.upload.addEventListener('progress', evt => {
          if (evt.lengthComputable) {
            loader.uploadTotal = evt.total;
            loader.uploaded = evt.loaded;
          }
        });
      }
    }

    _sendRequest(file) {
      const data = new FormData();
      data.append('upload', file);
      this.xhr.send(data);
    }
  }

  function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
      return new MyUploadAdapter(loader);
    };
  }

  ClassicEditor
    .create(document.querySelector('#konten'), {
      extraPlugins: [ MyCustomUploadAdapterPlugin ],
      image: {
        toolbar: [ 'imageTextAlternative', '|', 'imageStyle:full', 'imageStyle:side' ],
      },
    })
    .catch(error => console.error('CKEditor init error:', error));

});
</script>
