{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
    $sidebar['administrators'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description d-flex align-items-center">
                    <div class="page-description-content flex-grow-1">
                        <h3 class="fw-bold">{{ $title }}</h3>
                        <h6 class="text-dark mt-2">{{ Breadcrumbs::render('cms.administrators.index') }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-start gap-2">
                        <a class="btn btn-sm btn-primary" href="{{ route('cms.administrators.create') }}">
                            Tambah {{ $title }}
                        </a>
                    </div>
                    <div class="card-body table-responsive overflow-y-hidden">
                        <table class="w-100 table">
                            <thead>
                                <tr>
                                    <th>Pilihan</th>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor Telepon</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($administrators as $administrator)
                                    <tr>
                                        <td>
                                            <div class="btn-group dropend">
                                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Pilihan
                                                </button>
                                                <ul class="dropdown-menu">
                                                    {{-- Edit Button --}}
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('cms.administrators.edit', $administrator->id) }}">Ubah</a>
                                                    </li>
        
                                                    {{-- Detail Button --}}
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('cms.administrators.show', $administrator->id) }}">Detail</a>
                                                    </li>
        
                                                    {{-- Toggle Status Button --}}
                                                    <li>
                                                        <form action="{{ route('cms.administrators.toggle', $administrator->id) }}" method="POST">
                                                            @csrf
                                                            <a class="dropdown-item" type="button" onclick="swalConfirm(event)">
                                                                {{ $administrator->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                            </a>
                                                        </form>
                                                    </li>
        
                                                    <li><hr class="dropdown-divider"></li>
        
                                                    {{-- Delete Button --}}
                                                    <li>
                                                        <form action="{{ route('cms.administrators.destroy', $administrator->id) }}" method="POST">
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
                                        <td class="text-nowrap">{{ ($administrators->currentPage() - 1) * $administrators->perPage() + $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $administrator->name }}</td>
                                        <td class="text-nowrap">{{ $administrator->email }}</td>
                                        <td class="text-nowrap">{{ $administrator->phone ?: '-' }}</td>
                                        <td class="text-nowrap">{!! GeneralStatus::htmlLabel($administrator->status) !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" id="test" colspan="6">
                                            Data tidak tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Pagination Links --}}
                    @if ($administrators->total() > $administrators->perPage())
                        <div class="card-footer">
                            {{ $administrators->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
