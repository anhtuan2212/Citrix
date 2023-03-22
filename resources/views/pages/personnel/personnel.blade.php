@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Nhân Sự'])

    @yield('personnel')

    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <ul class="nav nav-tabs justify-content-around border-0" id="myTab" role="tablist">
                <li class="nav-item" role="presentation" style="border-radius: 0.5rem;background: gainsboro; ">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true" style="border-radius: 0.5rem ">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Nhân Sự</h5>
                                <span id="usercount" class="h2 font-weight-bold mb-0">{{ $ucount }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </button>
                </li>
                <li class="nav-item" role="presentation" style="border-radius: 0.5rem;background: gainsboro; ">
                    <button class="nav-link" id="profile-tab" onclick="getallCV();" data-bs-toggle="tab"
                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false"style="border-radius: 0.5rem ">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Ứng Viên</h5>
                                <span id="cvcount" class="h2 font-weight-bold mb-0">{{ $cvcount }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                            </div>
                        </div>
                    </button>
                </li>
                <li class="nav-item" role="presentation" style="border-radius: 0.5rem;background: gainsboro; ">
                    <button class="nav-link" id="contact-tab" onclick="getallInter();" data-bs-toggle="tab"
                        data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                        aria-selected="false"style="border-radius: 0.5rem ">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Phỏng Vấn</h5>
                                <span id="xdcount" class="h2 font-weight-bold mb-0">{{ $xdcount }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fas fa-percent"></i>
                                </div>
                            </div>
                        </div>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    {{-- MAIN CONTENT  --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="tab-content mh-71vh" id="myTabContent">
                    {{-- =================================================================== tab HRM =================================================================== --}}
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class=" d-flex justify-content-between">
                                    <h6>Danh Sách Nhân Sự</h6>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Search..." id="search">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" name="department_select" id="department_select">
                                            <option value="" selected>Tất Cả Phòng ban</option>
                                            @foreach ($phongbans as $pb)
                                                <option value="{{ $pb->id }}">{{ $pb->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" name="status_select" id="status_select">
                                            <option value="" selected>Tất Cả Trạng Thái</option>
                                            <option value="0">Chưa Kích Hoạt</option>
                                            <option value="1">Đang Hoạt Động</option>
                                            <option value="2">Nghỉ Phép</option>
                                            <option value="3">Khoá</option>
                                            <option value="4">Nghỉ việc</option>
                                        </select>
                                    </div>

                                    <a id="form-add" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasNavbar">Thêm</a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2" id="body_query">
                                {!! \App\Models\User::UserBuild($nhansu) !!}
                            </div>
                        </div>
                    </div>
                    {{-- =================================================================== Tab HRM =================================================================== --}}

                    {{-- =================================================================== Tab Ứng tuyển =================================================================== --}}
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class=" d-flex justify-content-between">
                                    <h6>Hồ Sơ Ứng Tuyển</h6>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Search..." id="search_cv">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" name="status_select_cv" id="status_select_cv">
                                            <option value="9">Trạng Thái</option>
                                            <option value="0">Chưa Duyệt</option>
                                            <option value="1">Từ Chối</option>
                                            <option value="2">Đã Duyệt</option>
                                        </select>
                                    </div>
                                    <div>
                                        <a id="form-add" class="btn btn-primary" type="button"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarut">Thêm Hồ Sơ</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2" id="cvut_query">

                            </div>
                        </div>
                    </div>
                    {{-- =================================================================== Tab Ứng tuyển =================================================================== --}}

                    {{-- =================================================================== Tab Xét Duyệt =================================================================== --}}
                    <div class="tab-pane fade row " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        {{-- // --}}
                        <div class="card col-12">
                            <div class="card-header pb-0 ">
                                <div class=" d-flex bd-highlight " style="align-items: baseline;">
                                    <div class="card-header flex-grow-1 bd-highlight">
                                        <h4>Lịch Phỏng Vấn</h4>
                                    </div>
                                    <div class="col-md-2 bd-highlight" style="margin-right: 2% ;">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Search..." id="search_offer">
                                        </div>
                                    </div>
                                    <div class="col-md-2 bd-highlight">
                                        <select class="form-control" name="status_select_offer" id="status_select_offer">
                                            <option value="9">Trạng Thái</option>
                                            <option value="3">Đang Đánh Giá</option>
                                            <option value="4">Đang Offer</option>
                                            <option value="5">Đã Offer</option>
                                            <option value="6">Từ Chối</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2 row" id="interview_table">
                            </div>
                        </div>
                    </div>
                    {{-- =================================================================== Tab Xét Duyệt =================================================================== --}}
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
    {{-- tab HRM --}}
    @include('pages.personnel.module.nhansu')
    @include('pages.personnel.module.ungvien')
    @include('pages.personnel.module.xetduyet')
@endsection
