{{-- Master Template --}}
@extends('web.layouts.master')

{{-- Topbar Configuration --}}
@php
    $topbar['variant'] = 'navbar-light';
    $topbar['profile'] = 'active';
@endphp

{{-- Content --}}
@section('content')
    {{-- Section Profile --}}
    <section id="profile" class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mt-lg-5">
                    <div class="title mb-4 text-center">
                        <p class="text-muted text-uppercase fw-normal mb-2">{{ $title }}</p>
                        <h3 class="mb-3">{{ customer()->name }}</h3>
                        <div class="title-icon position-relative">
                            <div class="position-relative">
                                <i class="uim uim-arrow-circle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="profile-info" class="row align-items-center justify-content-center">
                <div class="col-12 d-flex justify-content-center">
                    <div class="mb-3">
                        <button class="btn btn-sm btn-primary" onclick="toggleProfileMode('edit')">
                            {{ __('general.actions.edit') . ' ' . __('auth.profile.word') }}
                        </button>
                    </div>
                </div>

                {{-- Info Username --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.username') }}</h6>
                    <p class="mb-2 text-center">{{ customer()->username ?? '-' }}</p>
                </div>

                {{-- Info Name --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.name') }}</h6>
                    <p class="mb-2 text-center">{{ customer()->name ?? '-' }}</p>
                </div>

                {{-- Info Email --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.email') }}</h6>
                    <p class="mb-2 text-center">{{ customer()->email ?? '-' }} </p>
                </div>

                {{-- Info Phone --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.phone') }}</h6>
                    <p class="mb-2 text-center">{{ customer()->phone ?? '-' }}</p>
                </div>
            </div>

            <form id="profile-edit" action="{{ route('web.profile.update', app()->getLocale()) }}" method="POST" class="row justify-content-center d-none">
                @csrf
                <div class="col-12 d-flex justify-content-center">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-sm btn-primary mx-1">
                            {{ __('general.actions.update') }}
                        </button>
                        <button type="button" class="btn btn-sm btn-light mx-1" onclick="toggleProfileMode('info')">
                            {{ __('general.actions.cancel') }}
                        </button>
                    </div>
                </div>

                {{-- Edit Username --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.username') }}</h6>
                    <input id="username" name="username" type="text" class="form-control text-center" placeholder="e.g. robert" value="{{ customer()->username }}">
                    @error('username')
                        <label for="username" class="text-danger mt-2">
                            {{ $message }}
                        </label>
                    @enderror
                </div>

                {{-- Edit Name --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.name') }}</h6>
                    <input id="name" name="name" type="text" class="form-control text-center" placeholder="e.g. Robert Emerson" value="{{ customer()->name }}">
                    @error('name')
                        <label for="name" class="text-danger mt-2">
                            {{ $message }}
                        </label>
                    @enderror
                </div>

                {{-- Edit Email --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.email') }}</h6>
                    <input id="email" name="email" type="email" class="form-control text-center" placeholder="e.g. robert@example.com" value="{{ customer()->email }}">
                    @error('email')
                        <label for="email" class="text-danger mt-2">
                            {{ $message }}
                        </label>
                    @enderror
                </div>

                {{-- Edit Phone --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.phone') }}</h6>
                    <input id="phone" name="phone" type="text" class="form-control number-input text-center" placeholder="e.g. 0821xxxxxxxx" value="{{ customer()->phone ?? 0 }}">
                    @error('phone')
                        <label for="phone" class="text-danger mt-2">
                            {{ $message }}
                        </label>
                    @enderror
                </div>

                {{-- Edit Password --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.password') }}</h6>
                    <input id="password" name="password" type="password" class="form-control text-center" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    @error('password')
                        <label for="password" class="text-danger mt-2">
                            {{ $message }}
                        </label>
                    @enderror
                </div>

                {{-- Edit Password Confirmation --}}
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-3">
                    <h6 class="text-center">{{ __('general.words.attributes.password_confirmation') }}</h6>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control text-center" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    @error('password')
                        <label for="password" class="text-danger mt-2">
                            {{ $message }}
                        </label>
                    @enderror
                </div>
            </form>
        </div>
    </section>

    {{-- Section Detail --}}
    <section id="detail" class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="title mb-5 text-center">
                        <p class="text-muted text-uppercase fw-normal mb-2">{{ __('general.words.detail') }}</p>
                        <h3 class="mb-3">{{ __('general.words.transaction') }}</h3>
                        <div class="title-icon position-relative">
                            <div class="position-relative">
                                <i class="uim uim-arrow-circle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                {{--  --}}
            </div>
        </div>
    </section>
@endsection

{{-- Custom Scripts --}}
@pushOnce('after-scripts')
    <script>
        // Form Validation
        $('form#profile-edit').validate({
            rules: {
                username: {
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
                    minlength: 4,
                },
                password_confirmation: {
                    minlength: 4,
                    equalTo: '#password',
                }
            },
            messages: {
                username: {
                    required: `{{ __('validation.required', ['attribute' => __('validation.attributes.username')]) }}`,
                },
                name: {
                    required: `{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}`,
                },
                email: {
                    required: `{{ __('validation.required', ['attribute' => __('validation.attributes.email')]) }}`,
                    email: `{{ __('validation.email', ['attribute' => __('validation.attributes.email')]) }}`
                },
                password: {
                    minlength: `{{ __('validation.min.string', ['attribute' => __('validation.attributes.password'), 'min' => '4']) }}`
                },
                password_confirmation: {
                    minlength: `{{ __('validation.min.string', ['attribute' => __('validation.attributes.password_confirmation'), 'min' => '4']) }}`,
                    equalTo: `{{ __('validation.confirmed', ['attribute' => __('validation.attributes.password')]) }}`,
                }
            },
            errorPlacement: function(label, element) {
                label.addClass(errorClasses());
                element.parent().append(label);
            },
        });

        // Profile toggle mode
        function toggleProfileMode(mode) {
            switch (mode) {
                case 'edit':
                    $('#profile-edit').removeClass('d-none');
                    $('#profile-info').addClass('d-none');
                    break;

                default:
                    $('#profile-edit').addClass('d-none');
                    $('#profile-info').removeClass('d-none');
                    break;
            }
        }
    </script>
@endPushOnce
