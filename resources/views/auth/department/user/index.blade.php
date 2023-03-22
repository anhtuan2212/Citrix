@extends('auth.department.index')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <form id="vip">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Thêm Nhân Viên Vào <span
                                        class="text-bolder">{{ $department[0]->name ?? '' }}</span></p>
                                <div>
                                    <a href="{{ route('position') }}" class="btn btn-primary btn-sm ms-auto me-2">
                                        Thêm Chức Vụ
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" id="user_search" type="text">
                                        <input type="text" name="department_id" data-user="{{ $user_max }}" value="{{ $department[0]->id ?? '' }}"
                                            hidden>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <table class="table align-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tên</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Ảnh</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Chức Vụ</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Chức Danh</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Số Điện Thoại</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Giới Tính</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_users">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    @if ($department[0]->children->count() > 0)
                                        <div class="mb-3">
                                            <p class="text-bold m-0">Phòng Ban Con</p>
                                            @foreach ($department[0]->children as $child)
                                                <a href="{{ route('department.user', ['id' => $child->id]) }}"
                                                    class="text-info department_relationship">{{ $child->name }}</a><br>
                                            @endforeach
                                        </div>
                                    @endif
                        
                                    @if ($department[0]->parent)
                                        <div>
                                            <p class="text-bold m-0">Phòng Ban Cha</p>
                                            <a href="{{ route('department.user', ['id' => $department[0]->parent->id]) }}"
                                                class="text-info department_relationship">{{ $department[0]->parent->name }}</a><br>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
