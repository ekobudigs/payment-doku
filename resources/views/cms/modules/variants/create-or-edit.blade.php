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
                    <h3 class="fw-bold">{{ $edit ? 'Ubah' : 'Tambah' }} {{ $title }}</h3>
                    <h6 class="mt-2">
                        {{ Breadcrumbs::render('cms.variants.action', $edit ? 'Ubah' : 'Tambah') }}
                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="variant-{{ $edit ? 'edit' : 'create' }}" class="row" action="{{ $edit ? route('cms.variants.update', $variant->id) : route('cms.variants.store') }}" method="POST">
                            @csrf
                            @method($edit ? 'PUT' : 'POST')

                            {{-- Input Name --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-name" class="form-label d-block" for="name">
                                    Nama Paket <span class="text-danger">*</span>
                                </label>

                                <input id="name" class="form-control" name="name" type="text" value="{{ old('name', $variant->name ?? null) }}" aria-describedby="label-name" placeholder="e.g. Paket Gold">

                                @error('name')
                                    <label class="text-danger mt-2" for="name">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Price --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-price" class="form-label d-block" for="price">
                                    Harga Paket <span class="text-danger">*</span>
                                </label>

                                <input id="price" class="form-control number-input" name="price" type="text" value="{{ old('price', $variant->price ?? null) }}" aria-describedby="label-price" placeholder="e.g. 350000">

                                @error('price')
                                    <label class="text-danger mt-2" for="price">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Discount Status --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-discount-status" class="form-label d-block" for="discount-status">
                                    Diskon <span class="text-danger">*</span>
                                </label>

                                <select id="discount-status" onchange="toggleNextInput(event, '#discount-type, #discount-amount')" name="discount_status" class="form-select" aria-label="Allow Discount Type"
                                    aria-describedby="label-discount-status">
                                    <option selected hidden disabled>Berisi Diskon?</option>
                                    <option value="1" {{ old('discount_status', isset($variant) ? (string) $variant->discount_status : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('discount_status', isset($variant) ? (string) $variant->discount_status : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('discount_status')
                                    <label class="text-danger mt-2" for="discount_status">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Discount Type --}}
                            <div class="col-12 col-lg-3 mb-4">
                                <label id="label-discount-type" class="form-label d-block" for="discount-type">
                                    Jenis Diskon <span class="text-danger">*</span>
                                </label>

                                <select id="discount-type" {{ old('discount_status', isset($variant) ? (string) $variant->discount_status : (string) 0) === '0' ? 'disabled' : '' }} name="discount_type" class="form-select"
                                    aria-label="Allow Discount Type" aria-describedby="label-discount-type">
                                    <option selected value="">Pilih Jenis Diskon</option>
                                    @foreach (DiscountType::values() as $discountType)
                                        <option value="{{ $discountType }}" {{ old('discount_type', isset($variant) ? (string) $variant->discount_type : null) === $discountType ? 'selected' : '' }}>
                                            {{ str($discountType)->lower()->ucfirst() }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('discount_type')
                                    <label class="text-danger mt-2" for="discount_type">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Discount Amount --}}
                            <div class="col-12 col-lg-3 mb-4">
                                <label id="label-discount-amount" class="form-label d-block" for="discount-amount">
                                    Jumlah Diskon
                                </label>

                                <input id="discount-amount" {{ old('discount_status', isset($variant) ? (string) $variant->discount_status : (string) 0) === '0' ? 'disabled' : '' }} class="form-control number-input" name="discount_amount"
                                    type="text" value="{{ old('discount_amount', isset($variant) ? $variant->discount_amount : null) }}" aria-describedby="label-discount-amount" placeholder="e.g. 50000">

                                @error('discount_amount')
                                    <label class="text-danger mt-2" for="discount_amount">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <hr class="text-dark">
                            </div>

                            {{-- Input Allow Galleries --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-galleries" class="form-label d-block" for="allow-galleries">
                                    Galeri <span class="text-danger">*</span>
                                </label>

                                <select id="allow-galleries" onchange="toggleNextInput(event, '#max-galleries')" name="allow_galleries" class="form-select" aria-label="Allow galleries" aria-describedby="label-allow-galleries">
                                    <option selected hidden disabled>Berisi Galeri?</option>
                                    <option value="1" {{ old('allow_galleries', isset($variant) ? (string) $variant->allow_galleries : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_galleries', isset($variant) ? (string) $variant->allow_galleries : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_galleries')
                                    <label class="text-danger mt-2" for="allow_galleries">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Max Galleries --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-max-galleries" class="form-label d-block" for="max-galleries">
                                    Batas Maksimal Galeri
                                </label>

                                <input id="max-galleries" {{ old('allow_galleries', isset($variant) ? (string) $variant->allow_galleries : (string) 0) === '0' ? 'disabled' : '' }} class="form-control number-input" name="max_galleries"
                                    type="text" value="{{ old('max_galleries', isset($variant) ? $variant->max_galleries : null) }}" aria-describedby="label-max-galleries" placeholder="e.g. 15">

                                @error('max_galleries')
                                    <label class="text-danger mt-2" for="max_galleries">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow Videos --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-videos" class="form-label d-block" for="allow-videos">
                                    Video <span class="text-danger">*</span>
                                </label>

                                <select id="allow-videos" onchange="toggleNextInput(event, '#max-videos')" name="allow_videos" class="form-select" aria-label="Allow videos" aria-describedby="label-allow-videos">
                                    <option selected hidden disabled>Berisi Video?</option>
                                    <option value="1" {{ old('allow_videos', isset($variant) ? (string) $variant->allow_videos : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_videos', isset($variant) ? (string) $variant->allow_videos : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_videos')
                                    <label class="text-danger mt-2" for="allow_videos">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Max Videos --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-max-videos" class="form-label d-block" for="max-videos">
                                    Batas Maksimal Video
                                </label>

                                <input id="max-videos" {{ old('allow_videos', isset($variant) ? (string) $variant->allow_videos : (string) 0) === '0' ? 'disabled' : '' }} class="form-control number-input" name="max_videos" type="text"
                                    value="{{ old('max_videos', isset($variant) ? $variant->max_videos : null) }}" aria-describedby="label-max-videos" placeholder="e.g. 2">

                                @error('max_videos')
                                    <label class="text-danger mt-2" for="max_videos">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow Couple Photos --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-couple-photos" class="form-label d-block" for="allow-couple-photos">
                                    Foto Pasangan <span class="text-danger">*</span>
                                </label>

                                <select id="allow-couple-photos" name="allow_couple_photos" class="form-select" aria-label="Allow couple photos" aria-describedby="label-allow-couple-photos">
                                    <option selected hidden disabled>Berisi Foto Pasangan?</option>
                                    <option value="1" {{ old('allow_couple_photos', isset($variant) ? (string) $variant->allow_couple_photos : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_couple_photos', isset($variant) ? (string) $variant->allow_couple_photos : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_couple_photos')
                                    <label class="text-danger mt-2" for="allow_couple_photos">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow Google Maps --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-google-maps" class="form-label d-block" for="allow-google-maps">
                                    Google Maps <span class="text-danger">*</span>
                                </label>

                                <select id="allow-google-maps" name="allow_google_maps" class="form-select" aria-label="Allow Google Maps" aria-describedby="label-allow-google-maps">
                                    <option selected hidden disabled>Berisi Google Maps?</option>
                                    <option value="1" {{ old('allow_google_maps', isset($variant) ? (string) $variant->allow_google_maps : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_google_maps', isset($variant) ? (string) $variant->allow_google_maps : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_google_maps')
                                    <label class="text-danger mt-2" for="allow_google_maps">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow Countdown --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-countdown" class="form-label d-block" for="allow-countdown">
                                    Countdown <span class="text-danger">*</span>
                                </label>

                                <select id="allow-countdown" name="allow_countdown" class="form-select" aria-label="Allow Countdown" aria-describedby="label-allow-countdown">
                                    <option selected hidden disabled>Berisi Countdown?</option>
                                    <option value="1" {{ old('allow_countdown', isset($variant) ? (string) $variant->allow_countdown : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_countdown', isset($variant) ? (string) $variant->allow_countdown : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_countdown')
                                    <label class="text-danger mt-2" for="allow_countdown">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow Backsound --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-backsound" class="form-label d-block" for="allow-backsound">
                                    Musik Latar <span class="text-danger">*</span>
                                </label>

                                <select id="allow-backsound" name="allow_backsound" class="form-select" aria-label="Allow Backsound" aria-describedby="label-allow-backsound">
                                    <option selected hidden disabled>Berisi Musik Latar?</option>
                                    <option value="1" {{ old('allow_backsound', isset($variant) ? (string) $variant->allow_backsound : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_backsound', isset($variant) ? (string) $variant->allow_backsound : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_backsound')
                                    <label class="text-danger mt-2" for="allow_backsound">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow Guest Book --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-guest-book" class="form-label d-block" for="allow-guest-book">
                                    Buku Tamu <span class="text-danger">*</span>
                                </label>

                                <select id="allow-guest-book" name="allow_guest_book" class="form-select" aria-label="Allow Guest Book" aria-describedby="label-allow-guest-book">
                                    <option selected hidden disabled>Berisi Buku Tamu?</option>
                                    <option value="1" {{ old('allow_guest_book', isset($variant) ? (string) $variant->allow_guest_book : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_guest_book', isset($variant) ? (string) $variant->allow_guest_book : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_guest_book')
                                    <label class="text-danger mt-2" for="allow_guest_book">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow Guest Target --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-guest-target" class="form-label d-block" for="allow-guest-target">
                                    Nama Tamu <span class="text-danger">*</span>
                                </label>

                                <select id="allow-guest-target" name="allow_guest_target" class="form-select" aria-label="Allow Guest Target" aria-describedby="label-allow-guest-target">
                                    <option selected hidden disabled>Berisi Nama Tamu?</option>
                                    <option value="1" {{ old('allow_guest_target', isset($variant) ? (string) $variant->allow_guest_target : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_guest_target', isset($variant) ? (string) $variant->allow_guest_target : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_guest_target')
                                    <label class="text-danger mt-2" for="allow_guest_target">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow RSVP --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-rsvp" class="form-label d-block" for="allow-rsvp">
                                    RSVP <span class="text-danger">*</span>
                                </label>

                                <select id="allow-rsvp" name="allow_rsvp" class="form-select" aria-label="Allow RSVP" aria-describedby="label-allow-rsvp">
                                    <option selected hidden disabled>Berisi RSVP?</option>
                                    <option value="1" {{ old('allow_rsvp', isset($variant) ? (string) $variant->allow_rsvp : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_rsvp', isset($variant) ? (string) $variant->allow_rsvp : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_rsvp')
                                    <label class="text-danger mt-2" for="allow_rsvp">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Allow Gift --}}
                            <div class="col-12 col-lg-6 mb-4">
                                <label id="label-allow-rsvp" class="form-label d-block" for="allow-gift">
                                    Gift <span class="text-danger">*</span>
                                </label>

                                <select id="allow-gift" name="allow_gift" class="form-select" aria-label="Allow Gift" aria-describedby="label-allow-gift">
                                    <option selected hidden disabled>Berisi Gift?</option>
                                    <option value="1" {{ old('allow_gift', isset($variant) ? (string) $variant->allow_gift : null) === '1' ? 'selected' : '' }}>Iya</option>
                                    <option value="0" {{ old('allow_gift', isset($variant) ? (string) $variant->allow_gift : null) === '0' ? 'selected' : '' }}>Tidak</option>
                                </select>

                                @error('allow_gift')
                                    <label class="text-danger mt-2" for="allow_gift">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                {{-- Back Button --}}
                                <a class="btn btn-light" type="submit" href="{{ route('cms.variants.index') }}">
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
        $('form#variant-create, form#variant-edit').validate({
            rules: {
                name: {
                    required: true,
                },
                price: {
                    required: true,
                },
                discount_status: {
                    required: true,
                },
                discount_type: {
                    required: function(element) {
                        return ($("[name=discount_status]").val() == true);
                    },
                },
                discount_amount: {
                    required: function(element) {
                        return ($("[name=discount_status]").val() == true);
                    },
                },
                allow_couple_photos: {
                    required: true,
                },
                allow_galleries: {
                    required: true,
                },
                allow_videos: {
                    required: true,
                },
                allow_google_maps: {
                    required: true,
                },
                allow_countdown: {
                    required: true,
                },
                allow_backsound: {
                    required: true,
                },
                allow_guest_book: {
                    required: true,
                },
                allow_guest_target: {
                    required: true,
                },
                allow_rsvp: {
                    required: true,
                },
                allow_gift: {
                    required: true,
                },
                max_galleries: {
                    required: function(element) {
                        return $("[name=allow_galleries]").val() == true;
                    }
                },
                max_videos: {
                    required: function(element) {
                        return $("[name=allow_videos]").val() == true;
                    },
                },
            },
        });

        // Toggle next input
        function toggleNextInput(e, selector) {
            const value = e.target.value;
            const nextInput = $(selector);

            if (value == false) {
                nextInput.prop('disabled', true);
                nextInput.val(null);
            } else {
                nextInput.prop('disabled', false);
            }
        }
    </script>
@endPushOnce
