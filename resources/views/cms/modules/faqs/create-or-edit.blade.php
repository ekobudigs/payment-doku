{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
    $sidebar['faqs'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="page-description">
                    <h3 class="fw-bold">{{ $edit ? 'Ubah' : 'Tambah' }} {{ $title }}</h3>
                    <h6 class="mt-2">
                        {{ Breadcrumbs::render('cms.faqs.action', $edit ? 'Ubah' : 'Tambah') }}
                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="faq-{{ $edit ? 'edit' : 'create' }}" action="{{ $edit ? route('cms.faqs.update', $faq->id) : route('cms.faqs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($edit ? 'PUT' : 'POST')

                            {{-- Input Question --}}
                            <div class="mb-4">
                                <label id="label-question" class="form-label d-block" for="question">
                                    Pertanyaan <span class="text-danger">*</span>
                                </label>
                                <input id="question" class="form-control" name="question" type="text" value="{{ old('question', $faq->question ?? null) }}" aria-describedby="label-question"
                                    placeholder="e.g. Bagaimana cara melakukan pemesanan?">
                                @error('question')
                                    <label class="text-danger mt-2" for="question">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Answer --}}
                            <div class="mb-4">
                                <label id="label-answer" class="form-label d-block" for="answer">
                                    Jawaban <span class="text-danger">*</span>
                                </label>
                                <textarea id="answer" class="form-control" name="answer" type="text" aria-describedby="label-answer" placeholder="e.g. Cara melakukan pemesanan adalah.." rows="4">{{ old('answer', $faq->answer ?? null) }}</textarea>
                                @error('answer')
                                    <label class="text-danger mt-2" for="answer">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                {{-- Back Button --}}
                                <a class="btn btn-light" type="submit" href="{{ route('cms.faqs.index') }}">
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
        $('form#faq-create, form#faq-edit').validate({
            rules: {
                question: {
                    required: true,
                },
                answer: {
                    required: true,
                },
            },
        });
    </script>
@endPushOnce
