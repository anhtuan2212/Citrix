<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="{{ asset('./img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Citrịx</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-100 " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Trang Chủ</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fab fa-laravel" style="color: #f4645f;"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Nhân Sự</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'personnel' ? 'active' : '' }}"
                    href="{{ route('personnel.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nhân Sự</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Danh mục thiết bị</h6>
            </li>
            {{-- Thiet bi link --}}
            <li class="nav-item">
                <a class="nav-link mx-3 {{ Route::currentRouteName() == 'equipment' ? 'active' : '' }}"
                    href="/equipment">
                    <i class="fa-solid fa-memory text-primary"></i>
                    <span class="nav-link-text ms-1">Thiết bị</span>
                </a>
            </li>

            {{-- Thiet bi link --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Phòng Ban</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-3 {{ Route::currentRouteName() == 'department' ? 'active' : '' }}"
                    href="{{ route('department') }}">
                    <i class="fa-solid fa-compass"></i>
                    <span class="nav-link-text ms-1">Quản Lý Phòng Ban</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link mx-3 {{ Route::currentRouteName() == 'overview' ? 'active' : '' }}"
                    href="{{ route('overview') }}">
                    <i class="fa-solid fa-building"></i>
                    <span class="nav-link-text ms-1">Sơ Đồ Công Ty</span>
                </a>
            </li>
            {{-- end Thiet bi link --}}
        </ul>
    </div>
</aside>
