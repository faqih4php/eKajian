@extends('layouts.base')
@section('title', 'Dashboard Admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            @include('components.alert')
            <div class="row">
                <div class="col-xxl-8 mb-6 order-0">
                    <div class="card">
                        <div class="d-flex align-items-start row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary mb-3">Selamat Pagi Admin! 🎉</h5>
                                    <p class="mb-6">Kamu ingin mengecek apa hari ini?<br>Cek jadwal dan permohonan kajian
                                        di tombol bawah ini.</p>

                                    <a href="{{ route('jadwal-kajian.index') }}" class="btn btn-sm btn-label-primary">Lihat
                                        Kajian</a>
                                    <a href="{{ route('request-kajian.index') }}" class="btn btn-sm btn-label-primary">Lihat
                                        Permohonan</a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-6">
                                    <img src="/assets/img/illustrations/man-with-laptop.png" height="175"
                                        class="scaleX-n1-rtl" alt="View Badge User">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 col-xxl-4 mb-6 order-1">
                    <div class="card">
                        <div class="card-widget-separator-wrapper">
                            <div class="card-body card-widget-separator">
                                <div class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
                                    <div class="d-flex flex-column">
                                        <h4 class="mb-0">{{ $belumDisetujui }}</h4>
                                        <p class="mb-0">Data permohonan kajian yang belum<br> disetujui</p>
                                        <a href="{{ route('request-kajian.index') }}" class="btn btn-sm btn-label-primary mt-7">Lihat
                                        Permohonan</a>
                                    </div>
                                    <div class="avatar me-lg-6 w-px-42 h-px-42">
                                        <span class="avatar-initial rounded bg-label-secondary text-heading">
                                            <i class="icon-base bx bx-error-circle icon-26px"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>
@endsection
