@extends('layouts.base')
@section('title', 'Data Request Kajian')
@section('content')
    @push('css')
    @endpush
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-lg-12 order-lg-3 col-12 align-self-end order-4">
                @include('components.alert')
                <div class="card">
                    <div class="d-flex row">
                        <div class="col-sm-6 col-md-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-7">Hallo admin! Ini adalah info detail untuk Request
                                    Kajian</h5>
                                <div class="ms-4">
                                    <p class="mb-2">Nama Pemohon: {{ $requestKajian->name }}</p>
                                    <p class="mb-2">Tema Kajian: {{ $requestKajian->tema_kajian }}</p>
                                    <p class="mb-2">Lokasi: {{ $requestKajian->lokasi }}</p>
                                    <p class="mb-2">Nomer Pemohon: {{ $requestKajian->nomer }}</p>
                                    <p class="mb-2">Jabatan Pemohon: {{ $requestKajian->jabatan->name }}</p>
                                    <p class="mb-2">Jenis Kajian: {{ $requestKajian->jenis_kajian->name }}</p>
                                    <p class="mb-6">Waktu Kajian:
                                        {{ \Carbon\Carbon::parse($requestKajian->waktu_kajian)->format('l, d F Y H:i') }}
                                    </p>
                                    <div class="d-flex justify-content-around align-items-center" style="width: 50%;">
                                        <form action="{{ route('request-kajian.approve', $requestKajian->id) }}" method="POST"
                                            class="form-approve">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-label-success"
                                                style="width: 100px; height: 35px;">Setujui</button>
                                        </form>
                                        <form action="{{ route('request-kajian.reject', $requestKajian->id) }}" method="POST"
                                            class="form-reject">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-label-danger"
                                                style="width: 100px; height: 35px;">Tolak</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 text-center text-sm-left d-flex flex-row align-items-end">
                            <div class="card-body pb-0 ps-10 text-sm-start text-center">
                                <img src="../../assets/img/illustrations/sitting-girl-with-laptop.png" height="250"
                                    alt="Target User">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form Approve
            const approveForms = document.querySelectorAll('.form-approve');

            approveForms.forEach(form => {
                form.addEventListener('submit', function(e){
                    e.preventDefault(); // cegah submit otomatis

                    Swal.fire({
                        ...getSwalOptions('info', 'Approve Request Kajian?',
                            'Data ini akan disetujui dan otomatis ditambahkan ke jadwal kajian'),
                        showCancelButton: true,
                        confirmButtonText: 'Approve!',
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
