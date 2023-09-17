{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
$sidebar['customers'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1">
                    <h3 class="fw-bold">{{ $title }}</h3>
                    <h6 class="text-dark mt-2">{{ Breadcrumbs::render('cms.customers.index') }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-start gap-2">
                    <a class="btn btn-sm btn-primary" href="{{ route('cms.customers.create') }}">
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
                            @forelse ($customers as $i => $customer)
                            <tr>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Pilihan
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- Edit Button --}}
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cms.customers.edit', $customer->id) }}">Ubah</a>
                                            </li>

                                            {{-- Detail Button --}}
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cms.customers.show', $customer->id) }}">Detail</a>
                                            </li>

                                            {{-- Toggle Status Button --}}
                                            <li>
                                                <form action="{{ route('cms.customers.toggle', $customer->id) }}" method="POST">
                                                    @csrf
                                                    <a class="dropdown-item" type="button" onclick="swalConfirm(event)">
                                                        {{ $customer->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </a>
                                                </form>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            {{-- Delete Button --}}
                                            <li>
                                                <form action="{{ route('cms.customers.destroy', $customer->id) }}" method="POST">
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
                                <td class="text-nowrap">{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                                <td class="text-nowrap">{{ $customer->name }}</td>
                                <td class="text-nowrap">{{ $customer->email }}</td>
                                <td class="text-nowrap">{{ $customer->phone ?: '-' }}</td>
                                <td class="text-nowrap">{!! GeneralStatus::htmlLabel($customer->status) !!}</td>
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
                @if ($customers->total() > $customers->perPage())
                <div class="card-footer">
                    {{ $customers->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection