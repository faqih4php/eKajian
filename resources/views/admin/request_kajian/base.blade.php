@extends('layouts.base')
@section('title', 'Request Kajian')
@push('css')
    <link rel="stylesheet" href="/assets/vendor/libs/animate-css/animate.css">
@endpush
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Invoice List Widget -->
            <div class="card mb-6">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                                    <div>
                                        <h4 class="mb-0">{{ $total }}</h4>
                                        <p class="mb-0">Total semua permohonan</p>
                                    </div>
                                    <div class="avatar me-sm-6 w-px-42 h-px-42">
                                        <span class="avatar-initial rounded bg-label-secondary text-heading">
                                            <i class="icon-base bx bx-file icon-26px"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-6">
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
                                    <div>
                                        <h4 class="mb-0">{{ $belumDisetujui }}</h4>
                                        <p class="mb-0">Belum disetujui</p>
                                    </div>
                                    <div class="avatar me-lg-6 w-px-42 h-px-42">
                                        <span class="avatar-initial rounded bg-label-secondary text-heading">
                                            <i class="icon-base bx bx-error-circle icon-26px"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none">
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
                                    <div>
                                        <h4 class="mb-0">{{ $diterima }}</h4>
                                        <p class="mb-0">Telah disetujui</p>
                                    </div>
                                    <div class="avatar me-sm-6 w-px-42 h-px-42">
                                        <span class="avatar-initial rounded bg-label-secondary text-heading">
                                            <i class="icon-base bx bx-check-double icon-26px"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-0">{{ $ditolak }}</h4>
                                        <p class="mb-0">Ditolak</p>
                                    </div>
                                    <div class="avatar w-px-42 h-px-42">
                                        <span class="avatar-initial rounded bg-label-secondary text-heading">
                                            <i class="icon-base bx bx-x icon-26px"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header">List Permohonan Kajian</h5>
                    <a href="{{ route('request-kajian.create') }}" type="button" class="btn btn-primary h-50 me-7">Buat
                        Permohonan</a>
                </div>
                <div class="table-responsive text-nowrap">
                    @include('components.alert')
                    <div class="container mb-3">
                        <table class="table p-2" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Tema Kajian</th>
                                    <th>Lokasi</th>
                                    <th>No. telp</th>
                                    <th>Jabatan</th>
                                    <th>Jenis Kajian</th>
                                    <th>Waktu Kajian</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($requestKajians as $requestKajian)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $requestKajian->name }}</td>
                                        <td>
                                            @if ($requestKajian->tema_kajian == null)
                                                {{ Str::limit('Tidak ada tema kajian', 10) }}
                                            @else
                                                {{ Str::limit($requestKajian->tema_kajian, 10) }}
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($requestKajian->lokasi, 10) }}</td>
                                        <td>{{ Str::limit($requestKajian->nomer, 6) }}</td>
                                        <td>{{ $requestKajian->jabatan->name }}</td>
                                        <td>{{ $requestKajian->jenis_kajian->name }}</td>
                                        <td>{{ Str::limit(\Carbon\Carbon::parse($requestKajian->waktu_kajian)->format('l, d F Y H:i'), 20) }}
                                        </td>
                                        <td>
                                            <div>
                                                @if ($requestKajian->status == 'Menunggu')
                                                    <small type="button" class="badge bg-label-warning edit-status-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editStatusModal"
                                                        data-id="{{ $requestKajian->id }}"
                                                        data-status="{{ $requestKajian->status }}">
                                                        Menunggu
                                                    </small>
                                                @elseif($requestKajian->status == 'Diterima')
                                                    <small type="button" class="badge bg-label-success edit-status-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editStatusModal"
                                                        data-id="{{ $requestKajian->id }}"
                                                        data-status="{{ $requestKajian->status }}">
                                                        Diterima
                                                    </small>
                                                @else
                                                    <small type="button" class="badge bg-label-danger edit-status-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editStatusModal"
                                                        data-id="{{ $requestKajian->id }}"
                                                        data-status="{{ $requestKajian->status }}">
                                                        Ditolak
                                                    </small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="icon-base bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('request-kajian.edit', $requestKajian->id) }}"><i
                                                            class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form
                                                        action="{{ route('request-kajian.destroy', $requestKajian->id) }}"
                                                        method="POST" class="d-inline form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn-delete">
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
        </div>
        <!-- / Content -->

        <!-- Modal -->
        <div class="modal fade animate__bounceIn bounceIn" id="editStatusModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel5">Edit Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editStatusForm" action="" method="POST"> {{-- Action akan diisi via JS --}}
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-6">
                                    <label for="statusSelect" class="form-label h6">Status</label>
                                    <select name="status" id="statusSelect"
                                        class="form-select @error('status') is-invalid @enderror">
                                        <option value="Menunggu">Menunggu</option>
                                        <option value="Diterima">Diterima</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
@push('js')
    <script src="/assets/js/ui-modals.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.form-delete');
            const editStatusButtons = document.querySelectorAll(
                '.edit-status-btn'); // Ambil semua tombol edit status
            const editStatusModal = new bootstrap.Modal(document.getElementById('editStatusModal'));
            const statusSelect = document.getElementById('statusSelect'); // Ganti ID menjadi unik
            const editStatusForm = document.getElementById('editStatusForm');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // cegah submit otomatis

                    Swal.fire({
                        ...getSwalOptions('warning', 'Hapus Data?',
                            'Data ini akan dihapus permanen.'),
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            editStatusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const requestId = this.dataset.id;
                    const currentStatus = this.dataset.status;

                    // Set nilai select box di modal
                    statusSelect.value = currentStatus;

                    // Set action URL untuk form di modal
                    editStatusForm.action =
                        `/request-kajian/${requestId}/`; // Sesuaikan dengan route update Anda

                    // Tampilkan modal
                    editStatusModal.show();
                });
            });
        });
    </script>
@endpush
