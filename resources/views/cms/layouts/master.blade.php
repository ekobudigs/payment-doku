<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    {{-- Include Page Meta --}}
    @include('cms.layouts.meta')

    {{-- Include Styles --}}
    @include('cms.layouts.styles')

    <!-- Title -->
    <title>{{ $title ?? 'CMS' }} | {{ config('app.name') }}</title>
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        {{-- Include Sidebar --}}
        @include('cms.layouts.sidebar')

        <div class="app-container">
            {{-- Include Topbar --}}
            @include('cms.layouts.topbar')

            <div class="app-content">
                <div class="content-wrapper">
                    {{-- Content --}}
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    {{-- Include Modals --}}
    @include('cms.layouts.modals')

    {{-- Include Scripts --}}
    @include('cms.layouts.scripts')

    {{-- Include Sweet Alert --}}
    @include('cms.layouts.swals')
</body>

</html>
