<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
    id="layout-navbar">
    @guest
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="icon-base bx bx-menu icon-md"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">


            <a href="{{ route('welcome') }}" class="nav-item btn btn-primary" style="color: #ffffff;"><i
                    class="icon-base bx bx-left-arrow-alt icon-md me-2" style="color: #ffffff;"></i>Back</a>

            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                    <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                        <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>
                    </a>
                </div>
            </div>

            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-md-auto">


                <!-- Style Switcher -->
                <li class="nav-item dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" id="nav-theme" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-sun icon-md theme-icon-active"></i>
                        <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                        <li>
                            <button type="button" class="dropdown-item align-items-center active"
                                data-bs-theme-value="light" aria-pressed="false">
                                <span><i class="icon-base bx bx-sun icon-md me-3" data-icon="sun"></i>Light</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark"
                                aria-pressed="true">
                                <span><i class="icon-base bx bx-moon icon-md me-3" data-icon="moon"></i>Dark</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system"
                                aria-pressed="false">
                                <span><i class="icon-base bx bx-desktop icon-md me-3" data-icon="desktop"></i>System</span>
                            </button>
                        </li>
                    </ul>
                </li>
                <!-- / Style Switcher-->
            </ul>
        </div>
    @else
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="icon-base bx bx-menu icon-md"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                    <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                        <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>
                    </a>
                </div>
            </div>

            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-md-auto">

                <!-- Style Switcher -->
                <li class="nav-item dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" id="nav-theme" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <i class="icon-base bx bx-sun icon-md theme-icon-active"></i>
                        <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                        <li>
                            <button type="button" class="dropdown-item align-items-center active"
                                data-bs-theme-value="light" aria-pressed="false">
                                <span><i class="icon-base bx bx-sun icon-md me-3" data-icon="sun"></i>Light</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark"
                                aria-pressed="true">
                                <span><i class="icon-base bx bx-moon icon-md me-3" data-icon="moon"></i>Dark</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system"
                                aria-pressed="false">
                                <span><i class="icon-base bx bx-desktop icon-md me-3" data-icon="desktop"></i>System</span>
                            </button>
                        </li>
                    </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="false">
                        <span class="position-relative">
                            <i class="icon-base bx bx-bell icon-md"></i>
                            @if ($pendingRequest->count() > 0)
                                <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-0">
                        <li class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h6 class="mb-0 me-auto">Notification</h6>
                                <div class="d-flex align-items-center h6 mb-0">
                                    @if ($pendingRequest->count() > 0)
                                        <span class="badge bg-label-warning me-2">
                                            {{ $pendingRequest->count() }} New
                                        </span>
                                    @else
                                        <span class="badge bg-label-danger me-2">
                                            There's nothing
                                        </span>
                                    @endif
                                    {{-- <a href="javascript:void(0)" class="dropdown-notifications-all p-2"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                                            class="icon-base bx bx-envelope-open text-heading"></i></a> --}}
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-notifications-list scrollable-container">
                            <ul class="list-group list-group-flush">
                                @forelse ($pendingRequest as $kajian)
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            {{-- <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img src="../../assets/img/avatars/1.png" alt=""
                                                        class="rounded-circle">
                                                </div>
                                            </div> --}}
                                            <div class="flex-grow-1 me-4">
                                                <h6>{{ $loop->iteration }}.</h6>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class=" mb-0 text-warning">Nama pemohon: {{ ucfirst($kajian->name) }}
                                                </h6>
                                                <h6 class="mb-0 text-info">Jenis Waktu Kajian:
                                                    {{ $kajian->jenis_kajian->name }}</h6>
                                                <h6 class="mb-3 d-block text-info">Tema Kajian:
                                                    @if ($kajian->tema_kajian == null)
                                                        Tidak ada tema kajian
                                                    @else
                                                        {{ ucfirst($kajian->tema_kajian) }}
                                                    @endif
                                                </h6>
                                                <h6 class="text-body mb-0">Lokasi: {{ $kajian->lokasi }}</h6>
                                                <h6 class="text-body">Waktu Kajian:
                                                    {{ \Carbon\Carbon::parse($kajian->waktu_kajian)->format('l, d F Y H:i') }}
                                                </h6>
                                                {{-- <form action="{{ route('request-kajian.approve', $kajian->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-label-success mb-3"
                                                            style="width: 85px; height: 27px;"><span
                                                                class="icon-base bx bx-check"></span></button>
                                                    </form>
                                                    <form action="{{ route('request-kajian.reject', $kajian->id) }}"
                                                        method="POST" class="form-reject">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-label-danger"
                                                            style="width: 85px; height: 27px;"><span
                                                                class="icon-base bx bx-x"></span></button>
                                                    </form> --}}
                                                <a href="{{ route('request-kajian.show', $kajian->id) }}"
                                                    class="btn btn-label-warning mt-2"
                                                    style="width: 170px; height: 35px;">
                                                    <h7>
                                                        Lihat Permohonan
                                                    </h7>
                                                </a>
                                            </div>
                                            <div class="flex">
                                                <div class="d-flex flex-column mt-7">

                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                {{-- <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                        class="badge badge-dot"></span></a> --}}
                                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                        class="icon-base bx bx-x"></span></a>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6>
                                                    Tidak ada notifikasi request kajian yang tersedia
                                                </h6>
                                            </div>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="border-top">
                            <div class="d-grid p-4">
                                <a class="btn btn-primary btn-sm d-flex" href="{{ route('request-kajian.index') }}">
                                    <small class="align-middle">Lihat semua permohonan</small>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="" alt="" class="rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="" alt="" class="w-px-40 h-auto rounded-circle">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                                        <small class="text-body-secondary">Role:
                                            @foreach (auth()->user()->getRoleNames() as $role)
                                                {{ Str::ucfirst($role) }}
                                            @endforeach
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider my-1"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pages-profile-user.html"> <i
                                    class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item" id> <i
                                        class="icon-base bx bx-power-off icon-md me-3"></i><span>Log
                                        Out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                <!--/ User -->


            </ul>
        </div>
    @endguest


</nav>
