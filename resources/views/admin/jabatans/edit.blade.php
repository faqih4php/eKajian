@extends('layouts.base')
@section('title', 'Edit Jabatan')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-6">
                <div class="col-md-12">
                    @include('components.alert')
                    <div class="card">
                        <h5 class="card-header">Edit jabatan</h5>
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
                            <form action="{{ route('jabatans.update', $jabatan->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="mb-4">
                                    <label for="name" class="form-label fs-6">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid
                                    @enderror" name="name" value="{{ old('name', $jabatan->name) }}" id="name" placeholder="Nama Jabatan">
                                </div>
                                <div class="mb-6">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a href="{{ route('jabatans.index') }}" class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
