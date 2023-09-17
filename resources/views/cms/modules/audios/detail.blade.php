{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
    $sidebar['audios'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="page-description">
                    <h3 class="fw-bold">Detail {{ $title }}</h3>
                    <h6 class="mt-2">
                        {{ Breadcrumbs::render('cms.audios.action', 'Detail') }}
                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            {{-- Info Name --}}
                            <div class="mb-4">
                                <label id="label-name" class="form-label d-block" for="name">Nama Audio</label>
                                <input id="name" class="form-control" name="name" type="text" value="{{ $audio->name ?? null }}" aria-describedby="label-name" placeholder="e.g. Soft Piano Instrumental" disabled aria-disabled="true">
                            </div>

                            {{-- Info Audio --}}
                            <div class="mb-4">
                                <label id="label-audio" class="form-label d-block" for="audio">Audio</label>
                                <audio id="audio-preview" class="w-100 rounded" src="{{ isset($audio) ? $audio->path : '' }}" controls></audio>
                            </div>

                            {{-- Info Created At --}}
                            <div class="mb-4">
                                <label id="label-created-at" class="form-label d-block" for="created-at">Dibuat Pada</label>
                                <input id="created-at" class="form-control" name="created_at" type="text" value="{{ human_datetime($audio->created_at) }}" aria-describedby="label-created-at" aria-disabled="true" disabled>
                            </div>

                            {{-- Info Updated At --}}
                            <div class="mb-4">
                                <label id="label-updated-at" class="form-label d-block" for="updated-at">Terakhir Diubah</label>
                                <input id="updated-at" class="form-control" name="updated_at" type="text" value="{{ human_datetime($audio->updated_at) }}" aria-describedby="label-updated-at" aria-disabled="true" disabled>
                            </div>

                            <div class="d-flex gap-2">
                                <a class="btn btn-light" type="submit" href="{{ route('cms.audios.index') }}">
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
