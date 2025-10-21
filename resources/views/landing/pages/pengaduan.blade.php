@extends('landing.template.index')

@section('title', 'Layanan Pengaduan')

@section('content')
    <section class="bg-light py-5">
        <div class="container">
            <div class="mb-5 text-center">
                <h1 class="fw-bold">Layanan Pengaduan</h1>
                <p class="lead text-muted">Kirim pertanyaan atau aduan Anda langsung kepada kami, atau cek status aduan Anda
                    yang sudah ada.</p>
            </div>

            <div class="row g-5">

                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-md-5 p-4">
                            <h3 class="fw-bold mb-4">Buat Pengaduan Baru</h3>

                            <form method="POST" action="">
                                @csrf <div class="mb-3">
                                    <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                                    <input class="form-control" id="nama_lengkap" name="nama_lengkap" type="text"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="status_pengirim">Saya adalah...</label>
                                    <select class="form-select" id="status_pengirim" name="status_pengirim" required>
                                        <option value="" selected disabled>-- Pilih Status Anda --</option>
                                        <option value="siswa">Siswa</option>
                                        <option value="orang_tua">Orang Tua Siswa</option>
                                        <option value="calon_siswa">Calon Siswa</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="kontak_pengirim">Email atau No. WhatsApp Aktif</label>
                                    <input class="form-control" id="kontak_pengirim" name="kontak_pengirim" type="text"
                                        required>
                                    <div class="form-text">Kami akan mengirimkan notifikasi balasan ke sini.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="subjek">Subjek/Judul Pengaduan</label>
                                    <input class="form-control" id="subjek" name="subjek" type="text" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="isi_pesan">Isi Pesan/Aduan</label>
                                    <textarea class="form-control" id="isi_pesan" name="isi_pesan" rows="5" required></textarea>
                                </div>

                                <button class="btn btn-primary w-100 fw-bold py-2" type="submit">Kirim Pengaduan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4">Cek Status Pengaduan</h3>

                            <form method="GET" action="">
                                <div class="mb-3">
                                    <label class="form-label" for="nomor_tiket">Masukkan Nomor Tiket Anda</label>
                                    <input class="form-control" id="nomor_tiket" name="nomor_tiket" type="text"
                                        value="" placeholder="Contoh: PENGADUAN-00123" required>
                                </div>
                                <button class="btn btn-success w-100" type="submit">Cek Status</button>
                            </form>
                        </div>
                    </div>

                    @if (isset($tiket))
                        <hr class="my-4">
                        <h4 class="fw-bold">Riwayat Tiket: {{ $tiket->nomor_tiket }}</h4>
                        <p><strong>Subjek:</strong> {{ $tiket->subjek }}<br>
                            <strong>Status:</strong> <span class="badge bg-info text-dark">{{ $tiket->status_tiket }}</span>
                        </p>

                        <div class="riwayat-chat-container"
                            style="max-height: 400px; overflow-y: auto; padding-right: 10px;">

                            @foreach ($tiket->replies->sortBy('created_at') as $balasan)
                                @if ($balasan->pengirim == 'user')
                                    <div class="card bg-light mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold">Anda ({{ $tiket->nama_pengirim }})</h6>
                                            <p class="card-text">{{ $balasan->isi_pesan }}</p>
                                            <small
                                                class="text-muted">{{ $balasan->created_at->format('d M Y, H:i') }}</small>
                                        </div>
                                    </div>
                                @else
                                    <div class="card border-primary mb-3 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold text-primary">Admin/Staf Sekolah</h6>
                                            <p class="card-text">{{ $balasan->isi_pesan }}</p>
                                            <small
                                                class="text-muted">{{ $balasan->created_at->format('d M Y, H:i') }}</small>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        @if ($tiket->status_tiket != 'selesai')
                            <hr>
                            <h5 class="fw-bold">Tulis Balasan Baru</h5>
                            <form method="POST" action="">
                                @csrf
                                <div class="mb-3">
                                    <textarea class="form-control" name="isi_pesan" rows="3" placeholder="Tulis balasan Anda di sini..." required></textarea>
                                </div>
                                <button class="btn btn-primary btn-sm" type="submit">Kirim Balasan</button>
                            </form>
                        @endif
                    @elseif(request('nomor_tiket'))
                        <hr class="my-4">
                        <div class="alert alert-danger">
                            Tiket dengan nomor <strong>{{ request('nomor_tiket') }}</strong> tidak ditemukan.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
