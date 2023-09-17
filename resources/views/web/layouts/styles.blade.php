@stack('before-styles')

{{-- Styles --}}
<link href="{{ asset('assets/web/images/favicon.ico') }}" rel="shortcut icon">
<link type="text/css" href="{{ asset('assets/web/css/bootstrap.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/web/css/tiny-slider.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('assets/web/css/style.min.css') }}" rel="stylesheet">

{{-- Animate on Scroll --}}
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

{{-- Icons --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous"
    referrerpolicy="no-referrer">

{{-- Custom --}}
<link type="text/css" href="{{ asset('assets/web/css/custom.css') }}" rel="stylesheet">

@stack('after-styles')
