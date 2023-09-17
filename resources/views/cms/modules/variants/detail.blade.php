{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
    $sidebar['variants'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="page-description">
                    <h3 class="fw-bold">Detail {{ $title }}</h3>
                    <h6 class="mt-2">
                        {{ Breadcrumbs::render('cms.variants.action', 'Detail') }}
                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="row">
                            {{-- Input Name --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-name" class="form-label d-block" for="name">Nama Paket</label>
                                <input id="name" class="form-control" aria-describedby="label-name" aria-disabled="true" disabled name="name" placeholder="e.g. Paket Gold" type="text" value="{{ $variant->name ?: '-' }}">
                            </div>

                            {{-- Input Price --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-price" class="form-label d-block" for="price">Harga Paket</label>
                                <input id="price" class="form-control number-input" aria-describedby="label-price" aria-disabled="true" disabled name="price" placeholder="e.g. 350000" type="text" value="{{ $variant->price ?: 0 }}">
                            </div>

                            {{-- Input Discount Status --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-discount-status" class="form-label d-block" for="discount-status">Diskon</label>

                                <select id="discount-status" class="form-select" aria-describedby="label-discount-status" aria-disabled="true" aria-label="Allow Discount Type" disabled name="discount_status">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->discount_status : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->discount_status : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Discount Type --}}
                            <div class="col-12 col-lg-3 mb-4">
                                <label id="label-discount-type" class="form-label d-block" for="discount-type">Jenis Diskon</label>

                                <select id="discount-type" class="form-select" aria-describedby="label-discount-type" aria-disabled="true" aria-label="Allow Discount Type" disabled name="discount_type">
                                    <option selected value=""></option>
                                    @foreach (DiscountType::values() as $discountType)
                                        <option {{ (isset($variant) ? (string) $variant->discount_type : null) === $discountType ? 'selected' : '' }} value="{{ $discountType }}">
                                            {{ str($discountType)->lower()->ucfirst() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Input Discount Amount --}}
                            <div class="col-12 col-lg-3 mb-4">
                                <label id="label-discount-amount" class="form-label d-block" for="discount-amount">Jumlah Diskon</label>
                                <input id="discount-amount" class="form-control number-input" aria-describedby="label-discount-amount" aria-disabled="true" disabled name="discount_amount" type="text"
                                    value="{{ isset($variant) ? $variant->discount_amount : null }}">
                            </div>

                            <div class="col-12 mb-3">
                                <hr class="text-dark">
                            </div>

                            {{-- Input Allow Galleries --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-galleries" class="form-label d-block" for="allow-galleries">Galeri</label>

                                <select id="allow-galleries" class="form-select" aria-describedby="label-allow-galleries" aria-disabled="true" aria-label="Allow galleries" disabled name="allow_galleries">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_galleries : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_galleries : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Max Galleries --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-max-galleries" class="form-label d-block" for="max-galleries">Batas Maksimal Galeri</label>
                                <input id="max-galleries" class="form-control number-input" aria-describedby="label-max-galleries" aria-disabled="true" disabled name="max_galleries" type="text"
                                    value="{{ isset($variant) ? $variant->max_galleries : null }}">
                            </div>

                            {{-- Input Allow Videos --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-videos" class="form-label d-block" for="allow-videos">Video</label>

                                <select id="allow-videos" class="form-select" aria-describedby="label-allow-videos" aria-disabled="true" aria-label="Allow videos" disabled name="allow_videos">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_videos : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_videos : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Max Videos --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-max-videos" class="form-label d-block" for="max-videos">Batas Maksimal Video</label>
                                <input id="max-videos" class="form-control number-input" aria-describedby="label-max-videos" aria-disabled="true" disabled name="max_videos" type="text"
                                    value="{{ old('max_videos', isset($variant) ? $variant->max_videos : null) }}">
                            </div>

                            {{-- Input Allow Couple Photos --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-couple-photos" class="form-label d-block" for="allow-couple-photos">Foto Pasangan</label>

                                <select id="allow-couple-photos" class="form-select" aria-describedby="label-allow-couple-photos" aria-disabled="true" aria-label="Allow couple photos" disabled name="allow_couple_photos">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_couple_photos : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_couple_photos : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Allow Google Maps --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-google-maps" class="form-label d-block" for="allow-google-maps">Google Maps</label>

                                <select id="allow-google-maps" class="form-select" aria-describedby="label-allow-google-maps" aria-disabled="true" aria-label="Allow Google Maps" disabled name="allow_google_maps">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_google_maps : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_google_maps : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Allow Countdown --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-countdown" class="form-label d-block" for="allow-countdown">Countdown</label>

                                <select id="allow-countdown" class="form-select" aria-describedby="label-allow-countdown" aria-disabled="true" aria-label="Allow Countdown" disabled name="allow_countdown">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_countdown : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_countdown : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Allow Backsound --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-backsound" class="form-label d-block" for="allow-backsound">Musik Latar</label>

                                <select id="allow-backsound" class="form-select" aria-describedby="label-allow-backsound" aria-disabled="true" aria-label="Allow Backsound" disabled name="allow_backsound">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_backsound : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_backsound : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Allow Guest Book --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-guest-book" class="form-label d-block" for="allow-guest-book">Buku Tamu</label>

                                <select id="allow-guest-book" class="form-select" aria-describedby="label-allow-guest-book" aria-disabled="true" aria-label="Allow Guest Book" disabled name="allow_guest_book">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_guest_book : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_guest_book : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Allow Guest Target --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-guest-target" class="form-label d-block" for="allow-guest-target">Nama Tamu</label>

                                <select id="allow-guest-target" class="form-select" aria-describedby="label-allow-guest-target" aria-disabled="true" aria-label="Allow Guest Target" disabled name="allow_guest_target">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_guest_target : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_guest_target : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Allow RSVP --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-rsvp" class="form-label d-block" for="allow-rsvp">RSVP</label>

                                <select id="allow-rsvp" class="form-select" aria-describedby="label-allow-rsvp" aria-disabled="true" aria-label="Allow RSVP" disabled name="allow_rsvp">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_rsvp : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_rsvp : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Input Allow Gift --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-rsvp" class="form-label d-block" for="allow-gift">Gift</label>

                                <select id="allow-gift" class="form-select" aria-describedby="label-allow-gift" aria-disabled="true" aria-label="Allow Gift" disabled name="allow_gift">
                                    <option disabled hidden selected></option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_gift : null) === '1' ? 'selected' : '' }} value="1">Iya</option>
                                    <option {{ (isset($variant) ? (string) $variant->allow_gift : null) === '0' ? 'selected' : '' }} value="0">Tidak</option>
                                </select>
                            </div>

                            {{-- Info Created At --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-created-at" class="form-label d-block" for="created-at">Dibuat Pada</label>
                                <input id="created-at" class="form-control" aria-describedby="label-created-at" aria-disabled="true" disabled name="created_at" type="text" value="{{ human_datetime($variant->created_at) }}">
                            </div>

                            {{-- Info Updated At --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-updated-at" class="form-label d-block" for="updated-at">Terakhir Diubah</label>
                                <input id="updated-at" class="form-control" aria-describedby="label-updated-at" aria-disabled="true" disabled name="updated_at" type="text" value="{{ human_datetime($variant->updated_at) }}">
                            </div>

                            <div class="d-flex gap-2">
                                {{-- Back Button --}}
                                <a class="btn btn-light" href="{{ route('cms.variants.index') }}" type="submit">
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
