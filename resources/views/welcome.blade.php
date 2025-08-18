@extends('layouts.baseAuth')
@section('title', 'Welcome')
@push('css')
<style>
    @media (max-width: 995px){
        .login-admin {
            display: none;
        }

        .login-guest {
            display: none;
        }
    }
</style>
@endpush
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo fs-3">e</span>
                                <span class="app-brand-text demo text-heading fw-bold">Kajian</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Welcome to eKajian! 👋</h4>
                        <p class="mb-6">Please choose the options what you want</p>

                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <a href="{{ route('login') }}" class="btn btn-primary mb-3 w-100">Login as <br class="login-admin">Admin</a>
                                </div>
                                <div class="col-12 col-md-6">
                                    <a href="{{ route('guest.index') }}" class="btn btn-secondary mb-3 w-100">Login as <br class="login-guest">Guest</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
@endsection
