<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">

            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SIMRS Project</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ $title == 'Home' ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon fa-solid fa-house"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Front Office</span>
        </li>

        <li class="menu-item {{ Request::is('front-office/patients*') ? 'active' : '' }}">
            <a href="{{ route('patients.index') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-person-circle-plus"></i>
                <div>Pasien</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('front-office/admissions*') ? 'active' : '' }}">
            <a href="{{ route('admissions.index') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-file-pen"></i>
                <div>Pendaftaran</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Back Office</span>
        </li>

        <li class="menu-item {{ Request::is('back-office/staffing*') ? 'active' : '' }}">
            <a href="{{ route('staffing.index') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-users-gear"></i>
                <div>Kepegawaian</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>

        <li class="menu-item {{ Request::is('front-office/polyclinics*') ? 'active' : '' }}">
            <a href="{{ route('polyclinics.index') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-hospital"></i>
                <div>Poliklinik</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('front-office/insurances*') ? 'active' : '' }}">
            <a href="{{ route('insurances.index') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-id-card"></i>
                <div>Asuransi</div>
            </a>
        </li>
    </ul>
</aside>
