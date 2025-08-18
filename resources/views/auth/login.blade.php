@extends('layouts.baseAuth')
@section('title', 'Login Admin')
@section('content')
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="index.html" class="app-brand auth-cover-brand gap-2">
            <span class="app-brand-logo demo fs-3">e</span>
            <span class="app-brand-text demo text-heading fw-bold">Kajian</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="../../assets/img/illustrations/boy-with-rocket-light.png" class="img-fluid" alt="Login image"
                        width="700" data-app-dark-img="illustrations/boy-with-rocket-dark.png"
                        data-app-light-img="illustrations/boy-with-rocket-light.png">
                </div>
            </div>
            <!-- /Left Text -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">

                <div class="w-px-400 mx-auto mt-sm-12 mt-8">
                    <a href="{{ route('welcome') }}" class="nav-item btn btn-primary mb-10" style="color: #ffffff;"><i class="icon-base bx bx-left-arrow-alt icon-md me-2" style="color: #ffffff;"></i>Back</a>
                    <h4 class="mb-1">Welcome to eKajian! 👋</h4>
                    <p class="mb-6">Please sign-in to your account and start the adventure</p>

                    <form action="{{ route('login.post') }}" id="formAuthentication" class="mb-6" method="POST"
                        novalidate>
                        @csrf
                        <div class="mb-6 form-control-validation">
                            <label for="email" class="form-label">Email or Username</label>
                            <input type="text"
                                class="form-control @error('email') is-invalid
                            @enderror"
                                id="email" name="email" placeholder="Enter your email or username"
                                value="{{ old('email') }}" autofocus="">
                        </div>
                        <div class="form-password-toggle form-control-validation">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password"
                                    class="form-control @error('password') is-invalid
                                @enderror"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password">
                                <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="my-7">
                            <div class="d-flex justify-content-between">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember"
                                        value="1">
                                    <label class="form-check-label" for="remember-me">Remember Me</label>
                                </div>
                                <a href="">
                                    <p class="mb-0">Forgot Password?</p>
                                </a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
                    </form>
                    {{--
                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="auth-register-cover.html">
                            <span>Create an account</span>
                        </a>
                    </p>

                    <div class="divider my-6">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-circle btn-text-facebook me-1_5">
                            <i class="icon-base bx bxl-facebook-circle icon-20px"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-circle btn-text-twitter me-1_5">
                            <i class="icon-base bx bxl-twitter icon-20px"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-circle btn-text-github me-1_5">
                            <i class="icon-base bx bxl-github icon-20px"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-circle btn-text-google-plus">
                            <i class="icon-base bx bxl-google icon-20px"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
@endsection
