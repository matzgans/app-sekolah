<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\Jurusan;
use App\Models\Prestasi;
use App\Models\ProfileSekolah;

class LandingController extends Controller
{
    public function index()
    {
        $profileSekolah = ProfileSekolah::first();
        $visi = $profileSekolah->visi;
        $misi = $profileSekolah->misi;
        $kepalaSekolah = $profileSekolah->kepala_sekolah;
        $fotoKepalaSekolah = $profileSekolah->foto_kepala_sekolah;
        $akreditasi = $profileSekolah->akreditasi;
        $fotoSekolah = $profileSekolah->foto_sekolah;
        $sambutanKepalaSekolah = $profileSekolah->sambutan_kepala_sekolah;
        $title = $profileSekolah->nama_sekolah;
        $jurusans = Jurusan::all();
        $fasilitas = Fasilitas::all();
        $ekstrakurikuler = Ekstrakurikuler::all();
        $prestasis = Prestasi::orderByRaw("
    FIELD(tingkat, 'internasional','nasional','provinsi','kota','sekolah')
")->get();

        // ambil berita utama (random dari yang terbaru atau terbanyak dilihat)
        $featured = Berita::where('status', 'publikasi')
            ->orderByRaw("RAND()") // kalau mau random
            ->first();

        // sisanya (kecuali berita featured)
        $beritas = Berita::where('status', 'publikasi')
            ->where('id', '!=', $featured->id)
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(5) // misalnya ambil 5 list
            ->get();

        $galeris = Galeri::all();

        return view('landing.pages.home', compact(
            'title',
            'visi',
            'misi',
            'kepalaSekolah',
            'fotoKepalaSekolah',
            'sambutanKepalaSekolah',
            'akreditasi',
            'fotoSekolah',
            'jurusans',
            'fasilitas',
            'ekstrakurikuler',
            'prestasis',
            'beritas',
            'featured',
            'galeris'
        ));
    }

    public function berita($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        $title = $berita->judul;
        $beritas = Berita::where('status', 'publikasi')->orderBy('tanggal_publikasi', 'desc')->get();
        return view('landing.pages.detail-berita', compact('berita', 'title', 'beritas'));
    }

    public function prestasi($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->first();
        $title = $prestasi->judul;
        $prestasis = Prestasi::orderBy('tahun', 'desc')->get();
        return view('landing.pages.detail-prestasi', compact('prestasi', 'title', 'prestasis'));
    }

    public function jurusan($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        $berita->increment('views');
        $beritasPopuler = Berita::where('status', 'publikasi')
            ->where('id', '!=', $berita->id) // Kunci agar berita saat ini tidak muncul lagi
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // 3. Kirim kedua variabel tersebut ke view
        return view('landing.pages.detail-berita', [
            'berita' => $berita,
            'title' => $berita->judul,
            'beritas' => $beritasPopuler // Variabel ini yang akan di-loop di sidebar
        ]);
    }
}
