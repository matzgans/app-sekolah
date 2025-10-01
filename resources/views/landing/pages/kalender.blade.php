@extends('landing.template.index')

@section('title', 'Kalender')

@section('content')
    <section class="bg-light py-5">
        <div class="container">
            <h1 class="fw-bold mb-3 text-center">Kalender</h1>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Menampilkan Kalender dari setiap jadwal ekstrakurikuler, pengumuman, dan kegiatan lainnya.</h3>
                </div>

                <div class="col-md-12">
                    <div class="calendar w-100" id="calendar"></div>
                </div>
            </div>
        </div>


    </section>
    <div class="modal fade" id="eventDetailModal" aria-labelledby="modalTitle" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Detail Kegiatan</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalBodyContent">
                        <p><strong>Tipe:</strong> <span class="badge bg-primary" id="modalTipe"></span></p>
                        <p><strong>Hari:</strong> <span id="modalHari"></span></p>
                        <p><strong>Waktu:</strong> <span id="modalWaktu"></span></p>
                        <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
                        <p><strong>Deskripsi:</strong> <span id="modalDeskripsi"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            // Inisialisasi Modal Bootstrap
            var modal = new bootstrap.Modal(document.getElementById('eventDetailModal'));

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: @json($events),

                // FUNGSI BARU UNTUK MENANGANI KLIK EVENT
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Mencegah browser membuka link (jika ada)

                    // Mengambil data dari event yang di-klik
                    let title = info.event.title;
                    let props = info.event.extendedProps; // Data tambahan ada di sini
                    let startDate = info.event.start;

                    // Mengisi konten modal dengan data
                    document.getElementById('modalTitle').textContent = title;
                    document.getElementById('modalTipe').textContent = props.tipe;
                    document.getElementById('modalHari').textContent = props.hari;
                    document.getElementById('modalWaktu').textContent = props.waktu;
                    document.getElementById('modalDeskripsi').textContent = props.description;
                    // Format tanggal agar lebih mudah dibaca
                    document.getElementById('modalTanggal').textContent = startDate.toLocaleDateString(
                        'id-ID', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                    // Menampilkan modal
                    modal.show();
                }
            });
            calendar.render();
        });
    </script>
@endpush
