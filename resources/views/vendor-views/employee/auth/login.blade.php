<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ translate('staff_login') }} | {{ $web_config['company_name'] }}</title>
    <link rel="shortcut icon" href="{{ getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type:'backend-logo') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/css/google-fonts.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/css/theme.minc619.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/css/style.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/assets/back-end/css/toastr.css') }}">

    <style>
        :root { --c1: {{ $web_config['primary_color'] }}; }
    </style>
    {!! ToastMagic::styles() !!}
</head>

<body>
<main id="content" role="main" class="main">
    <div class="auth-wrapper">

        {{-- Left branding panel --}}
        <div class="auth-wrapper-left"
             style="background: url('{{ dynamicAsset(path: 'public/assets/back-end/img/login-bg.png') }}') no-repeat center center / cover">
            <div class="auth-left-cont">
                @php($eCommerceLogo = getWebConfig(name: 'company_web_logo'))
                <a class="d-inline-flex mb-5" href="{{ route('home') }}">
                    <img width="310" src="{{ getStorageImages(path: $eCommerceLogo, type:'backend-logo') }}" alt="Logo">
                </a>
                <h2 class="title">
                    {{ translate('vendor_staff_portal') }}
                    <span class="font-weight-bold c1 d-block text-capitalize">
                        {{ translate('sign_in_to_your_workspace') }}
                    </span>
                </h2>
            </div>
        </div>

        {{-- Right login form panel --}}
        <div class="auth-wrapper-right">
            <div class="auth-wrapper-form">
                <div class="d-block d-lg-none mb-4">
                    <a href="{{ route('home') }}">
                        <img width="100" src="{{ getStorageImages(path: $eCommerceLogo, type:'backend-logo') }}" alt="Logo">
                    </a>
                </div>

                {{-- Staff badge --}}
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span class="badge text-bg-primary px-3 py-2 fs-6">
                        <i class="fi fi-sr-user me-1"></i>
                        {{ translate('staff_login') }}
                    </span>
                </div>

                <div class="mb-4">
                    <h1 class="display-4">{{ translate('sign_in') }}</h1>
                    <p class="text-muted">{{ translate('enter_your_staff_credentials_to_access_your_vendor_dashboard') }}</p>
                </div>

                <form action="{{ route('vendor.employee.auth.login.submit') }}" method="POST">
                    @csrf

                    {{-- Email --}}
                    <div class="js-form-message form-group">
                        <label class="input-label" for="staffEmail">{{ translate('your_email') }}</label>
                        <input type="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               name="email"
                               id="staffEmail"
                               placeholder="email@address.com"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="js-form-message form-group">
                        <label class="input-label" for="staffPassword">{{ translate('password') }}</label>
                        <div class="input-group input-group-merge">
                            <input type="password"
                                class="js-toggle-password form-control form-control-lg @error('password') is-invalid @enderror"
                                name="password"
                                id="staffPassword"
                                placeholder="{{ translate('8+_characters_required') }}"
                                data-hs-toggle-password-options='{
                                    "target": "#changePassTarget",
                                    "defaultClass": "tio-visible-outlined",
                                    "showClass": "tio-hidden-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                }'
                                required>
                            <div id="changePassTarget" class="input-group-append">
                                <a class="input-group-text" href="javascript:void(0)">
                                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                                </a>
                            </div>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember me --}}
                    <div class="form-group mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember">
                            <label class="custom-control-label text-muted" for="rememberMe">
                                {{ translate('remember_me') }}
                            </label>
                        </div>
                    </div>



                    {{-- Submit --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            {{ translate('sign_in') }}
                        </button>
                    </div>

                    {{-- Link back to vendor login --}}
                    <div class="text-center mt-4">
                        <p class="text-muted small">
                            {{ translate('are_you_a_vendor') }}?
                            <a href="{{ route('vendor.auth.login') }}" class="text-primary fw-semibold">
                                {{ translate('vendor_login_here') }}
                            </a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<span id="route-get-session-recaptcha-code"
      data-route="{{ route('get-session-recaptcha-code') }}"
      data-mode="{{ env('APP_MODE') }}"></span>

<script src="{{ dynamicAsset(path: 'public/assets/back-end/js/vendor.min.js') }}"></script>
<script src="{{ dynamicAsset(path: 'public/assets/back-end/js/theme.min.js') }}"></script>
<script src="{{ dynamicAsset(path: 'public/assets/back-end/js/toastr.js') }}"></script>
<script src="{{ dynamicAsset(path: 'public/assets/back-end/js/vendor/login.js') }}"></script>

{!! ToastMagic::scripts() !!}

@if ($errors->any())
    <script>
        'use strict';
        @foreach($errors->all() as $error)
            toastMagic.error('{{ $error }}');
        @endforeach
    </script>
@endif
</body>
</html>