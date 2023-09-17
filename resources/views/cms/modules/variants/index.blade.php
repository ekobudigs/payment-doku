{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
$sidebar['variants'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1">
                    <h3 class="fw-bold">{{ $title }}</h3>
                    <h6 class="text-dark mt-2">{{ Breadcrumbs::render('cms.variants.index') }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-start gap-2">
                    <a class="btn btn-sm btn-primary" href="{{ route('cms.variants.create') }}">
                        Tambah {{ $title }}
                    </a>
                </div>
                <div class="card-body table-responsive overflow-y-hidden">
                    <table class="w-100 table">
                        <thead>
                            <tr>
                                <th class="align-top">Pilihan</th>
                                <th class="align-top">#</th>
                                <th class="align-top">Nama Paket</th>
                                <th class="align-top">Harga Paket</th>
                                <th class="align-top">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($variants as $variant)
                            <tr>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Pilihan
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- Edit Button --}}
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cms.variants.edit', $variant->id) }}">Ubah</a>
                                            </li>

                                            {{-- Detail Button --}}
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cms.variants.show', $variant->id) }}">Detail</a>
                                            </li>

                                            {{-- Toggle Status Button --}}
                                            <li>
                                                <form action="{{ route('cms.variants.toggle', $variant->id) }}" method="POST">
                                                    @csrf
                                                    <a class="dropdown-item" type="button" onclick="swalConfirm(event)">
                                                        {{ $variant->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </a>
                                                </form>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            {{-- Delete Button --}}
                                            <li>
                                                <form action="{{ route('cms.variants.destroy', $variant->id) }}" method="POST">
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
                                <td class="text-nowrap">{{ ($variants->currentPage() - 1) * $variants->perPage() + $loop->iteration }}</td>
                                <td class="text-nowrap">{{ $variant->name }}</td>
                                <td class="text-nowrap">{{ number_to_idr($variant->price) }}</td>
                                <td class="text-nowrap">{!! GeneralStatus::htmlLabel($variant->status) !!}</td>
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
                @if ($variants->total() > $variants->perPage())
                <div class="card-footer">
                    {{ $variants->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection