@extends('landing.template.index')

@section('title', $pengumuman->judul)

@section('content')
    <section class="bg-light py-5">
        <div class="container">

            <div class="row g-4">
                {{-- KOLOM KIRI: Konten Utama --}}
                <div class="col-lg-8">
                    <div class="card h-100 border-0 shadow-sm">
                        {{-- Gambar Header Detail --}}
                        @if ($pengumuman->gambar)
                            <img class="card-img-top" src="{{ Storage::url($pengumuman->gambar) }}"
                                alt="{{ $pengumuman->judul }}" style="max-height: 400px; object-fit: cover;">
                        @endif

                        <div class="card-body p-md-5 p-4">
                            {{-- Meta Data (Tipe & Tanggal) --}}
                            <div class="d-flex align-items-center mb-3 gap-2">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                    {{ ucfirst($pengumuman->tipe) }}
                                </span>
                                <span class="text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $pengumuman->created_at->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            {{-- Judul --}}
                            <h1 class="fw-bold text-dark mb-4">{{ $pengumuman->judul }}</h1>

                            {{-- Isi Konten --}}
                            <article class="blog-post text-secondary" style="line-height: 1.8; text-align: justify;">
                                {!! $pengumuman->deskripsi !!}
                            </article>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: Sidebar Informasi & Jadwal --}}
                <div class="col-lg-4">
                    {{-- Card Jadwal --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="fw-bold text-primary-emphasis mb-0">
                                <i class="bi bi-calendar-check me-2"></i> Jadwal Terkait
                            </h5>
                        </div>
                        <div class="card-body">
                            @if ($pengumuman->jadwals && $pengumuman->jadwals->count() > 0)
                                <div class="vstack gap-2">
                                    @foreach ($pengumuman->jadwals as $jadwal)
                                        <div class="d-flex align-items-start border-bottom mb-2 pb-2">
                                            <div class="text-muted me-3 text-center">
                                                <i class="bi bi-calendar-event fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0">{{ $jadwal->hari }}</h6>
                                                <small class="text-muted">
                                                    {{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') : '-' }}
                                                </small>
                                                <div class="badge bg-light text-dark mt-1 border">
                                                    <i class="bi bi-clock me-1"></i> {{ $jadwal->waktu }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-muted py-3 text-center">
                                    <i class="bi bi-calendar-x fs-1 opacity-25"></i>
                                    <p class="small mb-0 mt-2">Tidak ada jadwal spesifik untuk pengumuman ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
