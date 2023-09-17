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
            <div class="row justify-content-center mt-sm-5">
                <div class="col-md-8">
                    <div>
                        <div class="text-center">
                            <a href="{{ route('web.home') }}" class="mb-3 d-block auth-logo">
                                <img src="{{ asset('assets/web/images/logo-light.png') }}" alt="Main Logo" height="22"
                                    class="logo">
                            </a>
                            <h5 class="font-16 text-white-50 mb-3">{{ config('app.name') }}</h5>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5>Buat Akun</h5>
                                    <p>Silahkan masukan identitas akun baru Anda.</p>
                                </div>

                                <div class="p-2 mt-4">
                                    <form id="register"
                                        action="{{ route('web.auth.register.process', ['locale' => app()->getLocale()]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-12 col-md-12 col-md-6 col-lg-6">
                                                <label class="form-label" for="credential">
                                                    Username / Email / Nomor Telepon
                                                </label>
                                                <input name="credential" type="text" class="form-control"
                                                    id="credential" placeholder="e.g. robert">
                                                <small class="text-secondary d-block mt-1">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    Pilih salah satu opsi diatas
                                                </small>
                                                    
                                                @error('credential')
                                                <label for="credential" class="mt-2 text-danger">
                                                    {{ $message }}
                                                </label>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-12 col-md-12 col-md-6 col-lg-6">
                                                <label class="form-label" for="name">
                                                    Nama
                                                </label>
                                                <input name="name" type="text" class="form-control" id="name"
                                                    placeholder="e.g. Robert Emerson">
                                                @error('name')
                                                <label for="name" class="mt-2 text-danger">
                                                    {{ $message }}
                                                </label>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-12 col-md-12 col-md-6 col-lg-6">
                                                <div class="d-flex">
                                                    <label class="form-label" for="password">
                                                        Kata Sandi
                                                    </label>
                                                    <div class="d-inline-block px-5 form-check form-switch">
                                                        <input name="toggle-password" class="form-check-input"
                                                            type="checkbox" tabindex="-1" id="toggle-password"
                                                            onchange="togglePassword(event, 'password')">
                                                    </div>
                                                </div>
                                                <input name="password" type="password" class="form-control"
                                                    id="password"
                                                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                                @error('password')
                                                <label for="password" class="mt-2 text-danger">
                                                    {{ $message }}
                                                </label>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-12 col-md-12 col-md-6 col-lg-6">
                                                <div class="d-flex">
                                                    <label class="form-label" for="password_confirmation">
                                                        Konfirmasi Kata Sandi
                                                    </label>
                                                    <div class="d-inline-block px-5 form-check form-switch">
                                                        <input name="toggle-password" class="form-check-input"
                                                            type="checkbox" tabindex="-1" id="toggle-password"
                                                            onchange="togglePassword(event, 'password_confirmation')">
                                                    </div>
                                                </div>
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    id="password_confirmation"
                                                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                                @error('password_confirmation')
                                                <label for="password_confirmation" class="mt-2 text-danger">
                                                    {{ $message }}
                                                </label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa-solid fa-right-to-bracket d-inline-block mr-1"></i>
                                                Daftar
                                            </button>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <a href="{{ route('web.oauth.redirect', ['driver' => OAuthDriver::GOOGLE]) }}"
                                                class="btn btn-outline-primary" type="submit">
                                                {!! OAuthDriver::htmlLabel(OAuthDriver::GOOGLE) !!}
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center text-white-50">
                            <p>
                                Sudah memiliki akun?
                                <a href="{{ route('web.auth.login.index') }}" class="font-weight-semibold text-white">
                                    Masuk
                                </a>
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
        $('form#register').validate({
            rules: {
                credential: {
                    required: true,
                },
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 4,
                },
                password_confirmation: {
                    required: true,
                    minlength: 4,
                    equalTo: '#password',
                }
            },
            messages: {
                credential: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.credential') }}`),
                },
                name: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.name') }}`),
                },
                email: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.email') }}`),
                    email: validatorEmailMessage(`{{ __('validation.attributes.email') }}`),
                },
                password: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.password') }}`),
                    minlength: validatorMinMessage(`{{ __('validation.attributes.password') }}`, 4, 'string'),
                },
                password_confirmation: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.password') }}`),
                    minlength: validatorMinMessage(`{{ __('validation.attributes.password') }}`, 4, 'string'),
                    equalTo: validatorConfirmedMessage(`{{ __('validation.attributes.password') }}`),
                },
            },
            errorPlacement: function(label, element) {
                label.addClass(errorClasses());
                element.parent().append(label);
            },
        });
    </script>
</body>

</html>