<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    {{-- Include Page Meta --}}
    @include('web.layouts.meta')

    {{-- Include Styles --}}
    @include('web.layouts.styles')

    <!-- Title -->
    <title>{{ $title ?? 'Title' }} | {{ config('app.name') }}</title>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="58">
    {{-- Include Topbar --}}
    @include('web.layouts.topbar')

    {{-- Content --}}
    @yield('content')

    {{-- Include Modals --}}
    @include('web.layouts.modals')

    {{-- Include Scripts --}}
    @include('web.layouts.scripts')

    {{-- Include Sweet Alert --}}
    @include('web.layouts.swals')
</body>

</html>
