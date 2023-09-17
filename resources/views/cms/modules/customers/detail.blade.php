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
                    <h3 class="fw-bold">Detail {{ $title }}</h3>
                    <h6 class="mt-2">
                        {{ Breadcrumbs::render('cms.customers.action', 'Detail') }}
                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            {{-- Info Username --}}
                            <div class="mb-4">
                                <label class="form-label d-block" id="label-username" for="username">Username</label>
                                <input class="form-control" id="username" name="username" type="text" value="{{ $customer->username }}" aria-describedby="label-username" aria-disabled="true" placeholder="e.g. robert" disabled>
                            </div>

                            {{-- Info Name --}}
                            <div class="mb-4">
                                <label class="form-label d-block" id="label-name" for="name">Nama</label>
                                <input class="form-control" id="name" name="name" type="text" value="{{ $customer->name }}" aria-describedby="label-name" aria-disabled="true" placeholder="e.g. Robert Emerson" disabled>
                            </div>

                            {{-- Info Email --}}
                            <div class="mb-4">
                                <label class="form-label d-block" id="label-email" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email" value="{{ $customer->email }}" aria-describedby="label-email" aria-disabled="true" placeholder="e.g. email@example.com" disabled>
                            </div>

                            {{-- Info Phone --}}
                            <div class="mb-4">
                                <label class="form-label d-block" id="label-phone" for="phone">Nomor Telepon</label>
                                <input class="form-control" id="phone" name="phone" type="text" value="{{ $customer->phone ?: '-' }}" aria-describedby="label-phone" aria-disabled="true" placeholder="e.g. 0821xxxxxxxx" disabled>
                            </div>

                            {{-- Info Created At --}}
                            <div class="mb-4">
                                <label class="form-label d-block" id="label-created-at" for="created-at">Dibuat Pada</label>
                                <input class="form-control" id="created-at" name="created_at" type="text" value="{{ human_datetime($customer->created_at) }}" aria-describedby="label-created-at" aria-disabled="true" disabled>
                            </div>

                            {{-- Info Updated At --}}
                            <div class="mb-4">
                                <label class="form-label d-block" id="label-updated-at" for="updated-at">Terakhir Diubah</label>
                                <input class="form-control" id="updated-at" name="updated_at" type="text" value="{{ human_datetime($customer->updated_at) }}" aria-describedby="label-updated-at" aria-disabled="true" disabled>
                            </div>

                            <div class="d-flex gap-2">
                                <a class="btn btn-light" type="submit" href="{{ route('cms.customers.index') }}">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
