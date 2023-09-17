{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
$sidebar['faqs'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1">
                    <h3 class="fw-bold">{{ $title }}</h3>
                    <h6 class="text-dark mt-2">{{ Breadcrumbs::render('cms.faqs.index') }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-start gap-2">
                    <a class="btn btn-sm btn-primary" href="{{ route('cms.faqs.create') }}">
                        Tambah {{ $title }}
                    </a>
                </div>
                <div class="card-body table-responsive overflow-y-hidden">
                    <table class="w-100 table">
                        <thead>
                            <tr>
                                <th class="align-top">Pilihan</th>
                                <th class="align-top">#</th>
                                <th class="align-top">
                                    <span class="d-block">Pertanyaan</span>
                                    <small>Klik pertanyaan untuk melihat jawaban!</small>
                                </th>
                                <th class="align-top">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($faqs as $faq)
                            <tr>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Pilihan
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- Edit Button --}}
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cms.faqs.edit', $faq->id) }}">Ubah</a>
                                            </li>

                                            {{-- Detail Button --}}
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cms.faqs.show', $faq->id) }}">Detail</a>
                                            </li>

                                            {{-- Toggle Status Button --}}
                                            <li>
                                                <form action="{{ route('cms.faqs.toggle', $faq->id) }}" method="POST">
                                                    @csrf
                                                    <a class="dropdown-item" type="button" onclick="swalConfirm(event)">
                                                        {{ $faq->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </a>
                                                </form>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            {{-- Delete Button --}}
                                            <li>
                                                <form action="{{ route('cms.faqs.destroy', $faq->id) }}" method="POST">
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
                                <td class="text-nowrap">{{ ($faqs->currentPage() - 1) * $faqs->perPage() + $loop->iteration }}</td>
                                <td class="text-nowrap">
                                    <a tabindex="0" class="text-decoration-none text-dark" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="{{ $faq->answer }}">
                                        {{ $faq->question }}
                                    </a>
                                </td>
                                <td class="text-nowrap">{!! GeneralStatus::htmlLabel($faq->status) !!}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" id="test" colspan="5">
                                    Data tidak tersedia.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                @if ($faqs->total() > $faqs->perPage())
                <div class="card-footer">
                    {{ $faqs->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection