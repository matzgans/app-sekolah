<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pengaduan\StorePengaduanRequest;
use App\Mail\SendNotifForPengaduan;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Pengaduan;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\ProfileSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $pengumumans = Pengumuman::with('jadwals')
            ->where('status', 'publikasi')
            ->latest()
            ->get(); // ← PENTIN
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
            'jumlahGuru',
            'pengumumans'
        ));
    }

    public function pengumuman($slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)->first();
        return view('landing.pages.detail-pengumuman', compact('pengumuman'));
        $title = $pengumuman->judul;
        return view('landing.pages.detail-pengumuman', compact('pengumuman', 'title'));
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

    public function pengaduan(Request $request) // Tambahkan Request $request
    {
        $tiket = null;

        if ($request->has('nomor_tiket')) {
            $tiket = Pengaduan::where('no_tiket', $request->nomor_tiket)->first();
        }

        return view('landing.pages.pengaduan', ['tiket' => $tiket]);
    }

    public function store(StorePengaduanRequest $request)
    {
        $validated = $request->validated();

        try {
            if ($request->hasFile('file_pengaduan')) {
                // Simpan file ke storage/app/public/uploads/pengaduan
                $file_pengaduan = $request->file('file_pengaduan')->store('uploads/pengaduan', 'public');
            } else {
                $file_pengaduan = null;
            }

            $pengaduan = Pengaduan::create([
                'nama_lengkap'       => $validated['nama_lengkap'],
                'status_pengirim'    => $validated['status_pengirim'],
                'kontak_pengirim'    => $validated['kontak_pengirim'],
                'subjek'             => $validated['subjek'],
                'isi_pesan'          => $validated['isi_pesan'],
                'kategori_pengaduan' => $validated['kategori_pengaduan'],
                'jenis_pengaduan'    => $validated['jenis_pengaduan'],
                'file_pengaduan'     => $file_pengaduan,
                'status_tiket'       => 'pending',
                'no_tiket'           => 'Tiket-' . random_int(100000, 999999),
                'tanggal_pengaduan'  => now(),
                'user_id'            => auth()->id(),
            ]);

            Mail::to($validated['kontak_pengirim'])->queue(
                new SendNotifForPengaduan(
                    $pengaduan->nama_lengkap,
                    $pengaduan->no_tiket,
                    $pengaduan->tanggal_pengaduan->format('d M Y H:i'),
                    $pengaduan->status_tiket
                )
            );

            return redirect()
                ->route('pengaduan.index')
                ->with('success', 'Pengaduan berhasil dikirim dengan nomor tiket: ' . $pengaduan->no_tiket);
        } catch (\Exception $e) {
            return redirect()
                ->route('pengaduan.index')
                ->with('error', 'Pengaduan gagal dikirim: ' . $e->getMessage());
        }
    }
}
