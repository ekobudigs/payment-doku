{{-- Master Template --}}
@extends('cms.layouts.master')

{{-- Sidebar Configuration --}}
@php
    $sidebar['dashboard'] = 'active-page';
@endphp

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-description">
                    <h1>{{ $title ?? 'Title' }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- Total Customers --}}
            <div class="col-12 col-sm-6 col-lg-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-primary">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Total Pelanggan</span>
                                <span class="widget-stats-amount">{{ $count['customers'] }}</span>
                                <span class="widget-stats-info">141 Orders Total</span>
                            </div>
                            <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 4%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Administrators --}}
            <div class="col-12 col-sm-6 col-lg-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-success">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Total Admin</span>
                                <span class="widget-stats-amount">{{ $count['administrators'] }}</span>
                                <span class="widget-stats-info">141 Orders Total</span>
                            </div>
                            <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 4%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection