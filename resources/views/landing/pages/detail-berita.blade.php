@extends('landing.template.index')

@section('title', $berita->judul)

@section('content')
    <!-- Hero Thumbnail -->
    <section class="position-relative bg-dark text-white">
        @if ($berita->thumbnail)
            <img class="w-100 object-fit-cover" src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}"
                style="max-height: 420px; opacity: 0.4;">
        @endif
        <div class="position-absolute top-50 start-50 translate-middle px-3 text-center">
            <h1 class="fw-bold display-5">{{ $berita->judul }}</h1>
            <div class="text-white-50 small mt-2">
                <i class="bi bi-person-circle me-1"></i> {{ $berita->user->name ?? 'Admin' }}
                <span class="mx-2">•</span>
                <i class="bi bi-calendar-event me-1"></i>
                {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}
                <span class="mx-2">•</span>
                <i class="bi bi-eye me-1"></i> {{ number_format($berita->views) }}x dibaca
            </div>
        </div>
    </section>

    <!-- Konten -->
    <section class="bg-body-tertiary py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Artikel -->
                <div class="col-lg-8">
                    <article class="p-md-5 rounded bg-white p-4 shadow-sm">
                        <!-- Isi Berita -->
                        <div class="lh-lg fs-5 text-dark mb-4">
                            {!! $berita->isi_berita !!}
                        </div>

                        <!-- Galeri -->
                        @if ($berita->galeris && $berita->galeris->count() > 0)
                            <h5 class="fw-bold mb-3"><i class="bi bi-images text-success me-2"></i> Galeri</h5>
                            <div class="row g-3 mb-4">
                                @foreach ($berita->galeris as $galeri)
                                    <div class="col-md-4 col-sm-6">
                                        <img class="img-fluid rounded shadow-sm" src="{{ Storage::url($galeri->gambar) }}"
                                            alt="Galeri {{ $loop->iteration }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Share Sosial -->
                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-share-fill me-1"></i> Bagikan Artikel:</h6>
                            <div class="d-flex gap-2">
                                <a class="btn btn-sm btn-primary"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a class="btn btn-sm btn-info text-white"
                                    href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank">
                                    <i class="bi bi-twitter-x"></i> Twitter
                                </a>
                                <a class="btn btn-sm btn-success"
                                    href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}"
                                    target="_blank">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-newspaper text-danger me-2"></i> Berita Terbaru
                            </h5>
                            @forelse (\App\Models\Berita::where('status', 'publikasi')->latest()->take(5)->get() as $item)
                                <div class="d-flex mb-3">
                                    @if ($item->thumbnail)
                                        <img class="me-3 rounded" src="{{ Storage::url($item->thumbnail) }}"
                                            alt="{{ $item->judul }}"
                                            style="width: 80px; height: 60px; object-fit: cover;">
                                    @endif
                                    <div>
                                        <a class="fw-semibold text-decoration-none text-dark"
                                            href="{{ route('berita.detail', $item->slug) }}">
                                            {{ Str::limit($item->judul, 60) }}
                                        </a>
                                        <div class="small text-muted">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal_publikasi)->translatedFormat('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted small">Belum ada berita lainnya.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
