<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    {{-- Include Page Meta --}}
    @include('web.layouts.meta')

    {{-- Include Styles --}}
    @include('web.layouts.styles')

    {{-- Title --}}
    <title>{{ $title ?? 'Title' }} | {{ config('app.name') }}</title>
</head>

<body class="bg-primary">
    <div class="authentication-page hero-1 py-5">
        <div class="bg-overlay overflow-hidden bg-transparent">
            <div class="hero-1-bg"></div>
        </div>

        <div class="container">
            <div class="row justify-content-center  mt-sm-5">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div>
                        <div class="text-center">
                            <a href="{{ route('web.home') }}" class="mb-3 d-block auth-logo">
                                <img src="{{ asset('assets/web/images/logo-light.png') }}" alt="Main Logo" height="22" class="logo">
                            </a>
                            <h5 class="font-16 text-white-50 mb-3">{{ config('app.name') }}</h5>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5>Selamat Datang</h5>
                                    <p>Silahkan login untuk masuk ke website.</p>
                                </div>

                                <div class="p-2 mt-4">
                                    <form id="login" action="{{ route('web.auth.login.process') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="credential">
                                                Username / Email / Nomor Telepon
                                            </label>
                                            <input name="credential" type="text" class="form-control" id="credential" placeholder="e.g. robert">
                                            @error('credential')
                                                <label for="credential" class="mt-2 text-danger">
                                                    {{ $message }}
                                                </label>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex">
                                                <label class="form-label" for="password">Kata Sandi</label>
                                                <div class="d-inline-block px-5 form-check form-switch">
                                                    <input name="toggle-password" class="form-check-input" type="checkbox" tabindex="-1" id="toggle-password" onchange="togglePassword(event, 'password')">
                                                </div>
                                            </div>
                                            <input name="password" type="password" class="form-control" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                            @error('password')
                                                <label for="password" class="mt-2 text-danger">
                                                    {{ $message }}
                                                </label>
                                            @enderror
                                        </div>

                                        <div class="form-check form-switch">
                                            <input name="remember" type="checkbox" class="form-check-input" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Ingat saya</label>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa-solid fa-right-to-bracket d-inline-block mr-1"></i> Masuk
                                            </button>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <a href="{{ route('web.oauth.redirect', ['driver' => OAuthDriver::GOOGLE]) }}" class="btn btn-outline-primary" type="submit">
                                                {!! OAuthDriver::htmlLabel(OAuthDriver::GOOGLE) !!}
                                            </a>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <a href="{{ route('web.auth.forgot-password.index') }}" class="text-body">
                                                <i class="fa-solid fa-lock"></i> Lupa kata sandi?
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center text-white-50">
                            <p>
                                {{ __('auth.account.question.unregistered') }}
                                <a href="{{ route('web.auth.register.index') }}" class="font-weight-semibold text-white">{{ __('auth.register.word') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Scripts --}}
    @include('web.layouts.scripts')

    {{-- Include Sweet Alert --}}
    @include('web.layouts.swals')

    {{-- Form Validation --}}
    <script>
        $('form#login').validate({
            rules: {
                credential: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                credential: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.credential') }}`),
                },
                password: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.password') }}`),
                }
            },
            errorPlacement: function(label, element) {
                label.addClass(errorClasses());
                element.parent().append(label);
            },
        });
    </script>
</body>

</html>
