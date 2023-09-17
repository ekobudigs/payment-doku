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
                    <h3 class="fw-bold">{{ $edit ? 'Ubah' : 'Tambah' }} {{ $title }}</h3>
                    <h6 class="mt-2">
                        {{ Breadcrumbs::render('cms.audios.action', $edit ? 'Ubah' : 'Tambah') }}
                    </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="audio-{{ $edit ? 'edit' : 'create' }}" action="{{ $edit ? route('cms.audios.update', $audio->id) : route('cms.audios.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($edit ? 'PUT' : 'POST')

                            {{-- Input Name --}}
                            <div class="mb-4">
                                <label id="label-name" class="form-label d-block" for="name">
                                    Nama Audio <span class="text-danger">*</span>
                                </label>

                                <input id="name" class="form-control" name="name" type="text" value="{{ old('name', $audio->name ?? null) }}" aria-describedby="label-name" placeholder="e.g. Soft Piano Instrumental">

                                @error('name')
                                    <label class="text-danger mt-2" for="name">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            {{-- Input Audio --}}
                            <div class="mb-4">
                                <label id="label-audio" class="form-label d-block" for="audio">
                                    Audio <span class="text-danger">*</span>
                                </label>

                                <input id="audio" accept="audio/*" onchange="previewAudio(event)" class="form-control" name="audio" type="file" aria-describedby="label-audio">
                                <audio id="audio-preview" class="w-100 {{ !$edit ? 'd-none' : '' }} mt-3 rounded" src="{{ isset($audio) ? $audio->path : '' }}" controls></audio>

                                @error('audio')
                                    <label class="text-danger mt-2" for="audio">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                {{-- Back Button --}}
                                <a class="btn btn-light" type="submit" href="{{ route('cms.audios.index') }}">
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
        $('form#audio-create, form#audio-edit').validate({
            rules: {
                name: {
                    required: true,
                },
                audio: {
                    required: true,
                    accept: 'audio/*'
                },
            },
        });

        // Preview Uploaded Audio
        function previewAudio(event) {
            const fileInput = event.target;
            const audioPreview = document.getElementById("audio-preview");

            if (fileInput.files && fileInput.files[0]) {
                const file = fileInput.files[0];
                const fileURL = URL.createObjectURL(file);

                audioPreview.classList.remove('d-none');
                audioPreview.src = fileURL;
            }
        }
    </script>
@endPushOnce
