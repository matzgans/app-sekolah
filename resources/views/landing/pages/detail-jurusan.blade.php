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
                    <i class="bi bi-journal-check me-2"></i> Struktur Kurikulum
                </h2>

                @php
                    // Urutkan mapel dulu agar tampilannya konsisten
                    $mataPelajaranTersortir = $jurusan->mataPelajaran->sortBy('urutan');
                    $kelompokMapel = $mataPelajaranTersortir->groupBy('kelompok');
                @endphp

                @forelse ($kelompokMapel as $namaKelompok => $itemsKelompok)

                    <div class="accordion mb-3 shadow-sm" id="accordion-{{ Str::slug($namaKelompok) }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ Str::slug($namaKelompok) }}">
                                <button class="accordion-button fw-bold fs-5" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ Str::slug($namaKelompok) }}" type="button"
                                    aria-expanded="true" aria-controls="collapse-{{ Str::slug($namaKelompok) }}">
                                    {{ $namaKelompok }}
                                </button>
                            </h2>
                            <div class="accordion-collapse show collapse" id="collapse-{{ Str::slug($namaKelompok) }}"
                                aria-labelledby="heading-{{ Str::slug($namaKelompok) }}">
                                <div class="accordion-body p-0">

                                    @php
                                        // Group lagi berdasarkan Sub-Kelompok di dalamnya
                                        $subKelompokItems = $itemsKelompok->groupBy('sub_kelompok');
                                    @endphp

                                    @foreach ($subKelompokItems as $namaSubKelompok => $itemsSubKelompok)
                                        @if ($namaSubKelompok)
                                            <h5 class="fw-bold bg-light border-bottom mb-0 p-3">
                                                {{ $namaSubKelompok }}
                                            </h5>
                                        @endif

                                        <div class="table-responsive">
                                            <table class="table-striped table-hover mb-0 table" style="min-width: 600px;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 50%;" scope="col">Mata Pelajaran</th>
                                                        <th scope="col">Tingkat</th>
                                                        <th scope="col">Semester</th>
                                                        <th scope="col">Alokasi Waktu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($itemsSubKelompok as $mapel)
                                                        <tr>
                                                            <td>
                                                                <strong
                                                                    class="text-primary-emphasis">{{ $mapel->nama_mapel }}</strong>

                                                                @if ($mapel->kompetensi_dasar && count(array_filter($mapel->kompetensi_dasar, fn($kd) => !empty($kd['deskripsi']))) > 0)
                                                                    <a class="btn btn-link btn-sm ms-2 p-0"
                                                                        data-bs-toggle="collapse"
                                                                        href="#kd-{{ $mapel->id }}"
                                                                        title="Lihat Kompetensi Dasar" role="button"
                                                                        aria-expanded="false"
                                                                        aria-controls="kd-{{ $mapel->id }}">
                                                                        <i class="bi bi-card-list"></i> Lihat KD
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <td>{{ $mapel->tingkat }}</td>
                                                            <td>{{ $mapel->semester }}</td>
                                                            <td>{{ $mapel->alokasi_waktu_jp ?? '-' }} JP</td>
                                                        </tr>

                                                        @if ($mapel->kompetensi_dasar && count(array_filter($mapel->kompetensi_dasar, fn($kd) => !empty($kd['deskripsi']))) > 0)
                                                            <tr class="collapse" id="kd-{{ $mapel->id }}">
                                                                <td class="bg-body-tertiary p-3" colspan="4">
                                                                    <h6 class="fw-semibold">Kompetensi Dasar / Capaian
                                                                        Pembelajaran:</h6>
                                                                    <ul class="list-unstyled small mb-0">
                                                                        @foreach ((array) $mapel->kompetensi_dasar as $kd)
                                                                            @if (!empty($kd['deskripsi']))
                                                                                <li class="mb-1">
                                                                                    <i
                                                                                        class="bi bi-check-circle text-success me-2"></i>
                                                                                    @if (!empty($kd['kode']))
                                                                                        <strong>{{ $kd['kode'] }}:</strong>
                                                                                    @endif
                                                                                    {{ $kd['deskripsi'] }}
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="alert alert-info text-center shadow-sm">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        Struktur kurikulum untuk jurusan ini sedang dalam proses pembaruan.
                    </div>
                @endforelse
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
