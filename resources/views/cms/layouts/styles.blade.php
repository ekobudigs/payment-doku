@stack('before-styles')

{{-- Icons --}}
<link type="text/css" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

{{-- Styles --}}
<link type="text/css" href="{{ asset('assets/cms/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/cms/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/cms/css/main.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/cms/css/custom.css') }}" rel="stylesheet">

{{-- Favicon --}}
<link type="image/png" rel="icon" sizes="32x32" href="{{ asset('assets/cms/images/neptune.png') }}" />

@stack('after-styles')
