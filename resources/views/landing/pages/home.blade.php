@extends('landing.template.index')

@section('title')
    {{ $title }}
@endsection

@push('style')
    <style>
        /* Mengatur tinggi kartu yang seragam */
        .card-fasilitas {
            height: 300px;
            transition: all 0.4s ease-in-out;
        }

        /* Mengatur gambar agar mengisi kartu & transisi zoom */
        .card-fasilitas .card-img {
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease-in-out;
        }

        /* Mengatur overlay */
        .card-fasilitas .overlay-content {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0));
            opacity: 0;
            /* Sembunyikan secara default */
            transform: translateY(20px);
            /* Posisi awal sedikit di bawah */
            transition: all 0.4s ease-in-out;
        }

        /* INILAH KUNCINYA: Saat card di-hover, ubah properti elemen di dalamnya */
        .card-fasilitas:hover {
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .25) !important;
            /* Perbesar shadow */
        }

        .card-fasilitas:hover .card-img {
            transform: scale(1.1);
            /* Zoom gambar */
        }

        .card-fasilitas:hover .overlay-content {
            opacity: 1;
            /* Tampilkan overlay */
            transform: translateY(0);
            /* Kembalikan ke posisi normal */
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center text-center text-white" id="home">
        <div class="container">
            <div data-aos="fade-up">
                <h1 class="display-3 fw-bold">{{ $title }}</h1>
                <p class="lead my-3" style="max-width: 600px; margin: auto;">Mencetak Generasi Unggul, Kreatif, dan
                    Berakhlak Mulia di Era Digital.</p>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="py-5" id="tentang">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Tentang Sekolah</h2>
                <p class="lead text-muted mb-5">Mengenal lebih dekat visi, misi, dan pimpinan sekolah kami.</p>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-lg-6 text-center" data-aos="fade-right">
                    <img class="img-fluid rounded-4 d-block mx-auto shadow"
                        src="{{ $fotoKepalaSekolah ? Storage::url($fotoKepalaSekolah) : 'https://placehold.co/600x400/0d6efd/fff?text=Kepala+Sekolah' }}"
                        alt="Kepala Sekolah" style="max-width: 400px; height: auto;">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h3>{{ $kepalaSekolah }}</h3>
                    <p class="text-muted">Kepala Sekolah</p>
                    <div class="text-start">
                        {!! $sambutanKepalaSekolah !!}
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6"><i class="bi bi-award-fill text-primary me-2"></i> Kurikulum Terakreditasi
                            {{ $akreditasi }}</div>
                        <div class="col-md-6"><i class="bi bi-person-video3 text-primary me-2"></i> Pengajar Profesional
                        </div>
                        <div class="col-md-6"><i class="bi bi-building-gear text-primary me-2"></i> Fasilitas Modern
                        </div>
                        <div class="col-md-6"><i class="bi bi-people-fill text-primary me-2"></i> Lingkungan Kondusif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-5">
                <div class="col-md-6" data-aos="zoom-in">
                    <div class="card card-hover h-100 border-0 p-4 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-eye-fill display-4 text-primary mb-3"></i>
                            <h3>Visi</h3>
                            <p>{{ $visi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card card-hover h-100 border-0 p-4 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-rocket-takeoff-fill display-4 text-primary mb-3"></i>
                            <h3>Misi</h3>
                            <div class="text-start">
                                {!! $misi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Statistik -->
    <section class="bg-primary py-5 text-white" id="statistik">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4" data-aos="fade-up">
                    <i class="bi bi-people-fill display-4"></i>
                    <h3 class="display-5 fw-bold mt-2">1200+</h3>
                    <p class="lead">Siswa Aktif</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <i class="bi bi-person-workspace display-4"></i>
                    <h3 class="display-5 fw-bold mt-2">85</h3>
                    <p class="lead">Guru Profesional</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <i class="bi bi-journal-bookmark-fill display-4"></i>
                    <h3 class="display-5 fw-bold mt-2">5</h3>
                    <p class="lead">Program Keahlian</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan -->
    <section class="bg-light py-5" id="jurusan">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Program Keahlian</h2>
                <p class="lead text-muted mb-5">Temukan minat dan bakatmu melalui program keahlian unggulan kami.</p>
            </div>
            <div class="row g-4">
                <!-- Contoh Jurusan -->
                @forelse ($jurusans as $jurusan)
                    <a class="col-lg-3 col-md-6 text-decoration-none" data-aos="fade-up"
                        href="{{ route('jurusan.detail', $jurusan->slug) }}">
                        <div class="card card-hover h-100 border-0 p-3 text-center shadow-sm">
                            <img class="rounded-circle mx-auto"
                                src="{{ $jurusan->logo_jurusan ? Storage::url($jurusan->logo_jurusan) : 'https://placehold.co/100x100/343a40/fff?text=RPL' }}"
                                alt="Logo" style="width: 100px; height: 100px;">
                            <div class="card-body">
                                <h5 class="fw-bold">{{ $jurusan->nama_jurusan }}</h5>
                                <p class="small text-muted">Kepala Jurusan: {{ $jurusan->nama_kepala_jurusan }}</p>
                            </div>
                        </div>
                    </a>

                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">Tidak ada program keahlian yang tersedia.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Fasilitas -->
    <section class="bg-light py-5" id="fasilitas">
        <div class="container py-5">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Fasilitas Sekolah</h2>
                <p class="lead text-muted mb-5">Kami menyediakan fasilitas terbaik untuk menunjang proses belajar.</p>
            </div>

            <div class="row g-4">
                @forelse ($fasilitas as $item)
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-delay="{{ $loop->iteration * 100 }}">

                        {{-- Gunakan card Bootstrap sebagai dasar --}}
                        <div class="card card-fasilitas overflow-hidden border-0 text-white shadow-sm">

                            {{-- Gambar Fasilitas (akan di-zoom saat hover) --}}
                            <img class="card-img" src="{{ asset('storage/' . $item->foto_fasilitas) }}"
                                alt="{{ $item->nama_fasilitas }}">

                            {{-- Overlay untuk nama dan deskripsi --}}
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-0">
                                {{-- Konten overlay yang muncul saat hover --}}
                                <div class="overlay-content h-100 d-flex flex-column justify-content-end p-4">
                                    <h4 class="fw-bold">{{ $item->nama_fasilitas }}</h4>
                                    <p class="card-text">{{ $item->deskripsi }}</p>
                                </div>
                            </div>

                        </div>

                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Saat ini belum ada data fasilitas yang dapat ditampilkan.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Ekstrakurikuler -->
    <section class="bg-light py-5" id="ekskul">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Ekstrakurikuler</h2>
                <p class="lead text-muted mb-5">Kembangkan potensimu di luar jam pelajaran bersama kami.</p>
            </div>
            <div class="row g-4">
                @forelse ($ekstrakurikuler as $item)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up">
                        <div class="card card-hover h-100 border-0 p-3 text-center shadow-sm">

                            {{-- PERUBAHAN DI SINI --}}
                            <img class="rounded-circle mx-auto"
                                src="{{ $item->logo_ekskul ? Storage::url($item->logo_ekskul) : 'https://placehold.co/100x100/dc3545/fff?text=Logo' }}"
                                alt="{{ $item->nama_ekskul }}" style="width: 100px; height: 100px; object-fit: cover;">
                            {{-- AKHIR PERUBAHAN --}}

                            <div class="card-body">
                                <h5 class="fw-bold mt-3">{{ $item->nama_ekskul }}</h5>
                                <p class="small text-muted">Pembina: {{ $item->nama_pembina }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">Tidak ada ekstrakurikuler yang tersedia.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Prestasi -->
    <section class="py-5" id="prestasi">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Galeri Prestasi</h2>
                <p class="lead text-muted mb-5">Berbagai pencapaian membanggakan dari siswa-siswi kami.</p>
            </div>
            <div class="row g-4">
                @forelse ($prestasis as $item)
                    <a class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100"
                        href="{{ route('prestasi.detail', $item->slug) }}">
                        <div class="card prestasi-card card-hover overflow-hidden border-0 text-white shadow-sm">

                            <div class="ratio ratio-4x3">
                                <img class="object-fit-cover w-100 h-100"
                                    src="{{ $item->thumbnail ? Storage::url($item->thumbnail) : 'https://placehold.co/400x300/0d6efd/fff?text=Prestasi' }}"
                                    alt="{{ $item->judul }}">
                            </div>

                            @php
                                // Definisikan mapping antara tingkat dan kelas warna Bootstrap
                                $tingkatColors = [
                                    'sekolah' => 'bg-secondary',
                                    'kota' => 'bg-info text-dark',
                                    'provinsi' => 'bg-success',
                                    'nasional' => 'bg-primary',
                                    'internasional' => 'bg-danger',
                                ];

                                // Ambil kelas warna, jika tidak ada, gunakan default 'bg-light text-dark'
                                $badgeClass = $tingkatColors[$item->tingkat] ?? 'bg-light text-dark';
                            @endphp

                            <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                                <span
                                    class="badge {{ $badgeClass }} align-self-start">{{ Str::ucfirst($item->tingkat) }}</span>
                                <h5 class="card-title fw-bold mt-2 text-white" style="text-shadow: 2px 2px 4px #000000;">
                                    {{ $item->judul }}</h5>
                                <p class="card-text text-white" style="text-shadow: 1px 1px 2px #000000;">Tahun
                                    {{ $item->tahun }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">Tidak ada prestasi yang tersedia.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section class="bg-light py-5" id="galeri">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Galeri Sekolah</h2>
                <p class="lead text-muted mb-5">Momen-momen berharga di sekolah kami.</p>
            </div>
            <div class="row g-4">
                @forelse ($galeris as $item)
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in"><a
                            class="gallery-item d-block rounded-4 overflow-hidden shadow-sm" href="#"><img
                                class="img-fluid" src="{{ Storage::url($item->gambar) }}" alt="Galeri 1"></a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Saat ini belum ada data galeri yang dapat ditampilkan.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Berita -->
    <section class="py-5" id="berita">
        <div class="container">
            <div class="mb-5 text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Berita Terkini</h2>
                <p class="lead text-muted">Ikuti kegiatan dan informasi terbaru dari sekolah kami.</p>
            </div>
            <div class="row g-4">
                <!-- Berita Utama -->
                <div class="col-lg-7">
                    <div class="card h-100 border-0 shadow-sm">
                        <img class="card-img-top"
                            src="{{ $featured->thumbnail ? Storage::url($featured->thumbnail) : 'https://placehold.co/800x400/6c757d/fff?text=Berita+Utama' }}"
                            alt="{{ $featured->judul }}">
                        <div class="card-body p-4">
                            <p class="small text-muted mb-2">{{ $featured->tanggal_publikasi }}</p>
                            <h3 class="fw-bold">{{ $featured->judul }}</h3>
                            <p class="card-text">{!! Str::limit($featured->isi_berita, 400) !!}</p>
                            <a class="btn btn-primary mt-2" href="{{ route('berita.detail', $featured->slug) }}">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- List Berita -->
                <div class="col-lg-5">
                    @foreach ($beritas as $berita)
                        <div class="d-flex border-bottom mb-4 pb-3">
                            <img class="me-3 rounded"
                                src="{{ $berita->thumbnail ? Storage::url($berita->thumbnail) : 'https://placehold.co/150x100/6c757d/fff?text=Berita' }}"
                                alt="{{ $berita->judul }}" width="150">
                            <div>
                                <p class="small text-muted mb-1">{{ $berita->tanggal_publikasi }}</p>
                                <h6 class="fw-bold mb-1">{{ $berita->judul }}</h6>
                                <a class="small text-primary" href="#">Baca Selengkapnya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
