<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    {{-- Include Page Meta --}}
    @include('cms.layouts.meta')

    {{-- Include Styles --}}
    @include('cms.layouts.styles')

    {{-- Title --}}
    <title>Masuk | {{ config('app.name') }}</title>
</head>

<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex justify-content-end flex-wrap">
        <div class="app-auth-background"></div>
        <div class="app-auth-container">
            <form id="login" action="{{ route('cms.auth.login.process') }}" method="POST">
                @csrf

                <div class="logo">
                    <a href="{{ request()->url() }}">
                        Masuk
                    </a>
                </div>

                <p class="auth-description">
                    Silahkan login untuk masuk ke website.
                </p>

                <div class="auth-credentials m-b-xxl">
                    {{-- Input Username --}}
                    <div class="m-b-md">
                        <label class="form-label d-block" id="label-username" for="username">Username</label>
                        <input class="form-control" id="username" name="username" type="text" aria-describedby="label-username" placeholder="e.g. robert">
                        @error('username')
                            <label class="text-danger mt-2" for="username">
                                {{ $message }}
                            </label>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div class="m-b-md">
                        <div class="d-flex">
                            <label class="form-label d-block" id="label-password" for="password">
                                Kata Sandi
                            </label>
                            <div class="d-inline-block form-check form-switch px-5">
                                <input class="form-check-input" id="toggle-password" name="toggle-password" type="checkbox" tabindex="-1" onchange="togglePassword(event, 'password')">
                            </div>
                        </div>
                        <input class="form-control" id="password" name="password" type="password" aria-describedby="label-password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                        @error('password')
                            <label class="text-danger mt-2" for="password">
                                {{ $message }}
                            </label>
                        @enderror
                    </div>
                </div>

                <div class="auth-submit">
                    {{-- Submit Button --}}
                    <button class="btn btn-primary" type="submit" role="button">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Include Scripts --}}
    @include('cms.layouts.scripts')

    {{-- Form Validation --}}
    <script>
        $('form#login').validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
        });
    </script>
</body>

</html>
