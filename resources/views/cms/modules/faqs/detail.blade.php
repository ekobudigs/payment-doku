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
                <h3 class="fw-bold">Detail {{ $title }}</h3>
                <h6 class="mt-2">
                    {{ Breadcrumbs::render('cms.faqs.action', 'Detail') }}
                </h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        {{-- Input Question --}}
                        <div class="mb-4">
                            <label class="form-label d-block" id="label-question" for="question">Pertanyaan</label>
                            <input class="form-control" id="question" name="question" type="text" value="{{ old('question', $faq->question ?? null) }}" aria-describedby="label-question" disabled aria-disabled="true">
                        </div>

                        {{-- Input Answer --}}
                        <div class="mb-4">
                            <label class="form-label d-block" id="label-answer" for="answer">Jawaban</label>
                            <textarea class="form-control" id="answer" name="answer" type="text" aria-describedby="label-answer" disabled aria-disabled="true">{{ old('answer', $faq->answer ?? null) }}</textarea>
                        </div>

                        {{-- Info Created At --}}
                        <div class="mb-4">
                            <label class="form-label d-block" id="label-created-at" for="created-at">Dibuat Pada</label>
                            <input class="form-control" id="created-at" name="created_at" type="text" value="{{ human_datetime($faq->created_at) }}" aria-describedby="label-created-at" aria-disabled="true" disabled>
                        </div>

                        {{-- Info Updated At --}}
                        <div class="mb-4">
                            <label class="form-label d-block" id="label-updated-at" for="updated-at">Terakhir Diubah</label>
                            <input class="form-control" id="updated-at" name="updated_at" type="text" value="{{ human_datetime($faq->updated_at) }}" aria-describedby="label-updated-at" aria-disabled="true" disabled>
                        </div>

                        <div class="d-flex gap-2">
                            <a class="btn btn-light" type="submit" href="{{ route('cms.faqs.index') }}">
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