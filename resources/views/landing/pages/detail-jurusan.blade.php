@extends('landing.template.index')

@section('title', $jurusan->nama_jurusan)

@section('content')
    <section class="jurusan-detail bg-body-tertiary py-5">
        <div class="container">

            <div class="mb-5 text-center">
                <h1 class="display-5 fw-bold text-primary">{{ $jurusan->nama_jurusan }}</h1>
            </div>

            <div class="row g-4 g-lg-5">
                <div class="col-lg-8">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-md-5 p-4">
                            <h4 class="card-title fw-bold text-primary-emphasis mb-4">
                                <i class="bi bi-info-circle-fill me-2"></i> Tentang Jurusan
                            </h4>
                            <div class="text-body-secondary" style="text-align: justify;">
                                {!! $jurusan->deskripsi !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary fw-bold text-white">
                            <i class="bi bi-list-check me-2"></i> Informasi Penting
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Kepala Jurusan</span>
                                <strong class="text-end">{{ $jurusan->nama_kepala_jurusan }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Akreditasi</span>
                                <span class="badge bg-success rounded-pill">A</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Status</span>
                                <span class="badge bg-info rounded-pill">Aktif</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4">
                <h2 class="fw-bold mb-4 text-center">
                    <i class="bi bi-images me-2"></i> Galeri Kegiatan
                </h2>

                <div class="row g-4">
                    @forelse ($jurusan->galeris as $item)
                        <div class="col-lg-4 col-md-6">
                            <a class="d-block overflow-hidden rounded shadow-sm" data-lightbox="gallery-jurusan"
                                data-title="Galeri {{ $loop->iteration }}" href="{{ Storage::url($item->gambar) }}">

                                <div class="ratio ratio-4x3">
                                    <img class="object-fit-cover" src="{{ Storage::url($item->gambar) }}"
                                        alt="Galeri {{ $loop->iteration }}">
                                </div>

                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center shadow-sm">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                Belum ada galeri kegiatan untuk jurusan ini.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </section>
@endsection
