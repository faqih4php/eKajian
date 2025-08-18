@php
    $isLoggedIn = Auth::check();
    $user = Auth::user();
    $roles = $user ? $user->getRoleNames()->toArray() : [];
@endphp
<div style="display:none">
    <p>Is Logged In: {{ $isLoggedIn ? 'Yes' : 'No' }}</p>
    <p>Roles: {{ implode(', ', $roles) }}</p>
</div>

<aside id="layout-menu" class="layout-menu menu-vertical menu">
    <div class="app-brand demo ">
        <a href="" class="app-brand-link">
            <span class="app-brand-logo demo fs-3">e</span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Kajian</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base bx bx-chevron-left"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        @guest
            <li
                class="menu-item {{ Request::routeIs('guest.index', 'jadwal-kajian.*', 'request-kajian.*') ? 'active open' : '' }} ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base bx bx-home-smile"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Request::routeIs('guest.index') ? 'active' : '' }}">
                        <a href="{{ route('guest.index') }}" class="menu-link">
                            <div data-i18n="Home">Home</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::routeIs('jadwal-kajian.index') ? 'active' : '' }}">
                        <a href="{{ route('jadwal-kajian.index') }}" class="menu-link">
                            <div data-i18n="Jadwal Kajian">Jadwal Kajian</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::routeIs('request-kajian.create') ? 'active' : '' }}">
                        <a href="{{ route('request-kajian.create') }}" class="menu-link">
                            <div data-i18n="Request Kajian">Request Kajian</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="Pages">Pages</span>
            </li>
        @else
            <!-- Dashboards -->
            @if (auth()->user()->hasAnyRole(['super-admin']))
                <li
                    class="menu-item {{ Request::routeIs('home.index', 'jadwal-kajian.*', 'request-kajian.*') ? 'active open' : '' }} ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon icon-base bx bx-home-smile"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::routeIs('home.index') ? 'active' : '' }}">
                            <a href="{{ route('home.index') }}" class="menu-link">
                                <div data-i18n="Home">Home</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('jadwal-kajian.index') ? 'active' : '' }}">
                            <a href="{{ route('jadwal-kajian.index') }}" class="menu-link">
                                <div data-i18n="Jadwal Kajian">Jadwal Kajian</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('request-kajian.index') ? 'active' : '' }}">
                            <a href="{{ route('request-kajian.index') }}" class="menu-link">
                                <div data-i18n="Request Kajian">Request Kajian</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Apps & Pages -->
                {{-- Data Kebutuhan --}}
                <li class="menu-header small">
                    <span class="menu-header-text" data-i18n="Pages">Pages</span>
                </li>

                <li class="menu-item {{ Request::routeIs('user.*') ? 'active open' : '' }} ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon icon-base bx bxs-user-circle"></i>
                        <div>Admin List</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::routeIs('user.index') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}" class="menu-link">
                                <div data-i18n="Home">List Data</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('user.create') ? 'active' : '' }}">
                            <a href="{{ route('user.create') }}" class="menu-link">
                                <div>Create Admin</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ Request::routeIs('jabatans.*') ? 'active open' : '' }} ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon icon-base bx bx-chair"></i>
                        <div>Jabatan</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::routeIs('jabatans.index') ? 'active' : '' }}">
                            <a href="{{ route('jabatans.index') }}" class="menu-link">
                                <div data-i18n="Home">List Data</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('jabatans.create') ? 'active' : '' }}">
                            <a href="{{ route('jabatans.create') }}" class="menu-link">
                                <div>Create Jabatan</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ Request::routeIs('jenis-kajian.*') ? 'active open' : '' }} ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon icon-base bx bxs-shapes"></i>
                        <div>Jenis Kajian</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::routeIs('jenis-kajian.index') ? 'active' : '' }}">
                            <a href="{{ route('jenis-kajian.index') }}" class="menu-link">
                                <div data-i18n="Home">List Data</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('jenis-kajian.create') ? 'active' : '' }}">
                            <a href="{{ route('jenis-kajian.create') }}" class="menu-link">
                                <div>Create Jenis Kajian</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-header small">
                    <span class="menu-header-text" data-i18n="Pages">Features</span>
                </li>
            @elseif(auth()->user()->hasAnyRole(['admin']))
                <li
                    class="menu-item {{ Request::routeIs('home.index', 'jadwal-kajian.*', 'request-kajian.*') ? 'active open' : '' }} ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon icon-base bx bx-home-smile"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::routeIs('home.index') ? 'active' : '' }}">
                            <a href="{{ route('home.index') }}" class="menu-link">
                                <div data-i18n="Home">Home</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('jadwal-kajian.index') ? 'active' : '' }}">
                            <a href="{{ route('jadwal-kajian.index') }}" class="menu-link">
                                <div data-i18n="Jadwal Kajian">Jadwal Kajian</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('request-kajian.index') ? 'active' : '' }}">
                            <a href="{{ route('request-kajian.index') }}" class="menu-link">
                                <div data-i18n="Request Kajian">Request Kajian</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Apps & Pages -->
                {{-- Data Kebutuhan --}}
                <li class="menu-header small">
                    <span class="menu-header-text" data-i18n="Pages">Pages</span>
                </li>

                <li class="menu-item {{ Request::routeIs('jabatans.*') ? 'active open' : '' }} ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon icon-base bx bx-chair"></i>
                        <div>Jabatan</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::routeIs('jabatans.index') ? 'active' : '' }}">
                            <a href="{{ route('jabatans.index') }}" class="menu-link">
                                <div data-i18n="Home">List Data</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('jabatans.create') ? 'active' : '' }}">
                            <a href="{{ route('jabatans.create') }}" class="menu-link">
                                <div>Create Jabatan</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item {{ Request::routeIs('jenis-kajian.*') ? 'active open' : '' }} ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon icon-base bx bxs-shapes"></i>
                        <div>Jenis Kajian</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::routeIs('jenis-kajian.index') ? 'active' : '' }}">
                            <a href="{{ route('jenis-kajian.index') }}" class="menu-link">
                                <div data-i18n="Home">List Data</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::routeIs('jenis-kajian.create') ? 'active' : '' }}">
                            <a href="{{ route('jenis-kajian.create') }}" class="menu-link">
                                <div>Create Jenis Kajian</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-header small">
                    <span class="menu-header-text" data-i18n="Pages">Features</span>
                </li>
            @endif
        @endguest


    </ul>


</aside>

<div class="menu-mobile-toggler d-xl-none rounded-1">
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
        <i class="bx bx-menu icon-base"></i>
        <i class="bx bx-chevron-right icon-base"></i>
    </a>
</div>
