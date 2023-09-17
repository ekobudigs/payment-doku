<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('cms.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('cms.dashboard'));
});

// Dashboard > Admin
Breadcrumbs::for('cms.administrators.index', function (BreadcrumbTrail $trail) {
    $trail->parent('cms.dashboard');
    $trail->push('Admin', route('cms.administrators.index'));
});

// Dashboard > Admin > [Action]
Breadcrumbs::for('cms.administrators.action', function (BreadcrumbTrail $trail, $action) {
    $trail->parent('cms.administrators.index');
    $trail->push($action);
});

// Dashboard > Pelanggan
Breadcrumbs::for('cms.customers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('cms.dashboard');
    $trail->push('Pelanggan', route('cms.customers.index'));
});

// Dashboard > Pelanggan > [Action]
Breadcrumbs::for('cms.customers.action', function (BreadcrumbTrail $trail, $action) {
    $trail->parent('cms.customers.index');
    $trail->push($action);
});

// Dashboard > Paket Harga
Breadcrumbs::for('cms.variants.index', function (BreadcrumbTrail $trail) {
    $trail->parent('cms.dashboard');
    $trail->push('Paket Harga', route('cms.variants.index'));
});

// Dashboard > Paket Harga > [Action]
Breadcrumbs::for('cms.variants.action', function (BreadcrumbTrail $trail, $action) {
    $trail->parent('cms.variants.index');
    $trail->push($action);
});

// Dashboard > FAQ
Breadcrumbs::for('cms.faqs.index', function (BreadcrumbTrail $trail) {
    $trail->parent('cms.dashboard');
    $trail->push('FAQ', route('cms.faqs.index'));
});

// Dashboard > FAQ > [Action]
Breadcrumbs::for('cms.faqs.action', function (BreadcrumbTrail $trail, $action) {
    $trail->parent('cms.faqs.index');
    $trail->push($action);
});

// Dashboard > Audio
Breadcrumbs::for('cms.audios.index', function (BreadcrumbTrail $trail) {
    $trail->parent('cms.dashboard');
    $trail->push('Audio', route('cms.audios.index'));
});

// Dashboard > Audio > [Action]
Breadcrumbs::for('cms.audios.action', function (BreadcrumbTrail $trail, $action) {
    $trail->parent('cms.audios.index');
    $trail->push($action);
});
