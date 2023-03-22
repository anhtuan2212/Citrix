    <!-- ADD Ứng Tuyển dropdow  -->
    <div id="adddropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarut"
                aria-controls="offcanvasNavbarut">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarut"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="offcanvas-body">
                    <h1 id="add-title" style="text-align: center">Thêm Hồ Sơ Ứng Tuyển</h1>
                    <form class="mt-5" method="POST" id="form_insert_cv">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Tên Ứng
                                        Viên</label>
                                    <input class="form-control dbcl_ctl" id="name_ut" type="text" name="name_ut"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Email</label>
                                    <input class="form-control" id="email_ut" name="email_ut" type="text"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Số Điện
                                        Thoại</label>
                                    <input class="form-control " type="text" id="phone_ut" name="phone_ut"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Ngày Sinh</label>
                                    <input class="form-control " type="date" name="date_of_birth_ut"
                                        id="date_of_birth_ut" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Giới Tính</label>
                                    <select class="form-control " name="gender" id="gender_ut">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">CV</label>
                                    <input class="form-control" type="file" name="cv_ut" id="cv_ut"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Chức Vụ</label>
                                    <select class="form-control" name="position_ut" id="position_cv">
                                        @foreach ($postions as $po)
                                            <option value="{{ $po->id }}">{{ $po->position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Vị Trí Ứng
                                        Truyển</label>
                                    <select class="form-control get_position" name="nominees_ut" id="nominees_cv">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="exampleFormControlTextarea1" id="about-text"
                                    class="col-sm-4 col-form-label">
                                    Ghi Chú</label>
                                <textarea class="form-control" name="about_cv" id="about_cv" rows="3"></textarea>
                            </div>
                        </div>
                        <div id="btn-submit-add">
                            <button type="submit" id="btn_insert_cv" class="btn btn-primary mt-7">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Ứng Tuyển page -->
    <div id="adddropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbareditcv" aria-controls="offcanvasNavbareditcv">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbareditcv"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="offcanvas-body">
                    <h1 id="add-title" style="text-align: center">Sửa Hồ Sơ</h1>
                    <form class="mt-5" method="POST" id="form_update_cvut" enctype="multipart/form-data">
                        <input class="form-control d-none" id="id_ut_update" type="text" style="opacity: 0"
                            name="id_ut_update">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-4 col-form-label w-100">Tên Ứng
                                        Viên</label>
                                    <input class="form-control dbcl_ctl" id="name_ut_update" type="text"
                                        name="name_ut_update" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-4 col-form-label w-100">Email</label>
                                    <input class="form-control" id="email_ut_update" name="email_ut_update"
                                        type="text" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-4 col-form-label w-100">Số Điện
                                        Thoại</label>
                                    <input class="form-control " type="text" id="phone_ut_update"
                                        name="phone_ut_update" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-4 col-form-label w-100">Ngày
                                        Sinh</label>
                                    <input class="form-control " type="date" name="date_of_birth_ut_update"
                                        id="date_of_birth_ut_update" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-4 col-form-label w-100">Giới
                                        Tính</label>
                                    <select class="form-control " name="gender_ut_update" id="gender_ut_update">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-4 col-form-label w-100">CV</label>
                                    <input class="form-control" type="file" name="cv_ut_update" id="cv_ut_update"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-4 col-form-label w-100">Chức Vụ Ứng
                                        Tuyển</label>
                                    <select class="form-control" name="position_ut_update" id="position_ut_update">
                                        @foreach ($postions as $po)
                                            <option value="{{ $po->id }}">{{ $po->position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-4 col-form-label w-100">Vị Trí Ứng
                                        Truyển</label>
                                    <select class="form-control get_position" name="nominees_ut_update"
                                        id="nominees_ut_update">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="exampleFormControlTextarea1" id="about-text"
                                    class="col-4 col-form-label w-100">
                                    Ghi Chú</label>
                                <textarea class="form-control" name="about_ut_update" id="about_ut_update" rows="3"></textarea>
                            </div>
                        </div>
                        @if ($authentication->personnel->update_cv_autho === 'true')
                            <div id="btn-submit-add">
                                <button type="submit" id="btn_update_cv" class="btn btn-primary mt-7">Cập
                                    Nhật</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- // Duyệt CV  --}}
    <div id="updatedropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarevaluatecv"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" onclick="close2form()" data-bs-dismiss="offcanvas"
                        aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <h1 id="add-title" style="text-align: center">Đánh Giá Hồ Sơ</h1>
                <div id="form_eva" class="offcanvas-body row">
                    <div class="col-md-6" style="min-height:40rem">
                        <embed id="cv_url" src="" height="100%" width="100%"></embed>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label w-100">Tên Ứng
                                        Viên</label>
                                    <input class="form-control border-0" id="name_eva" type="text"
                                        name="name_ut" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Email</label>
                                    <input class="form-control border-0" id="email_eva" name="email_ut"
                                        type="text" value="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label  w-100">Số Điện
                                        Thoại</label>
                                    <input class="form-control border-0" type="text" id="phone_eva"
                                        name="phone_ut" value="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Ngày Sinh</label>
                                    <input class="form-control border-0" type="date" name="date_of_birth_ut"
                                        id="date_of_birth_eva" value=""disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Giới Tính</label>
                                    <select class="form-control border-0" name="gender" id="gender_eva" disabled>
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Chức Vụ</label>
                                    <input class="form-control border-0 " type="text" name="position_eva"
                                        id="position_eva" value=""disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Vị Trí</label>
                                    <input class="form-control border-0" type="text" name="nominees_eva"
                                        id="nominees_eva" value=""disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="exampleFormControlTextarea1" id="about-text"
                                    class="col-sm-4 col-form-label">
                                    Ghi Chú</label>
                                <textarea class="form-control border-0" name="about_eva" id="about_eva" rows="3" disabled></textarea>
                            </div>
                            <div id="note_cv" class="col-12 d-none setanimationshow">
                                <label for="exampleFormControlTextarea1" id="about-text"
                                    class="col-sm-4 col-form-label">
                                    Lý do </label>
                                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                                <a id="send_cv" class="btn btn-danger mt-3 accept_cv" data=1>Gửi</a>
                            </div>
                        </div>
                        <div class="wrapper col-12 mt-5 " style="text-align: center">
                            @if ($authentication->personnel->accept_cv_autho === 'true')
                                <a id="accept_cv" class="btn btn-success accept_cv" data=2
                                    style="margin-right: 5%">Duyệt</a>
                            @endif
                            @if ($authentication->personnel->faild_cv_autho === 'true')
                                <a onclick="openNote();" class="btn btn-secondary " style="margin-right: 5%">Từ
                                    Chối</a>
                            @endif
                            <a class="btn btn-danger" onclick="close2form()" data-bs-dismiss="offcanvas">close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
