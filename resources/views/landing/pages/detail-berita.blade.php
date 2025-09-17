@extends('landing.template.index')

@section('title', $berita->judul)


@section('content')
    <section class="bg-body-tertiary py-5">
        <div class="container">
            {{-- BARU: Breadcrumb untuk navigasi --}}
            <nav class="mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/berita">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 30) }}</li>
                </ol>
            </nav>

            <div class="row g-5">

                {{-- Kolom Konten Utama --}}
                <div class="col-lg-8">
                    <div class="card p-md-5 border-0 p-4 shadow-sm">
                        <header class="mb-4">
                            <h1 class="fw-bolder display-5 mb-3">{{ $berita->judul }}</h1>
                            <div class="text-muted small d-flex align-items-center flex-wrap">
                                <span><i class="bi bi-person-fill me-1"></i> Oleh {{ $berita->pembuat->name }}</span>
                                <span class="mx-2">&middot;</span>
                                <span><i class="bi bi-calendar3 me-1"></i>
                                    {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}</span>
                                <span class="mx-2">&middot;</span>
                                <span><i class="bi bi-eye-fill me-1"></i> {{ $berita->views }} kali dilihat</span>
                            </div>
                        </header>

                        <figure class="mb-4">
                            <img class="img-fluid rounded"
                                src="{{ $berita->thumbnail ? Storage::url($berita->thumbnail) : 'https://placehold.co/900x400/6c757d/fff?text=Thumbnail+Berita' }}"
                                alt="{{ $berita->judul }}">
                        </figure>

                        {{-- DIUBAH: Menambahkan class 'article-content' untuk styling --}}
                        <article class="fs-5 lh-lg article-content mb-5">
                            {!! $berita->isi_berita !!}
                        </article>

                        {{-- BARU: Bagian Tags/Topik --}}
                        <div class="mb-5">
                            <h6 class="fw-bold">Tags:</h6>
                            <a class="btn btn-sm btn-outline-secondary mb-1" href="#">Pendidikan</a>
                            <a class="btn btn-sm btn-outline-secondary mb-1" href="#">SMK</a>
                            <a class="btn btn-sm btn-outline-secondary mb-1" href="#">Teknologi</a>
                        </div>

                        <div class="border-top pt-4">
                            {{-- BARU: Kotak Profil Penulis --}}
                            <div class="author-box d-flex align-items-center mb-5 rounded p-3">
                                <div class="flex-shrink-0">
                                    <img class="author-avatar rounded-circle"
                                        src="https://i.pravatar.cc/150?u={{ $berita->pembuat->email }}"
                                        alt="{{ $berita->pembuat->name }}">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-0">{{ $berita->pembuat->name }}</h6>
                                    <p class="small text-muted mb-0">Penulis adalah seorang pengajar dengan fokus pada
                                        pengembangan kurikulum digital di sekolah kejuruan.</p>
                                </div>
                            </div>

                            {{-- Galeri Terkait --}}
                            @if ($berita->galeris->count() > 0)
                                <h4 class="fw-bold mb-3">Galeri Terkait</h4>
                                <div class="row g-3">
                                    @foreach ($berita->galeris as $item)
                                        <div class="col-lg-4 col-md-6">
                                            {{-- DIUBAH DI SINI --}}
                                            <a class="d-block overflow-hidden rounded shadow-sm"
                                                data-lightbox="news-gallery"
                                                data-title="{{ $item->keterangan ?? 'Galeri ' . $loop->iteration }}"
                                                href="{{ Storage::url($item->gambar) }}">

                                                {{-- 1. Bungkus gambar dengan div ratio --}}
                                                <div class="ratio ratio-4x3">
                                                    {{-- 2. Tambahkan class object-fit-cover pada gambar --}}
                                                    <img class="object-fit-cover" src="{{ Storage::url($item->gambar) }}"
                                                        alt="{{ $item->keterangan ?? 'Galeri ' . $loop->iteration }}">
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 2rem;">
                        {{-- BARU: Widget Pencarian --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-primary fw-bold text-white">Pencarian</div>
                            <div class="card-body">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Cari berita...">
                                    <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>

                        {{-- BARU: Widget Kategori --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-primary fw-bold text-white">Kategori</div>
                            <div class="list-group list-group-flush">
                                <a class="list-group-item list-group-item-action" href="#">Kurikulum</a>
                                <a class="list-group-item list-group-item-action" href="#">Prestasi Siswa</a>
                                <a class="list-group-item list-group-item-action" href="#">Info Sekolah</a>
                                <a class="list-group-item list-group-item-action" href="#">Ekstrakurikuler</a>
                            </div>
                        </div>

                        {{-- Widget Berita Populer (Sudah ada) --}}
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary fw-bold text-white">Berita Populer</div>
                            <div class="list-group list-group-flush">
                                @forelse ($beritas as $lain)
                                    <a class="list-group-item list-group-item-action d-flex align-items-center p-3"
                                        href="{{ route('berita.detail', $lain->slug) }}">
                                        <div class="flex-shrink-0">
                                            <div class="ratio ratio-1x1 overflow-hidden rounded" style="width: 70px;">
                                                <img class="object-fit-cover"
                                                    src="{{ $lain->thumbnail ? Storage::url($lain->thumbnail) : 'https://placehold.co/100x100/6c757d/fff?text=...' }}"
                                                    alt="{{ $lain->judul }}">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fw-bold mb-1">{{ Str::limit($lain->judul, 50) }}</h6>
                                            <small class="text-muted d-flex justify-content-between">
                                                <span>{{ \Carbon\Carbon::parse($lain->tanggal_publikasi)->diffForHumans() }}</span>
                                                <span><i class="bi bi-eye-fill"></i> {{ $lain->views }}</span>
                                            </small>
                                        </div>
                                    </a>
                                @empty
                                    <div class="list-group-item">Tidak ada berita lain.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
