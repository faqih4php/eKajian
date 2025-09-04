@extends('layouts.base')
@section('title', 'Jadwal Kajian')
@push('css')
    <link rel="stylesheet" href="/assets/vendor/css/pages/app-calendar.css">
    <link rel="stylesheet" href="/assets/vendor/libs/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css">
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css">
    <link rel="stylesheet" href="/assets/vendor/libs/quill/editor.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/libs/%40form-validation/form-validation.css">
    <link rel="stylesheet" href="/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="/assets/vendor/libs/jquery-timepicker/jquery-timepicker.css">
    <style>
        .inline-calendar .flatpickr-calendar {
            box-shadow: none;
            margin: 0 auto;
        }
    </style>
@endpush
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card app-calendar-wrapper">
                <div class="row g-0">
                    <!-- Calendar Sidebar -->
                    <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
                        <div class="px-3 pt-2">
                            <!-- inline calendar (flatpicker) -->
                            <div class="inline-calendar"></div>
                        </div>
                        <hr class="mb-6 mx-n4 mt-3">
                        <div class="px-6 pb-2">
                            <!-- Filter -->
                            <div>
                                <h5>Jadwal Kajian Filters</h5>
                            </div>

                            <div class="form-check form-check-secondary mb-5 ms-2">
                                <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all"
                                    checked="">
                                <label class="form-check-label" for="selectAll">View All</label>
                            </div>

                            <div class="app-calendar-events-filter text-heading">
                                <div class="form-check form-check-dark mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-subuh"
                                        data-value="subuh" checked="">
                                    <label class="form-check-label" for="select-subuh">Ba'da Subuh</label>
                                </div>
                                <div class="form-check mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-dhuha"
                                        data-value="dhuha" checked="">
                                    <label class="form-check-label" for="select-dhuha">Ba'da Dhuha</label>
                                </div>
                                <div class="form-check form-check-danger mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-dhuhur"
                                        data-value="dhuhur" checked="">
                                    <label class="form-check-label" for="select-dhuhur">Ba'da Dhuhur</label>
                                </div>
                                <div class="form-check form-check-warning mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-ashar"
                                        data-value="ashar" checked="">
                                    <label class="form-check-label" for="select-ashar">Ba'da Ashar</label>
                                </div>
                                <div class="form-check form-check-success mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-maghrib"
                                        data-value="maghrib" checked="">
                                    <label class="form-check-label" for="select-maghrib">Ba'da Maghrib</label>
                                </div>
                                <div class="form-check form-check-info mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-isya"
                                        data-value="isya" checked="">
                                    <label class="form-check-label" for="select-isya">Ba'da Isya</label>
                                </div>
                                <div class="form-check form-check-twitter mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-jumat"
                                        data-value="jumat" checked="">
                                    <label class="form-check-label" for="select-jumat">Khutbah Jumat</label>
                                </div>
                                <div class="form-check form-check-linkedin mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-fitri"
                                        data-value="fitri" checked="">
                                    <label class="form-check-label" for="select-fitri">Idul Fitri</label>
                                </div>
                                <div class="form-check form-check-facebook mb-10 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-adha"
                                        data-value="adha" checked="">
                                    <label class="form-check-label" for="select-adha">Idul Adha</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Calendar Sidebar -->
                    <!-- Calendar & Modal -->
                    <div class="col app-calendar-content">
                        <div class="card shadow-none border-0">
                            <div class="card-body pb-0">
                                <!-- FullCalendar -->
                                <div id="calendar"></div>
                            </div>
                        </div>
                        <div class="app-overlay"></div>
                        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitle">Tambah Jadwal Kajian</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="eventForm" class="modal-content-scrollable">
                                        @csrf
                                        <input type="hidden" id="eventId" name="id">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <label for="name" class="form-label fs-6">Nama Pemohon</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" placeholder="Masukkan nama pemohon">
                                                    <div class="invalid-feedback">Nama pemohon harus diisi</div>
                                                </div>

                                                <div class="col-12 mb-4">
                                                    <label for="tema_kajian" class="form-label fs-6">Tema Kajian</label>
                                                    <input type="text" class="form-control" id="tema_kajian"
                                                        name="tema_kajian" placeholder="Masukkan tema kajian">
                                                    <small class="text-muted">Opsional</small>
                                                </div>

                                                <div class="col-12 mb-4">
                                                    <label for="lokasi" class="form-label fs-6">Lokasi</label>
                                                    <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Masukkan lokasi kajian"></textarea>
                                                    <div class="invalid-feedback">Lokasi harus diisi</div>
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <label for="jenis_kajian_id" class="form-label fs-6">Jenis
                                                        Kajian</label>
                                                    <select class="form-select" id="jenis_kajian_id"
                                                        name="jenis_kajian_id">
                                                        <option value="">Pilih Jenis Kajian</option>
                                                        @foreach ($jenisKajians as $jenis)
                                                            <option value="{{ $jenis->id }}">{{ $jenis->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Jenis kajian harus dipilih</div>
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <label for="tgl_kajian" class="form-label fs-6">Waktu Kajian</label>
                                                    <input type="datetime-local" class="form-control"
                                                        placeholder="YYYY-MM-DD HH:MM" id="flatpickr-datetime"
                                                        name="tgl_kajian">
                                                    <div class="invalid-feedback">Waktu kajian harus diisi</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-arrow-back me-1"></i>
                                                <span class="align-middle">Kembali</span>
                                            </button>
                                            @auth
                                                <button type="submit" class="btn btn-primary" id="saveBtn">
                                                    <i class="bx bx-check me-1"></i>
                                                    <span class="align-middle">Simpan</span>
                                                </button>
                                                <button type="button" class="btn btn-danger" id="deleteBtn" style="">
                                                    <i class="bx bx-trash me-1"></i>
                                                    <span class="align-middle">Hapus</span>
                                                </button>
                                            @endauth
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Calendar & Modal -->
                </div>
            </div>

        </div>
        <div class="container-xxl flex-grow-1 container-p-y">


            @auth
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header">List Jadwal Kajian</h5>
                        <a href="{{ route('jadwal-kajian.create') }}" type="button" class="btn btn-primary h-50 me-7">Buat
                            Jadwal</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <div class="container mb-3">
                            <table class="table p-3" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Tema Kajian</th>
                                        <th>Lokasi</th>
                                        <th>Jenis Kajian</th>
                                        <th>Waktu Kajian</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($jadwalKajians as $jadwalKajian)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jadwalKajian->name }}</td>
                                            <td>
                                                @if ($jadwalKajian->tema_kajian == null)
                                                    {{ Str::limit('Tidak ada tema kajian', 10) }}
                                                @else
                                                    {{ Str::limit($jadwalKajian->tema_kajian, 20) }}
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($jadwalKajian->lokasi, 10) }}</td>
                                            <td>{{ $jadwalKajian->jenis_kajian->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwalKajian->waktu_kajian)->format('l, d F Y H:i') }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="icon-base bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('jadwal-kajian.edit', $jadwalKajian->id) }}"><i
                                                                class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                                        <form action="{{ route('jadwal-kajian.destroy', $jadwalKajian->id) }}"
                                                            method="POST" onsubmit="return confirm('Yakin mau hapus?')"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="icon-base bx bx-trash me-1"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
        <!-- / Content -->




        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="/assets/vendor/libs/fullcalendar/fullcalendar.js"></script>
    <script src="/assets/vendor/libs/%40form-validation/popular.js"></script>
    <script src="/assets/vendor/libs/%40form-validation/bootstrap5.js"></script>
    <script src="/assets/vendor/libs/%40form-validation/auto-focus.js"></script>
    <script src="/assets/vendor/libs/select2/select2.js"></script>
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>
    <script src="/assets/vendor/libs/pickr/pickr.js"></script>
    <script src="/assets/js/forms-pickers.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calendar options berdasarkan role
            const inlineCalendar = flatpickr('.inline-calendar', {
                inline: true,
                enableTime: false,
                defaultDate: 'today',
                onChange: function(selectedDates, dateStr) {
                    // Optional: Sinkronkan dengan calendar utama
                    calendar.gotoDate(dateStr);
                }
            });
            const calendarOptions = {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                events: '{{ route("jadwal-kajian.events") }}',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                dayMaxEvents: true
            };

            // Tambahkan fitur edit hanya untuk admin
            @auth
            Object.assign(calendarOptions, {
                editable: true,
                selectable: true,
                select: function(info) {
                    $('#eventForm')[0].reset();
                    $('#eventId').val('');
                    $('#flatpickr-datetime').val(moment(info.start).format('YYYY-MM-DD HH:mm'));
                    $('#modalTitle').text('Tambah Jadwal Kajian');
                    $('#deleteBtn').hide();
                    $('#eventModal').modal('show');
                },
                eventClick: function(info) {
                    $('#eventId').val(info.event.id);
                    $('#name').val(info.event.extendedProps['name']);
                    $('#tema_kajian').val(info.event.title);
                    $('#lokasi').val(info.event.extendedProps.lokasi);
                    $('#jenis_kajian_id').val(info.event.extendedProps.jenis_kajian_id);
                    $('#flatpickr-datetime').val(moment(info.event.start).format('YYYY-MM-DD HH:mm'));
                    $('#modalTitle').text('Edit Jadwal Kajian');
                    $('#deleteBtn').show();
                    $('#eventModal').modal('show');
                },
                eventDrop: function(info) {
                    let event = info.event;
                    $.ajax({
                        url: `/events/jadwal-kajian/${event.id}`,
                        method: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            tgl_kajian: moment(event.start).format('YYYY-MM-DD HH:mm')
                        },
                        success: function() {
                            calendar.refetchEvents();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Jadwal berhasil diupdate'
                            });
                        },
                        error: function() {
                            info.revert();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Gagal mengupdate jadwal'
                            });
                        }
                    });
                }
            });
        @else
            // Untuk guest, tambahkan event click untuk melihat detail saja
            Object.assign(calendarOptions, {
                eventClick: function(info) {
                    Swal.fire({
                        title: info.event.title || 'Jadwal Kajian',
                        html: `
                    <div class="text-start">
                        <p><strong>Pemateri:</strong> ${info.event.extendedProps.name}</p>
                        <p><strong>Lokasi:</strong> ${info.event.extendedProps.lokasi}</p>
                        <p><strong>Jenis Kajian:</strong> ${info.event.extendedProps.jenis_kajian}</p>
                        <p><strong>Waktu:</strong> ${moment(info.event.start).format('DD MMMM YYYY HH:mm')}</p>
                    </div>
                `,
                        showCloseButton: true,
                        showConfirmButton: false
                    });
                }
            });
        @endauth

        // Inisialisasi calendar dengan options yang sudah disesuaikan
        let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), calendarOptions);
        calendar.render();

        @auth
        // Form submit handler hanya untuk admin
        $('#eventForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#eventId').val();
            let url = id ? `/jadwal-kajian/${id}` : '/jadwal-kajian';
            let method = id ? 'PUT' : 'POST';

            // Reset validation errors
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            $.ajax({
                url: url,
                method: method,
                data: $(this).serialize(),
                success: function(response) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById(
                        'eventModal'));
                    modal.hide();

                    calendar.refetchEvents();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Jadwal kajian berhasil disimpan'
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(field => {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}`).siblings('.invalid-feedback').text(errors[field][
                                0
                            ]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message ||
                                'Gagal menyimpan jadwal kajian'
                        });
                    }
                }
            });
        });
        @endauth
        });
    </script>
@endpush
