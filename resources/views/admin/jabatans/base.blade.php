@extends('layouts.base')
@section('title', 'List Jabatan')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Invoice List Widget -->
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header">List Jabatan</h5>
                    <a href="{{ route('jabatans.create') }}" type="button" class="btn btn-primary h-50 me-7">Buat
                        Jabatan Baru</a>
                </div>
                <div class="table-responsive text-nowrap">
                    @include('components.alert')
                    <div class="container mb-3">
                        <table class="table p-3" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($jabatans as $jabatan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jabatan->name }}</td>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="icon-base bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('jabatans.edit', $jabatan->id) }}"><i
                                                            class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form
                                                        action="{{ route('jabatans.destroy', $jabatan->id) }}"
                                                        method="POST"
                                                        class="d-inline form-delete">
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



        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.form-delete');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // cegah submit otomatis

            Swal.fire({
                ...getSwalOptions('warning', 'Hapus Data?', 'Data ini akan dihapus permanen.'),
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
});
</script>
@endpush
