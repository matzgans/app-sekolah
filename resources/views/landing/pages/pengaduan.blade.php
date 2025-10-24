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

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- KOLOM KIRI (FORM PENGADUAN) --}}
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-md-5 p-4">
                            <h3 class="fw-bold mb-4">Buat Pengaduan Baru</h3>

                            <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                                @csrf
                                {{-- ... (Isi form ini sudah benar semua, tidak saya ubah) ... --}}
                                <div class="mb-3">
                                    <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                                    <input class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        id="nama_lengkap" name="nama_lengkap" type="text" placeholder="Cth : John Doe"
                                        required>
                                    @error('nama_lengkap')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="status_pengirim">Saya adalah...</label>
                                    <select class="form-select @error('status_pengirim') is-invalid @enderror"
                                        id="status_pengirim" name="status_pengirim" required>
                                        <option value="" selected disabled>-- Pilih Status Anda --</option>
                                        <option value="siswa">Siswa</option>
                                        <option value="orang_tua">Orang Tua Siswa</option>
                                        <option value="calon_siswa">Calon Siswa</option>
                                    </select>
                                    @error('status_pengirim')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="kontak_pengirim">Email atau No. WhatsApp
                                        Aktif</label>
                                    <input class="form-control @error('kontak_pengirim') is-invalid @enderror"
                                        id="kontak_pengirim" name="kontak_pengirim" type="text"
                                        placeholder="Cth : john.doe@example.com atau 081234567890" required>
                                    <div class="form-text">Kami akan mengirimkan notifikasi balasan ke sini.</div>
                                    @error('kontak_pengirim')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="jenis_pengaduan">Jenis Pengaduan</label>
                                    <select class="form-select @error('jenis_pengaduan') is-invalid @enderror"
                                        id="jenis_pengaduan" name="jenis_pengaduan" required>
                                        <option value="" selected disabled>-- Pilih Jenis Pengaduan --</option>
                                        <option value="pengaduan">Pengaduan</option>
                                        <option value="saran">Saran</option>
                                        <option value="pertanyaan">Pertanyaan</option>
                                    </select>
                                    @error('jenis_pengaduan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="kategori_pengaduan">Kategori Pengaduan</label>
                                    <select class="form-select @error('kategori_pengaduan') is-invalid @enderror"
                                        id="kategori_pengaduan" name="kategori_pengaduan" required>
                                        <option value="" selected disabled>-- Pilih Kategori Pengaduan --</option>
                                        <option value="ekstrakurikuler">Extrakulikuler</option>
                                        <option value="guru">Guru</option>
                                        <option value="Fasilitas">Fasilitas</option>
                                        <option value="prestasi">Prestasi</option>
                                        <option value="galeri">Galeri</option>
                                        <option value="pengumuman">Pengumuman</option>
                                        <option value="berita">Berita</option>
                                        <option value="jurusan">Jurusan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    @error('kategori_pengaduan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label class="form-label" for="subjek">Subjek/Judul Pengaduan</label>
                                    <input class="form-control @error('subjek') is-invalid @enderror" id="subjek"
                                        name="subjek" type="text"
                                        placeholder="Cth : Pengaduan tentang kegiatan ekstrakurikuler" required>
                                    @error('subjek')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="isi_pesan">Isi Pesan/Aduan</label>
                                    <textarea class="form-control @error('isi_pesan') is-invalid @enderror" id="isi_pesan" name="isi_pesan" rows="5"
                                        required>
                                    </textarea>
                                    @error('isi_pesan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="file_pengaduan">Lampirkan Dokumen Pendukung
                                        (Opsional)</label>
                                    <input class="form-control @error('file_pengaduan') is-invalid @enderror"
                                        id="file_pengaduan" name="file_pengaduan" type="file"
                                        accept="application/pdf, image/*">
                                    <div class="form-text text-warning">Anda dapat mengirimkan dokumen pendukung seperti
                                        foto,
                                        atau dokumen lainnya yang mendukung pengaduan Anda.</div>
                                    @error('file_pengaduan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary w-100 fw-bold py-2" type="submit">Kirim
                                    Pengaduan</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (CEK STATUS & HASIL) --}}
                <div class="col-lg-5">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4">Cek Status Pengaduan</h3>

                            <form method="GET" action="{{ route('pengaduan.index') }}">
                                {{-- 1. PERBAIKAN: @csrf DIHAPUS DARI SINI KARENA INI METHOD GET --}}
                                <div class="mb-3">
                                    <label class="form-label" for="nomor_tiket">Masukkan Nomor Tiket Anda</label>
                                    <input class="form-control" id="nomor_tiket" name="nomor_tiket" type="text"
                                        value="{{ request('nomor_tiket') }}" placeholder="Contoh: Tiket-123456" required>
                                </div>
                                <button class="btn btn-success w-100" type="submit">Cek Status</button>
                            </form>
                        </div>
                    </div>


                    @if (isset($tiket))
                        <hr class="my-4">
                        <h4 class="fw-bold">Riwayat Tiket: {{ $tiket->no_tiket }}</h4>
                        <p>
                            <strong>Subjek:</strong> {{ $tiket->subjek }}<br>

                            {{-- 2. PERBAIKAN: Format 'tanggal_pengaduan' --}}
                            <strong>Tanggal Pengaduan:</strong>
                            {{ \Carbon\Carbon::parse($tiket->tanggal_pengaduan)->format('d M Y') }}<br>

                            <strong>Status:</strong>
                            <span
                                class="badge @if ($tiket->status_tiket == 'pending') bg-warning text-dark
                                @elseif($tiket->status_tiket == 'proses') bg-info text-dark
                                @elseif($tiket->status_tiket == 'selesai') bg-success
                                @elseif($tiket->status_tiket == 'ditolak') bg-danger @endif">
                                {{ ucfirst($tiket->status_tiket) }}
                            </span>
                        </p>

                        <div class="riwayat-chat-container">

                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">({{ $tiket->nama_lengkap }})</h6>
                                    <p class="card-text">{{ $tiket->isi_pesan }}</p>
                                    @if ($tiket->file_pengaduan)
                                        <a href="{{ Storage::url($tiket->file_pengaduan) }}" target="_blank">Lihat
                                            Lampiran</a>
                                    @endif
                                    {{-- 'created_at' sudah benar karena otomatis jadi Carbon object --}}
                                    <small class="text-muted">{{ $tiket->created_at->format('d M Y, H:i') }}</small>
                                </div>
                            </div>

                            @if ($tiket->tanggapan)
                                <div class="card border-primary mb-3 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold text-primary">Admin/Staf Sekolah</h6>
                                        <p class="card-text">{{ $tiket->tanggapan }}</p>

                                        {{-- 3. PERBAIKAN: Format 'tanggal_tanggapan' --}}
                                        <small
                                            class="text-muted">{{ $tiket->tanggal_tanggapan ? \Carbon\Carbon::parse($tiket->tanggal_tanggapan)->format('d M Y') : '' }}</small>
                                    </div>
                                </div>
                            @endif

                            @if ($tiket->status_tiket == 'ditolak' && $tiket->alasan_ditolak)
                                <div class="card border-danger mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold text-danger">Keterangan Penolakan</h6>
                                        <p class="card-text">{{ $tiket->alasan_ditolak }}</p>
                                    </div>
                                </div>
                            @endif

                            @if (($tiket->status_tiket == 'pending' || $tiket->status_tiket == 'proses') && !$tiket->tanggapan)
                                <div class="card border-info mb-3">
                                    <div class="card-body text-center">
                                        <p class="card-text text-info-dark mb-0">Tiket Anda sedang ditinjau oleh Admin.
                                            Silakan cek kembali nanti.</p>
                                    </div>
                                </div>
                            @endif

                        </div>
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
