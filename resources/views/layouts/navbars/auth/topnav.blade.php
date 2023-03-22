<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}"
    id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $title }}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item pe-2 d-flex align-items-center">
                    <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <span class="nav-link text-white font-weight-bold px-0">
                            <div class="dropdown">
                                <button class="btn border-0 dropdown-toggle mb-0 shadow-none"
                                    style="background-color:transparent; color: white" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user me-sm-1"></i> {{ Auth::user()->fullname ?? 'User' }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                                    style="top: 1rem !important">
                                    <li><a class="dropdown-item" href="{{ route('index.authorization') }}">Phân
                                            Quyền</a></li>
                                    <li>
                                        <a href="{{ route('profile') }}" class="dropdown-item">
                                            Hồ Sơ Người Dùng
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit(); sessionStorage.clear();"
                                            class="dropdown-item">
                                            Đăng Xuất
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </span>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
