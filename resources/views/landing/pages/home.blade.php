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
            <style>
                .card-split {
                    display: flex;
                    /* DIUBAH: dari 'center' menjadi 'stretch' untuk perataan atas */
                    align-items: stretch;
                    background-color: #ffffff;
                    border-radius: 1rem;
                    overflow: hidden;
                    border: 1px solid #e9ecef;
                    transition: all 0.3s ease-in-out;
                }

                .card-split:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 12px 24px rgba(32, 41, 57, 0.1);
                }

                .card-split-icon {
                    flex: 0 0 120px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    align-self: stretch;
                    color: white;
                    font-size: 3rem;
                }

                .icon-visi-bg {
                    background-image: linear-gradient(45deg, #007bff 0%, #00d4ff 100%);
                }

                .icon-misi-bg {
                    background-image: linear-gradient(45deg, #6610f2 0%, #a96eff 100%);
                }

                .card-split-content {
                    padding: 2.5rem;
                    /* Sedikit padding tambahan untuk ruang napas */
                    /* DITAMBAHKAN: untuk kontrol layout internal yang lebih baik */
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    /* Konten kini terpusat secara vertikal */
                }
            </style>

            <div class="row g-4 mt-5">

                {{-- KARTU VISI --}}
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="card-split h-100">
                        <div class="card-split-icon icon-visi-bg">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <div class="card-split-content">
                            <h3 class="fw-bold mb-3">Visi</h3>
                            <p class="text-muted">{{ $visi }}</p>
                        </div>
                    </div>
                </div>

                {{-- KARTU MISI --}}
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-split h-100">
                        <div class="card-split-icon icon-misi-bg">
                            <i class="bi bi-rocket-takeoff-fill"></i>
                        </div>
                        <div class="card-split-content">
                            <h3 class="fw-bold mb-3">Misi</h3>
                            <div class="text-muted">
                                {!! $misi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="py-5" id="teachers" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">

            <div class="mb-5 text-center">
                <h2 class="fw-bold">Tim Pengajar Kami</h2>
                <p class="text-muted">Tenaga pendidik profesional dan berdedikasi yang siap membimbing putra-putri Anda.</p>
            </div>

            <div class="row gy-4">

                <style>
                    .teacher-card {
                        transition: all 0.4s ease;
                        transform: translateY(0);
                    }

                    .teacher-card:hover {
                        transform: translateY(-10px);
                        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
                    }

                    .teacher-card .card-img-wrapper {
                        position: relative;
                        overflow: hidden;
                    }

                    .teacher-card .card-img-top {
                        transition: transform 0.4s ease;
                    }

                    .teacher-card:hover .card-img-top {
                        transform: scale(1.1);
                    }

                    .teacher-card .social-icons {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.5);
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        opacity: 0;
                        transition: opacity 0.4s ease;
                    }

                    .teacher-card:hover .social-icons {
                        opacity: 1;
                    }

                    .teacher-card .social-icons a {
                        color: white;
                        margin: 0 10px;
                        font-size: 20px;
                        transform: translateY(20px);
                        transition: transform 0.3s ease, color 0.3s ease;
                    }

                    .teacher-card:hover .social-icons a {
                        transform: translateY(0);
                    }

                    .teacher-card:hover .social-icons a:nth-child(2) {
                        transition-delay: 0.1s;
                    }

                    .teacher-card:hover .social-icons a:nth-child(3) {
                        transition-delay: 0.2s;
                    }

                    .teacher-card .card-body {
                        transition: background 0.4s ease;
                    }

                    .teacher-card:hover .card-body {
                        background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);
                    }
                </style>

                @forelse ($gurus as $guru)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-4" data-aos="fade-up">

                        <div class="card teacher-card h-100 w-100 rounded-4 overflow-hidden border-0 shadow-sm">

                            {{-- Wrapper untuk Gambar dan Ikon Sosial --}}
                            <div class="card-img-wrapper">
                                <img class="card-img-top"
                                    src="{{ $guru->foto_guru ? Storage::url($guru->foto_guru) : 'https://placehold.co/400x450/6c757d/fff?text=Foto' }}"
                                    alt="Foto {{ $guru->nama_guru }}" style="height: 300px; object-fit: cover;">


                                <div class="social-icons">
                                    <a class="{{ $guru->twitter ? 'hidden-link' : '' }}" href="{{ $guru->twitter }}"><i
                                            class="bi bi-twitter"></i></a>
                                    <a class="{{ $guru->facebook ? 'hidden-link' : '' }}" href="{{ $guru->facebook }}"><i
                                            class="bi bi-facebook"></i></a>
                                    <a class="{{ $guru->instagram ? 'hidden-link' : '' }}"
                                        href="{{ $guru->instagram }}"><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>

                            {{-- Isi Kartu --}}
                            <div class="card-body d-flex flex-column p-4 text-center">
                                <h5 class="card-title fw-bold mb-1">{{ $guru->nama_guru }}</h5>
                                <p class="text-primary fw-light">{{ $guru->jabatan }}</p>

                                @if ($guru->nip)
                                    <p class="small text-muted mt-2">NIP: {{ $guru->nip }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Saat ini data guru belum tersedia.
                        </div>
                    </div>
                @endforelse

                <div class="d-flex justify-content-center pt-4">
                    {{ $gurus->links() }}
                </div>

            </div>

        </div>
    </section>

    <!-- Statistik -->
    <style>
        #statistik-baru {
            position: relative;
            /* Gradien utama sebagai latar belakang */
            background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 5rem 0;
            overflow: hidden;
        }

        /* Menambahkan lapisan pola geometris di atas gradien */
        #statistik-baru::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h4v-9H0v-1h4v-9H0v-1h4v-9H0v-1h4v-9H0v-1h4v-9H0v-1h4v-9H0v-1h4v-9H0v-1h4v-9H0v-1h5v-4h1v4h9v-4h1v4h9v-4h1v4h9v-4h1v4h9v-4h1v4h9v-4h1v4h9v-4h1v4h9v-4h1v4h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Setiap item statistik dibungkus dalam panel elegan */
        .stat-panel {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 2.5rem 1.5rem;
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-panel:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        /* Ikon dan Angka diberi efek bayangan agar lebih menonjol */
        .stat-panel .display-4,
        .stat-panel .display-5 {
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>

    <section class="text-white" id="statistik-baru">
        <div class="container">
            <div class="row g-4 text-center">

                <div class="col-md-4" data-aos="fade-up">
                    <div class="stat-panel h-100">
                        <i class="bi bi-people-fill display-4"></i>
                        <h3 class="display-5 fw-bold mt-3">1200+</h3>
                        <p class="lead mb-0 opacity-75">Siswa Aktif</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-panel h-100">
                        <i class="bi bi-person-workspace display-4"></i>
                        <h3 class="display-5 fw-bold mt-3">{{ $jumlahGuru ?? 0 }}</h3>
                        <p class="lead mb-0 opacity-75">Guru Profesional</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-panel h-100">
                        <i class="bi bi-journal-bookmark-fill display-4"></i>
                        <h3 class="display-5 fw-bold mt-3">{{ $jumlahJurusan ?? 0 }}</h3>
                        <p class="lead mb-0 opacity-75">Program Keahlian</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Jurusan -->
    <section class="bg-light py-5" id="jurusan">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Program Keahlian</h2>
                <p class="lead text-muted mb-5">
                    Temukan minat dan bakatmu melalui program keahlian unggulan kami.
                </p>
            </div>

            <!-- Swiper Wrapper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @forelse ($jurusans as $jurusan)
                        <div class="swiper-slide d-flex">
                            <a class="text-decoration-none d-block w-100"
                                href="{{ route('jurusan.detail', $jurusan->slug) }}">
                                <div class="card card-hover h-100 d-flex flex-column border-0 p-3 text-center shadow-sm"
                                    style="min-height: 320px;">
                                    <img class="rounded-circle mx-auto mb-3"
                                        src="{{ $jurusan->logo_jurusan ? Storage::url($jurusan->logo_jurusan) : 'https://placehold.co/100x100/343a40/fff?text=RPL' }}"
                                        alt="Logo" style="width: 100px; height: 100px;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="fw-bold flex-grow-1 text-truncate text-wrap"
                                            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 48px;">
                                            {{ $jurusan->nama_jurusan }}
                                        </h5>
                                        <p class="small text-muted">Kepala Jurusan: {{ $jurusan->nama_kepala_jurusan }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="alert alert-warning">Tidak ada program keahlian yang tersedia.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    </section>

    <!-- Fasilitas -->
    <section class="bg-light py-5" id="fasilitas">
        <div class="container py-5">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Fasilitas Sekolah</h2>
                <p class="lead text-muted mb-5">Kami menyediakan fasilitas terbaik untuk menunjang proses belajar.</p>
            </div>

            @if ($fasilitas->count())
                <div class="swiper mySwiper-fasilitas">
                    <div class="swiper-wrapper">
                        @foreach ($fasilitas as $item)
                            <div class="swiper-slide">
                                <div class="card card-fasilitas h-100 overflow-hidden border-0 text-white shadow-sm">
                                    {{-- Gambar --}}
                                    <img class="card-img" src="{{ asset('storage/' . $item->foto_fasilitas) }}"
                                        alt="{{ $item->nama_fasilitas }}" style="height: 250px; object-fit: cover;">

                                    {{-- Overlay --}}
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-0">
                                        <div class="overlay-content h-100 d-flex flex-column justify-content-end p-4">
                                            <h4 class="fw-bold">{{ $item->nama_fasilitas }}</h4>
                                            <p class="card-text">{{ $item->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="alert alert-warning text-center">
                    Saat ini belum ada data fasilitas yang dapat ditampilkan.
                </div>
            @endif
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
                {{ $ekstrakurikuler->links() }}

            </div>
        </div>
    </section>

    <!-- Prestasi -->
    <section class="py-5" id="prestasi">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold">Prestasi</h2>
                <p class="lead text-muted mb-5">Berbagai pencapaian membanggakan dari siswa-siswi kami.</p>
            </div>
            <div class="row g-4">
                @forelse ($prestasis as $item)
                    <a class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100"
                        href="{{ route('prestasi.detail', $item->slug) }}">
                        <div class="card prestasi-card card-hover overflow-hidden border-0 text-white shadow-sm">

                            <div class="ratio ratio-4x3">
                                <img class="object-fit-cover w-100 h-100"
                                    src="{{ optional($item)->thumbnail ? Storage::url(optional($item)->thumbnail) : 'https://placehold.co/400x300/0d6efd/fff?text=Prestasi' }}"
                                    alt="{{ optional($item)->judul ?? 'Prestasi' }}">

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
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in">
                        <a class="d-block rounded-4 ratio ratio-4x3 overflow-hidden shadow-sm" href="#"
                            style="background-image: url('{{ Storage::url($item->gambar) }}'); background-size: cover; background-position: center;">



                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Saat ini belum ada data galeri yang dapat ditampilkan.
                        </div>
                    </div>
                @endforelse
                {{ $galeris->links() }}

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
                        @if ($featured)
                            <div class="card-body p-4">

                                <div class="d-flex small text-muted mb-2 gap-3">
                                    <span>
                                        <i class="bi bi-person"></i>
                                        {{-- Tampilkan nama user, beri 'Anonim' jika user tidak ada --}}
                                        {{ $featured->pembuat->name ?? 'Anonim' }}
                                    </span>
                                    <span>
                                        <i class="bi bi-calendar-event"></i>
                                        {{-- Format tanggal agar lebih mudah dibaca --}}
                                        {{ \Carbon\Carbon::parse($featured->tanggal_publikasi)->translatedFormat('d F Y') }}
                                    </span>
                                    <span>
                                        <i class="bi bi-eye"></i>
                                        {{ $featured->views }} Dilihat
                                    </span>
                                </div>
                                <h3 class="fw-bold">{{ $featured->judul }}</h3>
                                <p class="card-text">{!! Str::limit(strip_tags($featured->isi_berita), 300) !!}</p>
                                <a class="btn btn-primary mt-2" href="{{ route('berita.detail', $featured->slug) }}">Baca
                                    Selengkapnya</a>
                            </div>
                        @else
                            <div class="card-body p-4">
                                <div class="alert alert-warning">Tidak ada berita yang tersedia.</div>
                            </div>
                        @endif

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
                                <a class="small text-primary" href="{{ route('berita.detail', $berita->slug) }}">Baca
                                    Selengkapnya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if ($pengumuman)
        <div class="modal fade" id="announcementModal" aria-labelledby="announcementModalLabel" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="announcementModalLabel">{{ $pengumuman->judul }}</h5>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Tampilkan gambar jika ada --}}
                        @if ($pengumuman->gambar)
                            <img class="img-fluid w-100 mb-3 rounded" src="{{ asset('storage/' . $pengumuman->gambar) }}"
                                alt="Gambar Pengumuman">
                        @endif

                        {{-- Menampilkan tipe pengumuman sebagai badge --}}
                        <p>
                            <span class="badge bg-primary">{{ ucfirst($pengumuman->tipe) }}</span>
                        </p>

                        {{-- Deskripsi pengumuman, {!! !!} digunakan agar bisa render HTML jika ada --}}
                        <div>
                            {!! $pengumuman->deskripsi !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Langsung inisialisasi dan tampilkan modal tanpa pengecekan apa pun
                const announcementModal = new bootstrap.Modal(document.getElementById('announcementModal'));
                announcementModal.show();
            });
        </script>
    @endif
@endsection

@push('script')
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            speed: 1500,
            autoHeight: true, // ✅ kontainer ikut tinggi slide
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                }
            }
        });

        var swiper = new Swiper(".mySwiper-fasilitas", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            speed: 1500,
            autoHeight: true, // kontainer ikut tinggi slide
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                }
            }
        });
    </script>
@endpush
