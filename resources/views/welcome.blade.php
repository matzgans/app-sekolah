<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 1 Suwawa - Sekolah Pusat Keunggulan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        :root {
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
        }

        .navbar {
            transition: all 0.3s ease-in-out;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
        }

        .section-title h2 {
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            display: block;
            width: 60px;
            height: 3px;
            background: var(--bs-primary);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .card-jurusan,
        .card-fasilitas {
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .card-jurusan:hover,
        .card-fasilitas:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .card-jurusan .icon,
        .card-fasilitas .icon {
            font-size: 3rem;
            color: var(--bs-primary);
        }

        /* CSS Terbaru untuk Galeri */
        .gallery-item {
            overflow: hidden;
            border-radius: 0.5rem;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            height: 250px;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(13, 110, 253, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            cursor: pointer;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        .gallery-item .overlay i {
            font-size: 2.5rem;
            color: #fff;
        }

        footer {
            background-color: #212529;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#mainNavbar">

    <nav class="navbar navbar-expand-lg fixed-top shadow-sm" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-building"></i> SMKN 1 SUWAWA
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" type="button"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jurusan">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#prestasi">Prestasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section d-flex align-items-center justify-content-center text-center text-white"
        id="hero">
        <div class="container">
            <h1 class="display-3 fw-bold" data-aos="fade-up">Selamat Datang di SMKN 1 Suwawa</h1>
            <p class="lead my-4" data-aos="fade-up" data-aos-delay="200">Mencetak Generasi Unggul, Kreatif, dan
                Berkarakter Pancasila.</p>
            <a class="btn btn-primary btn-lg" data-aos="fade-up" data-aos-delay="400" href="#profil">Jelajahi Lebih
                Lanjut</a>
        </div>
    </section>

    <main>
        <section class="py-5" id="profil">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <img class="img-fluid rounded shadow"
                            src="https://images.unsplash.com/photo-1577063144156-89c08f0b74e8?q=80&w=1999&auto=format&fit=crop"
                            alt="Gedung Sekolah">
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-4" data-aos="fade-left">
                        <div class="section-title text-start">
                            <h2 class="h1">Profil SMKN 1 Suwawa</h2>
                        </div>
                        <p class="text-muted">SMKN 1 Suwawa berkomitmen untuk menjadi lembaga pendidikan vokasi terdepan
                            yang menghasilkan lulusan kompeten dan siap bersaing di dunia industri global maupun
                            berwirausaha secara mandiri.</p>
                        <h4 class="mt-4">Visi</h4>
                        <p class="fst-italic">"Menjadi sekolah unggul yang menghasilkan tamatan berakhlak mulia,
                            kompeten, dan berdaya saing global."</p>
                        <h4>Misi</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Meningkatkan
                                kualitas pembelajaran yang inovatif.</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Mengembangkan
                                potensi peserta didik melalui kegiatan ekstrakurikuler.</li>
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Membangun kemitraan strategis
                                dengan industri dan masyarakat.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-light py-5" id="jurusan">
            <div class="container py-5">
                <div class="section-title mb-5 text-center" data-aos="fade-up">
                    <h2>Kompetensi Keahlian</h2>
                    <p>Program keahlian yang relevan dengan kebutuhan industri saat ini.</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card card-jurusan h-100 p-4 text-center">
                            <div class="icon mx-auto mb-3"><i class="bi bi-pc-display-horizontal"></i></div>
                            <h4 class="card-title">Teknik Komputer & Jaringan</h4>
                            <p class="card-text">Mempelajari perakitan, instalasi, dan administrasi jaringan komputer
                                skala kecil hingga besar.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card card-jurusan h-100 p-4 text-center">
                            <div class="icon mx-auto mb-3"><i class="bi bi-braces"></i></div>
                            <h4 class="card-title">Rekayasa Perangkat Lunak</h4>
                            <p class="card-text">Fokus pada pengembangan aplikasi web, mobile, dan desktop dengan
                                teknologi terbaru.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card card-jurusan h-100 p-4 text-center">
                            <div class="icon mx-auto mb-3"><i class="bi bi-camera-reels"></i></div>
                            <h4 class="card-title">Multimedia & Desain Grafis</h4>
                            <p class="card-text">Mengasah kreativitas dalam bidang desain visual, animasi, videografi,
                                dan produksi konten digital.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5" id="prestasi">
            <div class="container py-5">
                <div class="section-title mb-5 text-center" data-aos="fade-up">
                    <h2>Prestasi & Ekstrakurikuler</h2>
                    <p>Mengembangkan bakat dan meraih pencapaian gemilang.</p>
                </div>
                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right">
                        <h4>Prestasi Unggulan</h4>
                        <div class="accordion" id="accordionPrestasi">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" type="button" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Juara 1 LKS Tingkat Provinsi - Web Technologies
                                    </button>
                                </h2>
                                <div class="accordion-collapse show collapse" id="collapseOne"
                                    data-bs-parent="#accordionPrestasi">
                                    <div class="accordion-body">
                                        Siswa kami berhasil meraih medali emas dalam kompetisi Lomba Kompetensi Siswa
                                        (LKS) bidang teknologi web, menunjukkan keunggulan dalam pengembangan front-end
                                        dan back-end.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" type="button" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Juara 2 Nasional - Desain Grafis
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapseTwo"
                                    data-bs-parent="#accordionPrestasi">
                                    <div class="accordion-body">
                                        Prestasi membanggakan di tingkat nasional, membuktikan kreativitas dan
                                        penguasaan tools desain yang mumpuni.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-4" data-aos="fade-left">
                        <h4>Ekstrakurikuler Populer</h4>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Pramuka <span
                                    class="badge bg-primary rounded-pill"><i class="bi bi-people-fill"></i></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Paskibra
                                <span class="badge bg-primary rounded-pill"><i class="bi bi-flag-fill"></i></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Futsal &
                                Basket <span class="badge bg-primary rounded-pill"><i
                                        class="bi bi-dribbble"></i></span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">English Club
                                <span class="badge bg-primary rounded-pill"><i class="bi bi-translate"></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-light py-5" id="berita">
            <div class="container py-5">
                <div class="section-title mb-5 text-center" data-aos="fade-up">
                    <h2>Berita & Kegiatan Terbaru</h2>
                    <p>Ikuti perkembangan dan momen penting di SMKN 1 Suwawa.</p>
                </div>

                <div class="row">
                    <div class="col-lg-8 mb-lg-0 mb-4" data-aos="fade-right">
                        <div class="card h-100 border-0 shadow-sm">
                            <img class="card-img-top rounded-top"
                                src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop"
                                alt="Berita Utama">
                            <div class="card-body p-4">
                                <span class="badge bg-primary mb-2">Terbaru</span>
                                <h3 class="card-title fw-bold">SMKN 1 Suwawa Raih Penghargaan Sekolah Adiwiyata Tingkat
                                    Nasional!</h3>
                                <p class="card-text text-muted small">Diposting pada 20 April 2024</p>
                                <p class="card-text">Sebuah kebanggaan bagi seluruh civitas akademika SMKN 1 Suwawa,
                                    kita berhasil meraih predikat Sekolah Adiwiyata tingkat Nasional atas komitmen
                                    terhadap lingkungan dan keberlanjutan.</p>
                                <a class="btn btn-primary mt-3" href="#">Baca Selengkapnya <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-left">
                        <h4 class="mb-3">Rekomendasi</h4>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action d-flex gap-3 py-3" href="#">
                                <img class="rounded-circle object-fit-cover flex-shrink-0"
                                    src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=100&auto=format&fit=crop"
                                    alt="thumbnail" width="64" height="64">
                                <div class="d-flex w-100 justify-content-between gap-2">
                                    <div>
                                        <h6 class="fw-bold mb-0">Workshop Digital Marketing untuk Siswa</h6>
                                        <p class="small mb-0 opacity-75">Membekali siswa dengan skill digital
                                            marketing.</p>
                                    </div>
                                    <small class="text-nowrap opacity-50">2 hari lalu</small>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex gap-3 py-3" href="#">
                                <img class="rounded-circle object-fit-cover flex-shrink-0"
                                    src="https://images.unsplash.com/photo-1517486808906-6538cb3b8656?q=80&w=100&auto=format&fit=crop"
                                    alt="thumbnail" width="64" height="64">
                                <div class="d-flex w-100 justify-content-between gap-2">
                                    <div>
                                        <h6 class="fw-bold mb-0">Gelar Karya dan Pentas Seni Akhir Tahun</h6>
                                        <p class="small mb-0 opacity-75">Ajang unjuk kreativitas dari berbagai
                                            ekstrakurikuler.</p>
                                    </div>
                                    <small class="text-nowrap opacity-50">5 hari lalu</small>
                                </div>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex gap-3 py-3" href="#">
                                <img class="rounded-circle object-fit-cover flex-shrink-0"
                                    src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=100&auto=format&fit=crop"
                                    alt="thumbnail" width="64" height="64">
                                <div class="d-flex w-100 justify-content-between gap-2">
                                    <div>
                                        <h6 class="fw-bold mb-0">Siswa TKJ Juara LKS Jaringan Komputer</h6>
                                        <p class="small mb-0 opacity-75">Meraih prestasi membanggakan di tingkat
                                            provinsi.</p>
                                    </div>
                                    <small class="text-nowrap opacity-50">1 minggu lalu</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                <ul class="nav nav-pills nav-fill mb-4" id="beritaTab" data-aos="fade-up" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="terbaru-tab" data-bs-toggle="tab"
                            data-bs-target="#terbaru" type="button" role="tab" aria-controls="terbaru"
                            aria-selected="true"><i class="bi bi-clock-history me-2"></i>Terbaru</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="populer-tab" data-bs-toggle="tab" data-bs-target="#populer"
                            type="button" role="tab" aria-controls="populer" aria-selected="false"><i
                                class="bi bi-fire me-2"></i>Paling Populer</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kegiatan-tab" data-bs-toggle="tab" data-bs-target="#kegiatan"
                            type="button" role="tab" aria-controls="kegiatan" aria-selected="false"><i
                                class="bi bi-calendar-event me-2"></i>Kegiatan</button>
                    </li>
                </ul>

                <div class="tab-content" id="beritaTabContent">
                    <div class="tab-pane fade show active" id="terbaru" role="tabpanel"
                        aria-labelledby="terbaru-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="50">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img class="card-img-top"
                                        src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop"
                                        alt="Berita Tab 1">
                                    <div class="card-body">
                                        <span class="badge bg-secondary mb-2">Info Sekolah</span>
                                        <h5 class="card-title">Pembukaan Penerimaan Peserta Didik Baru (PPDB) 2025</h5>
                                        <p class="card-text small text-muted">22 April 2024</p>
                                        <a class="btn btn-sm btn-outline-primary" href="#">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="150">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img class="card-img-top"
                                        src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop"
                                        alt="Berita Tab 2">
                                    <div class="card-body">
                                        <span class="badge bg-info mb-2">Prestasi</span>
                                        <h5 class="card-title">Siswa RPL Juara Hackathon Tingkat Provinsi</h5>
                                        <p class="card-text small text-muted">18 April 2024</p>
                                        <a class="btn btn-sm btn-outline-primary" href="#">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="250">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img class="card-img-top"
                                        src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop"
                                        alt="Berita Tab 3">
                                    <div class="card-body">
                                        <span class="badge bg-warning text-dark mb-2">Pengumuman</span>
                                        <h5 class="card-title">Libur Idul Fitri dan Jadwal Masuk Sekolah</h5>
                                        <p class="card-text small text-muted">10 April 2024</p>
                                        <a class="btn btn-sm btn-outline-primary" href="#">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="populer" role="tabpanel" aria-labelledby="populer-tab">
                        <div class="row">
                        </div>
                    </div>

                    <div class="tab-pane fade" id="kegiatan" role="tabpanel" aria-labelledby="kegiatan-tab">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5" id="fasilitas">
            <div class="container py-5">
                <div class="section-title mb-5 text-center" data-aos="fade-up">
                    <h2>Fasilitas Sekolah</h2>
                    <p>Sarana dan prasarana penunjang pembelajaran yang lengkap dan modern.</p>
                </div>
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                        <div class="card card-fasilitas h-100 p-4">
                            <div class="icon mx-auto mb-3"><i class="bi bi-pc-display"></i></div>
                            <h4>Laboratorium Komputer</h4>
                            <p>Dilengkapi PC spesifikasi tinggi dan koneksi internet cepat.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card card-fasilitas h-100 p-4">
                            <div class="icon mx-auto mb-3"><i class="bi bi-book-half"></i></div>
                            <h4>Perpustakaan Digital</h4>
                            <p>Akses ke ribuan e-book dan jurnal untuk referensi belajar.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card card-fasilitas h-100 p-4">
                            <div class="icon mx-auto mb-3"><i class="bi bi-wifi"></i></div>
                            <h4>Area WiFi Gratis</h4>
                            <p>Jaringan internet yang mencakup seluruh area sekolah.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card card-fasilitas h-100 p-4">
                            <div class="icon mx-auto mb-3"><i class="bi bi-person-workspace"></i></div>
                            <h4>Ruang Praktik Siswa</h4>
                            <p>Dirancang menyerupai lingkungan kerja industri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-light py-5" id="galeri">
            <div class="container py-5">
                <div class="section-title mb-5 text-center" data-aos="fade-up">
                    <h2>Galeri Kegiatan</h2>
                    <p>Momen-momen berharga yang terekam di SMKN 1 Suwawa.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                        <div class="gallery-item">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop"
                                alt="Galeri 1">
                            <div class="overlay"><i class="bi bi-search"></i></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="gallery-item">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop"
                                alt="Galeri 2">
                            <div class="overlay"><i class="bi bi-search"></i></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="gallery-item">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?q=80&w=2070&auto=format&fit=crop"
                                alt="Galeri 3">
                            <div class="overlay"><i class="bi bi-search"></i></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6" data-aos="zoom-in">
                        <div class="gallery-item">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop"
                                alt="Galeri 4">
                            <div class="overlay"><i class="bi bi-search"></i></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12" data-aos="zoom-in" data-aos-delay="100">
                        <div class="gallery-item">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop"
                                alt="Galeri 5">
                            <div class="overlay"><i class="bi bi-search"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="pb-4 pt-5 text-white">
        <div class="text-md-start container text-center">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">SMKN 1 Suwawa</h6>
                    <hr class="d-inline-block mx-auto mb-4 mt-0"
                        style="width: 60px; background-color: var(--bs-primary); height: 2px" />
                    <p>
                        Lembaga pendidikan vokasi yang berdedikasi untuk menciptakan lulusan yang siap kerja, cerdas,
                        dan berkarakter.
                    </p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Tautan Cepat</h6>
                    <hr class="d-inline-block mx-auto mb-4 mt-0"
                        style="width: 60px; background-color: var(--bs-primary); height: 2px" />
                    <p><a class="text-decoration-none text-white" href="#profil">Profil</a></p>
                    <p><a class="text-decoration-none text-white" href="#jurusan">Jurusan</a></p>
                    <p><a class="text-decoration-none text-white" href="#berita">Berita</a></p>
                    <p><a class="text-decoration-none text-white" href="#galeri">Galeri</a></p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mb-md-0 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Kontak</h6>
                    <hr class="d-inline-block mx-auto mb-4 mt-0"
                        style="width: 60px; background-color: var(--bs-primary); height: 2px" />
                    <p><i class="bi bi-geo-alt-fill me-3"></i>Jl. Pendidikan No.1, Suwawa, Kab. Bone Bolango</p>
                    <p><i class="bi bi-envelope-fill me-3"></i>info@smkn1suwawa.sch.id</p>
                    <p><i class="bi bi-telephone-fill me-3"></i>(0435) 123 4567</p>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Ikuti Kami</h6>
                    <hr class="d-inline-block mx-auto mb-4 mt-0"
                        style="width: 60px; background-color: var(--bs-primary); height: 2px" />
                    <div>
                        <a class="btn btn-primary btn-floating m-1" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="btn btn-primary btn-floating m-1" href="#"><i
                                class="bi bi-instagram"></i></a>
                        <a class="btn btn-primary btn-floating m-1" href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top border-secondary p-3 text-center">
            © 2025 Copyright: <a class="text-decoration-none fw-bold text-white" href="#">SMKN 1 Suwawa</a>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
</body>

</html>
