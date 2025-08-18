@extends('layouts.base')
@section('title', 'Edit Permohonan')
@push('css')
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
                        <h5 class="card-header">Edit permohonan</h5>
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
                            <form action="{{ route('request-kajian.update', $requestKajian->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="name" class="form-label fs-6">Name</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid
                                    @enderror"
                                        name="name" value="{{ old('name', $requestKajian->name) }}" id="name"
                                        placeholder="Your name">
                                </div>
                                <div class="mb-4">
                                    <label for="tema_kajian" class="form-label fs-6">Tema Kajian</label>
                                    <input type="text"
                                        class="form-control @error('tema_kajian') is-invalid
                                    @enderror"
                                        name="tema_kajian" value="{{ old('tema_kajian', $requestKajian->tema_kajian) }}"
                                        id="tema_kajian" placeholder="Sholat, Zakat, dll... (Opsional)">
                                </div>
                                <div class="mb-4">
                                    <label for="lokasi" class="form-label fs-6">Lokasi</label>
                                    <input type="text"
                                        class="form-control @error('lokasi') is-invalid
                                    @enderror"
                                        name="lokasi" id="lokasi" value="{{ old('lokasi', $requestKajian->lokasi) }}"
                                        placeholder="Sebutkan nama masjid atau lokasi kajian..">
                                </div>
                                <div class="mb-4">
                                    <label for="nomer" class="form-label fs-6">Nomer Telepon</label>
                                    <input type="text"
                                        class="form-control @error('nomer') is-invalid
                                    @enderror"
                                        name="nomer" id="nomer" value="{{ old('nomer', $requestKajian->nomer) }}"
                                        placeholder="Nomer Telepon">
                                </div>
                                <div class="mb-4">
                                    <label for="jabatan" class="form-label fs-6">Jabatan Pemohon</label>
                                    <select
                                        class="form-select @error('jabatan') is-invalid
                                    @enderror"
                                        name="jabatan" id="jabatan" value="{{ old('jabatan', $jabatan) }}">
                                        <option value="">Jabatan pemohon</option>
                                        @foreach ($jabatan as $j)
                                            <option value="{{ $j->id }}"
                                                {{ old('jabatan', $requestKajian->jabatan_id == $j->id) ? 'selected' : '' }}>
                                                {{ $j->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="jenis_kajian" class="form-label fs-6">Jenis Waktu Kajian</label>
                                    <select
                                        class="form-select @error('jenis_kajian') is-invalid
                                    @enderror"
                                        name="jenis_kajian" id="jenis_kajian"
                                        value="{{ old('jenis_kajian', $jenis_kajian) }}">
                                        <option value="">Waktu Kajian</option>
                                        @foreach ($jenis_kajian as $jk)
                                            <option value="{{ $jk->id }}"
                                                {{ old('jenis_kajian', $requestKajian->jenis_kajian_id == $jk->id) ? 'selected' : '' }}>
                                                {{ $jk->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_kajian" class="form-label fs-6">Tanggal dan Jam Kajian</label>
                                    <input type="datetime-local"
                                        class="form-control @error('waktu_kajian') is-invalid
                                    @enderror"
                                        id="tgl_kajian" value="{{ old('tgl_kajian', $requestKajian->waktu_kajian) }}"
                                        name="tgl_kajian" class="form-control">
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="form-label fs-6">Status</label>
                                    <select name="status" id="status"
                                        class="form-select @error('status') is-invalid
                                    @enderror">
                                        <option value="Menunggu" {{ old('status', $requestKajian->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="Diterima" {{ old('status', $requestKajian->status) == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="Ditolak" {{ old('status', $requestKajian->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <button type="submit" class="btn btn-primary me-2">Save</button>
                                    <a href="{{ route('request-kajian.index') }}"
                                        class="btn btn-outline-secondary">Cancel</a>
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
@endpush
