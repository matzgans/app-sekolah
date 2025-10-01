<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\ProfileSekolah;

class LandingController extends Controller
{
    public function index()
    {
        $profileSekolah = ProfileSekolah::first();

        $visi = $profileSekolah->visi ?? null;
        $misi = $profileSekolah->misi ?? null;
        $kepalaSekolah = $profileSekolah->kepala_sekolah ?? null;
        $fotoKepalaSekolah = $profileSekolah->foto_kepala_sekolah ?? null;
        $akreditasi = $profileSekolah->akreditasi ?? null;
        $fotoSekolah = $profileSekolah->foto_sekolah ?? null;
        $sambutanKepalaSekolah = $profileSekolah->sambutan_kepala_sekolah ?? null;
        $title = $profileSekolah->nama_sekolah ?? 'Profil Sekolah';

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

        // sisanya (kecuali berita featured jika ada)
        $beritas = Berita::where('status', 'publikasi')
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->orderBy('tanggal_publikasi', 'desc')
            ->take(5)
            ->get();

        $galeris = Galeri::paginate(6);
        $pengumuman = Pengumuman::inRandomOrder()->first();
        $gurus = Guru::paginate(4);
        $jumlahGuru = Guru::count();

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
            'pengumuman',
            'gurus',
            'jumlahGuru'
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

    public function kalender()
    {
        $jadwals = Jadwal::with('jadwalable')->get();

        $events = $jadwals->map(function ($jadwal) {
            if (!$jadwal->jadwalable || !$jadwal->tanggal) {
                return null; // Lewati jika tidak ada relasi atau tanggal
            }

            // --- MULAI LOGIKA PEMBERSIHAN WAKTU ---

            // 1. Ambil hanya waktu mulai (bagian sebelum tanda '-')
            $waktuBagian = explode('-', $jadwal->waktu)[0]; // Contoh: "16.00 "

            // 2. Hapus spasi kosong
            $waktuBersih = trim($waktuBagian); // Contoh: "16.00"

            // 3. Ganti titik dengan titik dua
            $waktuFormat = str_replace('.', ':', $waktuBersih); // Contoh: "16:00"

            // 4. Pastikan ada detik (opsional tapi aman)
            if (substr_count($waktuFormat, ':') === 1) {
                $waktuFormat .= ':00'; // Menjadi "16:00:00"
            }

            // --- SELESAI LOGIKA PEMBERSIHAN WAKTU ---

            return [
                'title' => $jadwal->jadwalable->judul ?? $jadwal->jadwalable->nama_ekskul,
                // Gabungkan tanggal dengan waktu yang sudah diformat ulang
                'start' => $jadwal->tanggal . 'T' . $waktuFormat,
                'description' => $jadwal->jadwalable->deskripsi ?? 'Tidak ada deskripsi',
                'tipe' => $jadwal->jadwalable->tipe ?? 'Tidak ada tipe',
                'hari' => $jadwal->hari,
                'waktu' => $jadwal->waktu,
            ];
        })->filter()->values();



        return view('landing.pages.kalender', [
            'events' => $events
        ]);
    }
}
