{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
    $sidebar['audios'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description d-flex align-items-center">
                    <div class="page-description-content flex-grow-1">
                        <h3 class="fw-bold">{{ $title }}</h3>
                        <h6 class="text-dark mt-2">{{ Breadcrumbs::render('cms.audios.index') }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-start gap-2">
                        <a class="btn btn-sm btn-primary" href="{{ route('cms.audios.create') }}">
                            Tambah {{ $title }}
                        </a>
                    </div>
                    <div class="card-body table-responsive overflow-y-hidden">
                        <table class="w-100 table">
                            <thead>
                                <tr>
                                    <th class="align-top">Pilihan</th>
                                    <th class="align-top">#</th>
                                    <th class="align-top">Nama</th>
                                    <th class="align-top">Audio</th>
                                    <th class="align-top">Ekstensi</th>
                                    <th class="align-top">Ukuran</th>
                                    <th class="align-top">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($audios as $audio)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="btn-group dropend">
                                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Pilihan
                                                </button>
                                                <ul class="dropdown-menu">
                                                    {{-- Edit Button --}}
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('cms.audios.edit', $audio->id) }}">Ubah</a>
                                                    </li>

                                                    {{-- Detail Button --}}
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('cms.audios.show', $audio->id) }}">Detail</a>
                                                    </li>

                                                    {{-- Toggle Status Button --}}
                                                    <li>
                                                        <form action="{{ route('cms.audios.toggle', $audio->id) }}" method="POST">
                                                            @csrf
                                                            <a class="dropdown-item" type="button" onclick="swalConfirm(event)">
                                                                {{ $audio->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                            </a>
                                                        </form>
                                                    </li>

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    {{-- Delete Button --}}
                                                    <li>
                                                        <form action="{{ route('cms.audios.destroy', $audio->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="dropdown-item" type="button" onclick="swalConfirm(event)">
                                                                Hapus
                                                            </a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="text-nowrap align-middle">{{ ($audios->currentPage() - 1) * $audios->perPage() + $loop->iteration }}</td>
                                        <td class="text-nowrap align-middle">{{ $audio->name }}</td>
                                        <td class="text-nowrap align-middle">
                                            <audio id="audio-preview" class="w-100 rounded" src="{{ $audio->path }}" controls></audio>
                                        </td>
                                        <td class="text-nowrap align-middle">{{ $audio->extension }}</td>
                                        <td class="text-nowrap align-middle">{{ $audio->size }}</td>
                                        <td class="text-nowrap align-middle">{!! GeneralStatus::htmlLabel($audio->status) !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td id="test" class="text-center" colspan="5">
                                            Data tidak tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    @if ($audios->total() > $audios->perPage())
                        <div class="card-footer">
                            {{ $audios->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
