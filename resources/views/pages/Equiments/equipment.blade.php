@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Thiết Bị'])

    @yield('equipment')
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <ul class="nav nav-tabs justify-content-around border-0" id="myTab" role="tablist">
                <li class="nav-item" role="presentation" style="border-radius: 0.5rem;background: gainsboro; ">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true" style="border-radius: 0.5rem ">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Thiết Bị</h5>
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
                    <button class="nav-link" id="handing_over_tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile"
                        aria-selected="false"style="border-radius: 0.5rem ">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Bàn Giao</h5>
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
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                        role="tab" aria-controls="contact" aria-selected="false"style="border-radius: 0.5rem ">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Kho</h5>
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
                    {{-- ===================================================================Thieets Bi =================================================================== --}}
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class=" d-flex bd-highlight">
                                    <h5 class="p-2 p-2 flex-grow-1 bd-highlight">Quản Lý Thiết Bị</h5>
                                    <div class="wraper-btn  p-2 bd-highlight" style="margin-right: 5%">
                                        <select class="form-control " style="min-width: 200px;"
                                            name="equipment_types_fillter" id="equipment_types_fillter">
                                            <option value="99">Tất cả thể loại</option>
                                            @foreach ($equiment_type as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="wraper-btn  p-2 bd-highlight" style="margin-right: 5%">
                                        <input class="form-control" type="text" name="search_equipment"
                                            id="search_equipment"placeholder="Tìm kiếm...">
                                    </div>
                                    <div class="wraper-btn p-2 bd-highlight">
                                        <button class="btn btn-success" id="btn-add-equipment" type="button"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                            aria-controls="offcanvasRight">Thêm</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="row m-1 d-flex justify-content-between">
                                    <div class="col-6 p-2" id="table_equipment" style="min-height: 40vh;">
                                        {!! \App\Models\Equipment::biuld_equipment($equipments) !!}
                                    </div>
                                    <div class="col-6 p-1 " id="table_equipment_detail" style="min-height: 40vh;">
                                        {!! \App\Models\EquipmentDetail::build_equipment_detail($equipment_detail, $equiment) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- =================================================================== Thiết Bị=================================================================== --}}

                    {{-- =================================================================== Bàn Giao =================================================================== --}}
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="handing_over_tab">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class=" d-flex justify-content-between">
                                    <h5>Bàn Giao Thiết Bị</h5>
                                    <a href="" class="btn btn-success">Bàn Giao</a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="row d-flex justify-content-center">
                                    <div class="row d-flex justify-content-center p-3">
                                        <div class="col-4 box-shadow-items"
                                            style="height: 60vh;margin-right: 5%;overflow: scroll;">
                                            <h4 class="text-center mt-3">Biến Động Thiết Bị</h4>
                                            <div class="table-responsive none-scroll-x add-scroll-y">
                                                <table class="table table-striped table-hover ">
                                                    <thead class="table-light">
                                                        <caption></caption>
                                                        <colgroup>
                                                            <col width="150" span="1">
                                                        </colgroup>
                                                        <tr>
                                                            <th class="text-center">Nội Dung</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="add-scroll">
                                                            <td class="row">
                                                                <div class="col-12">22/12/2001 - 09:05:20</div>
                                                                <div title="Click vào xem chi tiết"
                                                                    class="col-12 cusor-poiter">LAP00001 đã được cấp cho
                                                                    <a href="/profile"><strong>Đặng Anh
                                                                            Tuấn</strong></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>

                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="col-7" style="height: 60vh;" id="table_personnel_in_equipment">
                                            {!! \App\Models\User::build_personnel_in_equipment($personnel) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ===================================================================Bàn Giao =================================================================== --}}

                        {{-- =================================================================== Kho =================================================================== --}}
                        <div class="tab-pane fade row " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            {{-- // --}}
                            <div class="card col-12">
                                <div class="card-header pb-0 ">
                                    <div class=" d-flex bd-highlight " style="align-items: baseline;">
                                        <h1>Kho</h1>
                                    </div>
                                </div>
                                <div class="card-body px-0 pt-0 pb-2 row">
                                </div>
                            </div>
                        </div>
                        {{-- =================================================================== Kho =================================================================== --}}
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth.footer')
        </div>
        @include('pages.Equiments.module.form_equipment')
        @include('pages.Equiments.module.form_equipment_update')
        @include('pages.Equiments.module.form_equipment_detail')
        @include('pages.Equiments.module.form_add_equipment')
        @include('pages.Equiments.module.form_handing_over')
        @include('pages.Equiments.module.form_allocation')
        @include('pages.Equiments.module.form_device_recall')
    @endsection
