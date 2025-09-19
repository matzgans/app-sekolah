<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\Jurusan;
use App\Models\Pengumuman;
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
        $ekstrakurikuler = Ekstrakurikuler::paginate(6);
        $prestasis = Prestasi::orderByRaw("
    FIELD(tingkat, 'internasional','nasional','provinsi','kota','sekolah')
")->get();
        $jumlahJurusan = Jurusan::count();

        // ambil berita utama (random dari yang terbaru atau terbanyak dilihat)
        $featured = Berita::where('status', 'publikasi')
            ->inRandomOrder()
            ->first();

        // sisanya (kecuali berita featured)
        $beritas = Berita::where('status', 'publikasi')
            ->where('id', '!=', $featured->id)
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(5) // misalnya ambil 5 list
            ->get();

        $galeris = Galeri::paginate(6);
        $pengumuman = Pengumuman::inRandomOrder()->first();

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
            'galeris',
            'jumlahJurusan',
            'pengumuman'
        ));
    }

    public function berita($slug)
    {
        Berita::where('slug', $slug)->increment('views');

        $berita = Berita::where('slug', $slug)->first();

        return view('landing.pages.detail-berita', compact('berita'));
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

        $jurusan = Jurusan::where('slug', $slug)->first();
        $title = $jurusan->nama_jurusan;
        $jurusans = Jurusan::all();
        return view('landing.pages.detail-jurusan', compact('jurusan', 'title', 'jurusans'));
    }
}
