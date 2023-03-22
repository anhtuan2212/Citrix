@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" id="form_update_profile" action={{ route('update.profile') }}>
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="fs-3 mb-0 ">Hồ Sơ Người Dùng</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">THÔNG TIN NGƯỜI DÙNG</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Họ Tên</label>
                                        <input class="form-control dbcl_ctl" id="fullname_profile" type="text"
                                            name="fullname" value="{{ $users->fullname }}" disabled="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Mã Nhân Sự</label>
                                        <input class="form-control" id="personnel_code_profile" type="text"
                                            value="{{ $users->personnel_code }}" disabled="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input class="form-control dbcl_ctl" type="email" id="email_profile"
                                            name="email" value="{{ $users->email }}" disabled="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Số Điện Thoại</label>
                                        <input class="form-control dbcl_ctl" type="text" name="phone"
                                            id="phone_profile" value="{{ $users->phone }}" disabled="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ngày Sinh</label>
                                        <input class="form-control dbcl_ctl" type="date" name="date_of_birth"
                                            id="date_of_birth_profile" value="{{ $users->date_of_birth }}" disabled="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Giới Tính</label>
                                        <select class="form-control dbcl_ctl" name="gender" id="gender_profile"
                                            disabled="true">
                                            <option value="0" {{ $users->gender == 0 ? 'selected' : '' }}>chưa được
                                                xác định</option>
                                            <option value="1" {{ $users->gender == 1 ? 'selected' : '' }}>Nam</option>
                                            <option value="2"{{ $users->gender == 2 ? 'selected' : '' }}>Nữ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Quê Quán</label>
                                        <input class="form-control dbcl_ctl" type="text" name="address"
                                            id="address_profile" value="{{ old('address', auth()->user()->address) }}"
                                            disabled="true">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">THÔNG TIN THÊM</p>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ngày Tuyển Dụng</label>
                                        <input class="form-control " type="date" name="recruitment_date"
                                            id="recruitment_date_profile" value="{{ $users->recruitment_date }}"
                                            disabled="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Chức Vụ</label>
                                        <select class="form-control dbcl_ctl" name="gender" id="position_id_profile"
                                            disabled="true">
                                            @foreach ($postions as $pos)
                                                <option value="{{ $pos->id }}"
                                                    {{ Auth::user()->position_id == $pos->id ? 'selected' : '' }}>
                                                    {{ $pos->position }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Phòng Ban</label>
                                        <select class="form-control dbcl_ctl" name="gender" id="department_id_profile"
                                            disabled="true">
                                            @foreach ($phongbans as $pbp)
                                                <option value="{{ $pbp->id }}"
                                                    {{ Auth::user()->department_id == $pbp->id ? 'selected' : '' }}>
                                                    {{ $pbp->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">About me</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Giới Thiệu Về Bản
                                            Thân</label>
                                        <textarea class="form-control dbcl_ctl" name="about" id="about_profile" rows="3" disabled="true">{{ $users->about }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    @if (!auth()->user()->img_url == '')
                                        <img src="./img/{{ auth()->user()->img_url }}"
                                            class="rounded-circle img-fluid border border-2 border-white">
                                    @else
                                        <img src="/img/team-2.jpg"
                                            class="rounded-circle img-fluid border border-2 border-white">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0 mt-2">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder">22</span>
                                        <span class="text-sm opacity-8">Thành Tích</span>
                                    </div>
                                    <div class="d-grid text-center mx-4">
                                        <span class="text-lg font-weight-bolder">10</span>
                                        <span class="text-sm opacity-8">Khen Thưởng</span>
                                    </div>
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder">89</span>
                                        <span class="text-sm opacity-8">Nhận Xét</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">

                            <h5>
                                {{ old('fullname', auth()->user()->fullname ?? 'Chưa có tên') }} <span
                                    class="font-weight-light">,{{ $age }}</span>
                            </h5>
                            @if (!auth()->user()->address == '')
                                <div class="h6 font-weight-300">
                                    <i
                                        class="ni location_pin mr-2"></i>{{ old('address', auth()->user()->address ?? '') }}
                                </div>
                            @endif
                            @if (!$users->nominees == '')
                                <div class="h6">
                                    <i class="ni business_briefcase-24 mr-2"></i>{{ $users->nominees }} | <i
                                        class="ni business_briefcase-24 mr-2"></i>{{ $users->name }}
                                </div>
                            @endif

                            <div>
                                <i class="ni education_hat mr-2"></i>SCONNECT.NET
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thiết
                                        Bị Sử Dụng
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="equiment_user">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
