@extends('layouts.auth.login')
@section('title','Login')

@section('content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="/" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ setting('1')->img_lg != null ? asset('storage/public/img').'/'.setting('1')->img_lg : asset('assets/images/not_found.jpg') }}"
                                            alt="" height="50">
                                    </span>
                                </a>

                                <a href="/" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ setting('1')->img_lg != null ? asset('storage/public/img').'/'.setting('1')->img_lg : asset('assets/images/not_found.jpg') }}"
                                            alt="" height="50">
                                    </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin
                                panel.</p>
                        </div>

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="emailaddress">{{ __('Email address') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    name="email" id="emailaddress" value="{{ old('email') }}" required
                                    placeholder="Enter your email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter your password" name="password" required>
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember_me"
                                        name="remember">
                                    <label class="custom-control-label" for="checkbox-signin">{{ __('Remember me')
                                        }}</label>
                                </div>
                            </div>

                            @if (setting('1')->captcha_is_active)
                            <div class="g-recaptcha" data-sitekey="{{ setting('1')->captcha_site_key }}">
                            </div>

                            @if (Session::has('g-recaptcha-response'))
                            <div class="alert alert-danger" role="alert">
                                <i class="mdi mdi-block-helper mr-2"></i> {{ Session::get('g-recaptcha-response') }}
                            </div>
                            @endif

                            @endif

                            <div class="form-group mb-0 mt-4 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                            </div>

                        </form>

                        {{-- <div class="text-center">
                            <h5 class="mt-3 text-muted">Sign in with</h5>
                            <ul class="social-list list-inline mt-3 mb-0">
                                @if (SiteHelper::social_login()->fb_is_active == true)
                                <li class="list-inline-item">
                                    <a href="{{ route('provider','facebook') }}"
                                        class="social-list-item border-primary text-primary"><i
                                            class="mdi mdi-facebook"></i></a>
                                </li>
                                @endif

                                @if (SiteHelper::social_login()->g_is_active == true)
                                <li class="list-inline-item">
                                    <a href="{{ route('provider','google') }}"
                                        class="social-list-item border-danger text-danger"><i
                                            class="mdi mdi-google"></i></a>
                                </li>
                                @endif

                                @if (SiteHelper::social_login()->git_is_active == true)
                                <li class="list-inline-item">
                                    <a href="{{ route('provider','github') }}"
                                        class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-github"></i></a>
                                </li>
                                @endif
                            </ul>
                        </div> --}}
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

@endsection