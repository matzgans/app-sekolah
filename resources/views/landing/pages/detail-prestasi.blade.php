@extends('landing.template.index')

@section('title', $prestasi->judul)

@section('content')
    <!-- Detail Prestasi -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="content p-md-5 rounded bg-white p-4 shadow-sm">

                <!-- Judul -->
                <h1 class="fw-bold mb-3 text-center">{{ $prestasi->judul }}</h1>

                <!-- Meta -->
                <p class="text-muted small mb-4 text-center">
                    <i class="bi bi-calendar-event"></i> {{ $prestasi->tahun }}
                </p>

                <!-- Thumbnail -->
                <div class="mb-4 text-center">
                    <img class="img-fluid rounded shadow-sm"
                        src="{{ $prestasi->thumbnail ? Storage::url($prestasi->thumbnail) : 'https://placehold.co/1000x500/6c757d/fff?text=Thumbnail+Prestasi' }}"
                        alt="{{ $prestasi->judul }}">
                </div>

                <!-- Isi Prestasi -->
                <article class="fs-6 lh-lg mb-5 text-justify">
                    {!! $prestasi->deskripsi !!}
                </article>

                <!-- Galeri -->
                @if ($prestasi->galeris->count() > 0)
                    <h5 class="fw-bold border-start border-primary mb-3 border-4 ps-3">Galeri Terkait</h5>
                    <div class="row g-3">
                        @foreach ($prestasi->galeris as $item)
                            <div class="col-md-4 col-sm-6">
                                <a href="{{ Storage::url($item->gambar) }}" target="_blank">
                                    <img class="img-fluid hover-shadow rounded shadow-sm"
                                        src="{{ Storage::url($item->gambar) }}" alt="Galeri {{ $loop->iteration }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Navigasi ke Prestasi Lain -->
                <div class="border-top mt-5 pt-4">
                    <h6 class="fw-bold text-muted mb-3">Prestasi Lainnya</h6>
                    <div class="row row-cols-1 row-cols-md-3 g-3">
                        @foreach ($prestasis ?? [] as $lain)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img class="card-img-top rounded-top"
                                        src="{{ $lain->thumbnail ? Storage::url($lain->thumbnail) : 'https://placehold.co/400x250/6c757d/fff?text=Prestasi' }}"
                                        alt="{{ $lain->judul }}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <p class="small text-muted mb-1">{{ $lain->tahun }}</p>
                                        <h6 class="fw-bold">{{ Str::limit($lain->judul, 60) }}</h6>
                                        <a class="stretched-link" href="{{ route('prestasi.detail', $lain->slug) }}"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
