@extends('layouts.base')
@section('title', 'Tambah Jadwal Kajian')
@push('css')
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css">
    <link rel="stylesheet" href="/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="/assets/vendor/libs/jquery-timepicker/jquery-timepicker.css">
@endpush
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-6">
                <div class="col-md-12">
                    @include('components.alert')
                    <div class="card">
                        <h5 class="card-header">Tambah Jadwal Kajian</h5>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('jadwal-kajian.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="form-label fs-6">Nama</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid
                                    @enderror"
                                        name="name" value="{{ old('name') }}" id="name"
                                        placeholder="Nama Pemohon">
                                </div>
                                <div class="mb-4">
                                    <label for="tema_kajian" class="form-label fs-6">Tema Kajian</label>
                                    <input type="text"
                                        class="form-control @error('tema_kajian') is-invalid
                                    @enderror"
                                        name="tema_kajian" value="{{ old('tema_kajian') }}" id="tema_kajian"
                                        placeholder="Sholat, Zakat, dll... (opsional)">
                                </div>
                                <div class="mb-4">
                                    <label for="lokasi" class="form-label fs-6">Lokasi</label>
                                    <input type="text"
                                        class="form-control @error('lokasi') is-invalid
                                    @enderror"
                                        name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                                        placeholder="Sebutkan nama masjid atau lokasi kajian..">
                                </div>
                                <div class="mb-4">
                                    <label for="jenis_kajian" class="form-label fs-6">Jenis Waktu Kajian</label>
                                    <select
                                        class="form-select @error('jenis_kajian') is-invalid
                                    @enderror"
                                        name="jenis_kajian" id="jenis_kajian" value="{{ old('jenis-kajian') }}">
                                        <option value="">Waktu Kajian</option>
                                        @foreach ($jenisKajians as $jenisKajian)
                                            <option value="{{ $jenisKajian->id }}"
                                                {{ old('jenis_kajian') == $jenisKajian->id ? 'selected' : '' }}>
                                                {{ $jenisKajian->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_kajian" class="form-label fs-6">Tanggal dan Jam Kajian</label>
                                    <input type="datetime-local"
                                        class="form-control @error('tgl_kajian') is-invalid
                                    @enderror"
                                        value="{{ old('tgl_kajian') }}" placeholder="YYYY-MM-DD HH:MM"
                                        id="flatpickr-datetime" name="tgl_kajian">
                                </div>
                                <div class="mb-6">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="{{ route('jadwal-kajian.index') }}"
                                        class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="/assets/vendor/libs/jquery-timepicker/jquery-timepickerx.js"></script>
    <script src="/assets/vendor/libs/pickr/pickr.js"></script>
    <script src="/assets/js/forms-pickers.js"></script>
@endpush
