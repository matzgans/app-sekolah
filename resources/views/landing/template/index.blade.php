<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link type="image/x-icon"
        href="{{ optional($profileSekolah)->logo_sekolah ? Storage::url(optional($profileSekolah)->logo_sekolah) : 'https://placehold.co/40x40/0d6efd/fff?text=Logo' }}"
        rel="icon">

    <link href="{{ asset('assets/template_bs/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- AOS CSS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- Bootstrap Icons -->
    <link href="{{ asset('assets/template_bs/css/bootstrap-icons.min.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS (Minimal) -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* --- Beberapa style kustom yang sulit digantikan oleh Bootstrap Utility --- */

        /* Navbar */
        .navbar {
            transition: all 0.3s ease-in-out;
        }

        /* Hero Section */
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ optional($profileSekolah)->foto_sekolah ? Storage::url(optional($profileSekolah)->foto_sekolah) : 'https://placehold.co/1920x1080/333/fff?text=Gedung+Sekolah' }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        /* Card hover effect */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12) !important;
        }

        /* Prestasi Card Overlay */
        .prestasi-card .card-img-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0));
        }

        /* Gallery Image Hover */
        .gallery-item img {
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }
    </style>
    @stack('style')
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <img class="img-fluid"
                    src="{{ optional($profileSekolah)->logo_sekolah ? Storage::url(optional($profileSekolah)->logo_sekolah) : 'https://placehold.co/40x40/0d6efd/fff?text=Logo' }}"
                    alt="Logo" width="40">
                <span class="fw-bold">{{ optional($profileSekolah)->nama_sekolah }}</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" type="button"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                            href="{{ url('/') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}"
                            href="{{ url('/') }}#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('jurusan') ? 'active' : '' }}"
                            href="{{ url('/') }}#jurusan">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('fasilitas') ? 'active' : '' }}"
                            href="{{ url('/') }}#fasilitas">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('ekskul') ? 'active' : '' }}"
                            href="{{ url('/') }}#ekskul">Ekskul</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('prestasi') ? 'active' : '' }}"
                            href="{{ url('/') }}#prestasi">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('galeri') ? 'active' : '' }}"
                            href="{{ url('/') }}#galeri">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('berita') ? 'active' : '' }}"
                            href="{{ url('/') }}#berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}"
                            href="{{ url('/') }}#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kalender') ? 'active' : '' }}"
                            href="{{ route('kalender') }}#kalender">Kalender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pengaduan') ? 'active' : '' }}"
                            href="{{ route('pengaduan') }}#pengaduan">Pengaduan</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    @yield('content')



    <!-- Kontak & Footer -->
    <footer class="bg-dark pb-4 pt-5 text-white" id="kontak">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <h5 class="fw-bold mb-3">Tentang {{ $profileSekolah->nama_sekolah ?? 'SMK Teknologi Informasi' }}
                    </h5>
                    <p class="text-white-50">SMK Teknologi Informasi berkomitmen mencetak lulusan siap kerja yang
                        kompeten, kreatif, dan berakhlak mulia.</p>
                </div>
                <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <h5 class="fw-bold mb-3">Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a class="text-white-50 text-decoration-none" href="#tentang">Tentang</a></li>
                        <li><a class="text-white-50 text-decoration-none" href="#jurusan">Jurusan</a></li>
                        <li><a class="text-white-50 text-decoration-none" href="#prestasi">Prestasi</a></li>
                        <li><a class="text-white-50 text-decoration-none" href="#berita">Berita</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="fw-bold mb-3">Kontak Kami</h5>
                    <p class="text-white-50 small"><i class="bi bi-geo-alt-fill me-2"></i> Jl. Pendidikan No. 123,
                        Kota Harapan</p>
                    <p class="text-white-50 small"><i class="bi bi-telephone-fill me-2"></i> (021) 123-4567</p>
                    <p class="text-white-50 small"><i class="bi bi-envelope-fill me-2"></i> info@namasekolah.sch.id
                    </p>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                    <p class="text-white-50">Dapatkan info terbaru dari media sosial kami.</p>
                    <div>
                        <a class="fs-4 me-3 text-white" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="fs-4 me-3 text-white" href="#"><i class="bi bi-instagram"></i></a>
                        <a class="fs-4 me-3 text-white" href="#"><i class="bi bi-youtube"></i></a>
                        <a class="fs-4 text-white" href="#"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-white-50 text-center">
                <p>&copy; 2024 {{ $profileSekolah->nama_sekolah ?? 'SMK Teknologi Informasi' }}. All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>


    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/template_bs/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 800,
            once: true,
        });

        // Efek scroll pada Navbar
        const navbar = document.getElementById('navbar');
        window.onscroll = function() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled', 'bg-white', 'shadow-sm');
                navbar.classList.remove('navbar-dark');
                navbar.classList.add('navbar-light');
            } else {
                navbar.classList.remove('navbar-scrolled', 'bg-white', 'shadow-sm');
                navbar.classList.remove('navbar-light');
                navbar.classList.add('navbar-dark');
            }
        };
    </script>
    @stack('script')


</body>

</html>
