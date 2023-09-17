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
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div>
                        <div class="text-center">
                            <a class="d-block auth-logo mb-3" href="{{ route('web.home') }}">
                                <img class="logo" src="{{ asset('assets/web/images/logo-light.png') }}" alt="Main Logo" height="22">
                            </a>
                            <h5 class="font-16 text-white-50 mb-3">{{ config('app.name') }}</h5>
                        </div>

                        {{-- Locale Switcher --}}
                        <center>
                            <div class="btn-group navbar-btn mb-3" role="group" aria-label="Locale switcher button group">
                                @foreach (AppLocale::values() as $locale)
                                    <a class="btn btn-sm {{ app()->getLocale() == $locale ? 'btn-info' : 'btn-outline-info' }}" type="button" href="{{ route('locale.switch', $locale) }}">
                                        {{ AppLocale::label($locale) }}
                                    </a>
                                @endforeach
                            </div>
                        </center>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="mt-2 text-center">
                                    <h5>{{ __('auth.password_reset.word') }}</h5>
                                    <p>
                                        @if (!$email)
                                            {{ __('auth.password_reset.description_1') }}
                                        @else
                                            {{ __('auth.password_reset.description_2') }}
                                        @endif
                                    </p>
                                </div>

                                <div class="mt-4 p-2">
                                    @if (!$email)
                                        {{-- First Step --}}
                                        <form id="forgot-password-email" action="{{ route('web.auth.forgot-password.send', app()->getLocale()) }}" method="POST">
                                            @csrf

                                            {{-- Input Email --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="email">
                                                    {{ __('general.words.attributes.email') }}
                                                </label>
                                                <input class="form-control" id="email" name="email" type="email" placeholder="e.g. email@example.com">
                                                @error('email')
                                                    <label class="text-danger mt-2" for="email">
                                                        {{ $message }}
                                                    </label>
                                                @enderror
                                            </div>

                                            <div class="d-grid mt-3">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fa-solid fa-right-to-bracket d-inline-block mr-1"></i> {{ __('general.actions.submit') }}
                                                </button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <a class="text-body" href="{{ route('web.auth.login.index', app()->getLocale()) }}">
                                                    {{ __('auth.login.back') }}
                                                </a>
                                            </div>
                                        </form>
                                    @else
                                        {{-- Second Step --}}
                                        <form id="forgot-password-reset" action="{{ route('web.auth.forgot-password.reset', app()->getLocale()) }}" method="POST">
                                            @csrf
                                            {{-- Input Email --}}
                                            <input name="email" type="hidden" value="{{ $email }}">

                                            {{-- Input Password --}}
                                            <div class="mb-3">
                                                <div class="d-flex">
                                                    <label class="form-label" for="password">
                                                        {{ __('general.words.attributes.new_password') }}
                                                    </label>
                                                    <div class="d-inline-block form-check form-switch px-5">
                                                        <input class="form-check-input" id="toggle-password" name="toggle-password" type="checkbox" tabindex="-1" onchange="togglePassword(event, 'password')">
                                                    </div>
                                                </div>
                                                <input class="form-control" id="password" name="password" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                                @error('password')
                                                    <label class="text-danger mt-2" for="password">
                                                        {{ $message }}
                                                    </label>
                                                @enderror
                                            </div>

                                            {{-- Input Password Confirmation --}}
                                            <div class="mb-3">
                                                <div class="d-flex">
                                                    <label class="form-label" for="username">
                                                        {{ __('general.words.attributes.new_password_confirmation') }}
                                                    </label>
                                                    <div class="d-inline-block form-check form-switch px-5">
                                                        <input class="form-check-input" id="toggle-password" name="toggle-password" type="checkbox" tabindex="-1" onchange="togglePassword(event, 'password_confirmation')">
                                                    </div>
                                                </div>
                                                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                                @error('password_confirmation')
                                                    <label class="text-danger mt-2" for="password_confirmation">
                                                        {{ $message }}
                                                    </label>
                                                @enderror
                                            </div>

                                            <div class="d-grid mt-3">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fa-solid fa-right-to-bracket d-inline-block mr-1"></i> {{ __('general.actions.submit') }}
                                                </button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <a class="text-body" href="{{ route('web.auth.login.index', app()->getLocale()) }}">
                                                    {{ __('auth.login.back') }}
                                                </a>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
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
        $('form#forgot-password-email').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                email: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.email') }}`),
                    email: validatorEmailMessage(`{{ __('validation.attributes.email') }}`),
                },
            },
            errorPlacement: function(label, element) {
                label.addClass(errorClasses());
                element.parent().append(label);
            },
        });

        $('form#forgot-password-reset').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 4,
                },
                password_confirmation: {
                    required: true,
                    minlength: 4,
                    equalTo: '#password',
                },
            },
            messages: {
                password: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.password') }}`),
                    minlength: validatorMinMessage(`{{ __('validation.attributes.password') }}`, 4, 'string'),
                },
                password_confirmation: {
                    required: validatorRequiredMessage(`{{ __('validation.attributes.password_confirmation') }}`),
                    minlength: validatorMinMessage(`{{ __('validation.attributes.password_confirmation') }}`, 4, 'string'),
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
