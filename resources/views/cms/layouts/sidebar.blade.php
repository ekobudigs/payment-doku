{{-- Sidebar --}}
<div class="app-sidebar">
    <div class="logo">
        <a class="logo-icon" href="{{ route('cms.dashboard') }}">
            <span class="logo-text">CMS</span>
        </a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img class="rounded-circle" src="{{ administrator()->avatar_path }}" alt="Administrator's Avatar">
                <span class="activity-indicator"></span>
                <span class="user-info-text">{{ administrator()->name }}<br>
                    <span class="user-state-info">{{ __('auth.profile.subtitle') }}</span>
                </span>
            </a>
        </div>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">Main</li>

            {{-- Sidebar Dashboard --}}
            <li class="{{ $sidebar['dashboard'] ?? '' }}">
                <a href="{{ route('cms.dashboard') }}">
                    <i class="material-icons text-dark">dashboard</i>
                    Dashboard
                </a>
            </li>

            <li class="sidebar-title">Master</li>
            
            {{-- Sidebar Administrators --}}
            <li class="{{ $sidebar['administrators'] ?? '' }}">
                <a href="{{ route('cms.administrators.index') }}">
                    <i class="material-icons text-dark">people</i>
                    Admin
                </a>
            </li>

            {{-- Sidebar Customers --}}
            <li class="{{ $sidebar['customers'] ?? '' }}">
                <a href="{{ route('cms.customers.index') }}">
                    <i class="material-icons text-dark">people</i>
                    Pelanggan
                </a>
            </li>

            <li class="sidebar-title">Konten Web</li>
            
            {{-- Sidebar Variants --}}
            <li class="{{ $sidebar['variants'] ?? '' }}">
                <a href="{{ route('cms.variants.index') }}">
                    <i class="material-icons text-dark">local_offer</i>
                    Paket Harga
                </a>
            </li>

            {{-- Sidebar FAQs --}}
            <li class="{{ $sidebar['faqs'] ?? '' }}">
                <a href="{{ route('cms.faqs.index') }}">
                    <i class="material-icons text-dark">question_answer</i>
                    FAQ
                </a>
            </li>

            <li class="sidebar-title">Konten Undangan</li>
            
            {{-- Sidebar Audios --}}
            <li class="{{ $sidebar['audios'] ?? '' }}">
                <a href="{{ route('cms.audios.index') }}">
                    <i class="material-icons text-dark">play_arrow</i>
                    Audio
                </a>
            </li>

            <li class="sidebar-title">
                Lainnya
            </li>
            <li>
                <a data-type="link" href="{{ route('cms.logout.process') }}" onclick="swalConfirm(event)">
                    <i class="material-icons text-dark pointer-events-none">power_settings_new</i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>
