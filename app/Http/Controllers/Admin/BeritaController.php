<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        // Pastikan view admin.berita.index memakai $beritas (plural)
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        // create view tidak perlu variabel $berita
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'           => 'required|string|max:255',
            'konten'          => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'penulis'         => 'nullable|string|max:255',
            'tanggal_publish' => 'nullable|date',
        ]);

        // bersihkan konten sebelum disimpan
        $data['konten'] = $this->sanitizeKonten($data['konten']);

        // generate slug dan default tanggal publish
        $data['slug'] = Str::slug($data['judul']) . '-' . time();
        $data['tanggal_publish'] = $data['tanggal_publish'] ?? Carbon::now();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $beritum)
    {
        // agar view menerima $berita
        $berita = $beritum;
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(Berita $beritum)
    {
        // agar view edit mengakses $berita (bukan $beritum)
        $berita = $beritum;
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $beritum)
    {
        $data = $request->validate([
            'judul'           => 'required|string|max:255',
            'konten'          => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'penulis'         => 'nullable|string|max:255',
            'tanggal_publish' => 'nullable|date',
        ]);

        // bersihkan konten sebelum disimpan
        $data['konten'] = $this->sanitizeKonten($data['konten']);

        // update fields
        $beritum->judul = $data['judul'];
        $beritum->konten = $data['konten'];
        $beritum->penulis = $data['penulis'] ?? $beritum->penulis;
        $beritum->tanggal_publish = $data['tanggal_publish'] ?? $beritum->tanggal_publish;

        if ($request->hasFile('gambar')) {
            // hapus file lama jika ada
            if ($beritum->gambar && Storage::disk('public')->exists($beritum->gambar)) {
                Storage::disk('public')->delete($beritum->gambar);
            }
            $beritum->gambar = $request->file('gambar')->store('berita', 'public');
        }

        // perbarui slug apabila judul berubah (opsional)
        $beritum->slug = Str::slug($beritum->judul) . '-' . time();

        $beritum->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar && Storage::disk('public')->exists($beritum->gambar)) {
            Storage::disk('public')->delete($beritum->gambar);
        }
        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    // uploadImage untuk CKEditor (return JSON { url: ... })
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        $file = $request->file('upload');
        $path = $file->store('berita/content', 'public');
        $url = asset('storage/' . $path);

        return response()->json(['url' => $url], 201);
    }

    /**
     * Sanitizes konten HTML sebelum disimpan:
     *  - decode entity
     *  - ganti NBSP dengan spasi biasa
     *  - gabungkan spasi berlebih
     *  - hapus atribut width/height/style pada <img>
     *  - tambahkan kelas 'konten-img' pada <img> (preserve kelas lama)
     *
     * @param string $konten
     * @return string
     */
    private function sanitizeKonten(string $konten): string
    {
        // decode HTML entities (e.g. &nbsp;)
        $konten = html_entity_decode($konten);

        // ganti karakter NBSP (U+00A0) dengan spasi biasa
        $konten = preg_replace('/\x{00A0}/u', ' ', $konten);

        // gabungkan spasi/tabs berlebih
        $konten = preg_replace('/[ \t]{2,}/', ' ', $konten);

        // gunakan DOMDocument untuk memanipulasi tag <img>
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();

        // Pastikan encoding UTF-8 dipertahankan
        $doc->loadHTML(mb_convert_encoding($konten, 'HTML-ENTITIES', 'UTF-8'));

        $imgs = $doc->getElementsByTagName('img');
        // karena getElementsByTagName return live list, kita kumpulkan dulu ke array
        $imgNodes = [];
        foreach ($imgs as $img) {
            $imgNodes[] = $img;
        }

        foreach ($imgNodes as $img) {
            // hapus atribut width/height/style jika ada
            if ($img->hasAttribute('width')) {
                $img->removeAttribute('width');
            }
            if ($img->hasAttribute('height')) {
                $img->removeAttribute('height');
            }
            if ($img->hasAttribute('style')) {
                $img->removeAttribute('style');
            }

            // tambahkan/pertahankan kelas 'konten-img' (agar bisa di-CSS target)
            $existingClass = $img->getAttribute('class');
            $classes = array_filter(explode(' ', $existingClass));
            if (!in_array('konten-img', $classes)) {
                $classes[] = 'konten-img';
            }
            $img->setAttribute('class', trim(implode(' ', $classes)));
        }

        // ambil isi body tanpa wrapper <html><body>
        $body = $doc->getElementsByTagName('body')->item(0);
        $innerHTML = '';
        if ($body) {
            foreach ($body->childNodes as $child) {
                $innerHTML .= $doc->saveHTML($child);
            }
        } else {
            // fallback: kalau body tidak ada (seharusnya jarang terjadi)
            $innerHTML = $doc->saveHTML();
        }

        libxml_clear_errors();

        return $innerHTML;
    }
}
