{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
    $sidebar['customers'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="page-description">
                    <h3 class="fw-bold">{{ $edit ? 'Ubah' : 'Tambah' }} {{ $title }}</h3>
                    <h6 class="mt-2">
                        {{ Breadcrumbs::render('cms.customers.action', $edit ? 'Ubah' : 'Tambah') }}
                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="customer-{{ $edit ? 'edit' : 'create' }}" action="{{ $edit ? route('cms.customers.update', $customer->id) : route('cms.customers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($edit ? 'PUT' : 'POST')

                            {{-- Input Username --}}
                            <div class="mb-4">
                                <label id="label-username" class="form-label d-block" for="username">
                                    Username <span class="text-danger">*</span>
                                </label>
                                <input id="username" class="form-control" name="username" type="text" value="{{ old('username', $customer->username ?? null) }}" aria-describedby="label-username" placeholder="e.g. robert">
                                @error('username')
                                    <label class="text-danger mt-2" for="username">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Name --}}
                            <div class="mb-4">
                                <label id="label-name" class="form-label d-block" for="name">
                                    Nama <span class="text-danger">*</span>
                                </label>
                                <input id="name" class="form-control" name="name" type="text" value="{{ old('name', $customer->name ?? null) }}" aria-describedby="label-name" placeholder="e.g. Robert Emerson">
                                @error('name')
                                    <label class="text-danger mt-2" for="name">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Email --}}
                            <div class="mb-4">
                                <label id="label-email" class="form-label d-block" for="email">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input id="email" class="form-control" name="email" type="email" value="{{ old('email', $customer->email ?? null) }}" aria-describedby="label-email" placeholder="e.g. robert@example.com">
                                @error('email')
                                    <label class="text-danger mt-2" for="email">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Phone --}}
                            <div class="mb-4">
                                <label id="label-phone" class="form-label d-block" for="phone">
                                    Nomor Telepon
                                </label>
                                <input id="phone" class="form-control number-input" name="phone" type="text" value="{{ old('phone', $customer->phone ?? null) }}" aria-describedby="label-phone" placeholder="e.g. 0821xxxxxxxx">
                                @error('phone')
                                    <label class="text-danger mt-2" for="phone">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="mb-4">
                                <div class="d-flex">
                                    <label id="label-password" class="form-label d-block" for="password">
                                        Kata Sandi <span class="text-danger {{ $edit ? 'd-none' : '' }}">*</span>
                                    </label>
                                    <div class="d-inline-block form-check form-switch px-5">
                                        <input id="toggle-password" class="form-check-input" name="toggle-password" type="checkbox" tabindex="-1" onchange="togglePassword(event, 'password')">
                                    </div>
                                </div>
                                <input id="password" class="form-control" name="password" type="password" aria-describedby="label-password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                @error('password')
                                    <label class="text-danger mt-2" for="password">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                {{-- Back Button --}}
                                <a class="btn btn-light" type="submit" href="{{ route('cms.customers.index') }}">
                                    Kembali
                                </a>

                                {{-- Submit Button --}}
                                <button class="btn btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Custom Scripts --}}
@pushOnce('after-scripts')
    <script>
        // Form Validation
        $('form#customer-create, form#customer-edit').validate({
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
                    required: @json($edit) ? false : true, // Not required on edit mode
                    minlength: 4,
                }
            },
        });
    </script>
@endPushOnce
