    <!-- ADD HRM dropdow  -->
    <div id="adddropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="offcanvas-body">
                    <h1 id="add-title" style="text-align: center">Thêm Nhân Sự</h1>
                    <form class="mt-8" method="POST" id="insert_personnel">
                        @csrf
                        <div class="mb-3 row ml-7">
                            <label for="fullname" class="col-sm-4 col-form-label">Tên Nhân Sự</label>
                            <div class="col-sm-6">
                                <input type="text" name="fullname" id="fullname" class="form-control" id="fullname"
                                    placeholder="(vd : Nguyễn Văn A)" />
                                <span class="text-danger text-xs pt-1 fullname_error"></span>
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" name="email" id="email" class="form-control"
                                    id="staticEmail" placeholder="email@example.com" />
                                <span class="text-danger text-xs pt-1 email_error"></span>
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" id="password" class="form-control"
                                    id="inputPassword" />
                                <span class="text-danger text-xs pt-1 password_error"></span>
                            </div>
                        </div>

                        <div class="mb-3 row ml-7">
                            <label for="phoneadd" class="col-sm-4 col-form-label">Số Điện Thoại</label>
                            <div class="col-sm-6">
                                <input type="text" name="phone" id="phone" class="form-control" id="phoneadd"
                                    placeholder="(vd : 0123456789)" />
                                <span class="text-danger text-xs pt-1 phone_error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row ml-7">
                            <label for="mansadd" class="col-sm-4 col-form-label">Địa Chỉ</label>
                            <div class="col-sm-6">
                                <input type="text" name="personnel_code" id="address" class="form-control"
                                    placeholder="(vd : SCN0001)" />
                                <span class="text-danger text-xs pt-1 address_error"></span>
                            </div>
                        </div>
                        <div id="btn-submit-add">
                            <button type="submit" id="btn_insert_personnel" class="btn btn-primary mt-7">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update HRM page -->
    <div id="updatedropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarupdate"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="offcanvas-body">
                    <h1 id="add-title" style="text-align: center">Sửa Nhân Sự</h1>
                    <form class="mt-5 col col-12" id="form_update" action="{{ route('update.user') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row wraper">
                            <div class="row">
                                <div class="col-4 justify-content-center" style="text-align: center">
                                    <div id="imgupdate">
                                        <img id="img_url" src="" width="100%" height="100%"
                                            alt="ảnh Nhân sự" />
                                    </div>
                                    <div class="m-3 col-9">
                                        <input type="file" name="img_url" onchange="readURL(this);"
                                            class="form-control" id="img_url_update">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-update d-none">
                                        <label for="mans" class="col-sm-4 col-form-label d-none">id :</label>
                                        <input type="text" readonly name="id" class="form-control d-none"
                                            id="id_user" required />
                                    </div>
                                    <div class="form-update">
                                        <label for="mans" class="col-sm-4 col-form-label">Mã Nhân Sự :</label>
                                        <input type="text" readonly id="personnel_codeu" class="form-control"
                                            id="mans" required />
                                    </div>
                                    <div class="form-update">
                                        <label for="name" class="col-sm-4 col-form-label">Họ Tên :</label>
                                        <input type="text" name="fullname" id="fullnameu" class="form-control"
                                            id="name" required />
                                    </div>
                                    <div class="form-update">
                                        <label for="Email" class="col-sm-4 col-form-label">Email :</label>
                                        <input type="email" name="email" id="emailu" class="form-control"
                                            id="Email" required />
                                    </div>
                                    <div class="form-update">
                                        <label for="phone" class="col-sm-4 col-form-label w-100">Số Điện
                                            Thoại:</label>
                                        <input type="text" name="phone" id="phoneu" class="form-control"
                                            id="phone" required />
                                    </div>
                                    <div class="form-update">
                                        <label for="phone" class="col-sm-4 col-form-label">Quê Quán:</label>
                                        <input type="text" name="address" id="addressup" class="form-control"
                                            id="phone" required />
                                    </div>

                                </div>
                                <div class="col-4">
                                    <label for="phongban" class="col-sm-4 col-form-label">Phòng Ban :</label>
                                    <select class="form-control" name="department_id" id="department_idu">
                                        @foreach ($phongbans as $pb)
                                            <option value="{{ $pb->id }}">{{ $pb->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="chucvu" class="col-sm-4 col-form-label">Chức Vụ :</label>
                                    <select class="form-control" name="position_id" id="position_idu">
                                        @foreach ($postions as $po)
                                            <option value="{{ $po->id }}">{{ $po->position }}</option>
                                        @endforeach
                                    </select>
                                    <label for="chucvu" class="col-sm-4 col-form-label">Chức Danh :</label>
                                    <select class="form-control get_position" name="nominee_bild" id="nominee_bild">
                                        {{-- @foreach ($nominees as $no)
                                            <option value="{{ $no->id }}">{{ $no->nominee }}</option>
                                        @endforeach --}}
                                    </select>
                                    <label for="trangthai" class="col-sm-4 col-form-label">Trạng Thái :</label>
                                    <select class="form-control" name="status" id="statusu">
                                        <option value="0">Chưa Kích Hoạt</option>
                                        <option value="1">Đang Hoạt Động</option>
                                        <option value="2">Nghỉ Phép</option>
                                        <option value="3">Khoá</option>
                                        <option value="4">Nghỉ việc</option>
                                    </select>
                                    <label for="trangthai" class="col-sm-4 col-form-label">Giới Tính :</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="0">Không được quy định</option>
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-update">
                                    <label for="dateofbirth" class="col-sm-4 col-form-label">Ngày Sinh:</label>
                                    <input type="date" name="date_of_birth" class="form-control"
                                        id="date_of_birthu" />
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-update">
                                    <label for="recrui" class="col-sm-4 col-form-label w-100">Ngày Tuyển
                                        Dụng:</label>
                                    <input type="date" name="recruitment_date" class="form-control"
                                        id="recruitment_dateu" />
                                </div>
                            </div>

                            <div class="col-4">
                                @if ($authentication->authority === 'true')
                                    <div class="form-update">
                                        <label for="recrui" class="col-sm-4 col-form-label">Nhóm Quyền:</label>
                                        <select class="form-control" name="autho_roles_ud" id="autho_roles_ud">
                                            <option selected>Chưa được quy định</option>
                                            @foreach ($authority as $item)
                                                <option value="{{ $item->id }}">{{ $item->name_autho }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="exampleFormControlTextarea1" id="about-text"
                                    class="col-sm-4 col-form-label">
                                    Giới
                                    Thiệu Về bản
                                    Thân
                                    :</label>
                                <textarea class="form-control" name="about" id="about" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="btn-group-update mt-5 align-items-center justify-content-center">
                            @if ($authentication->personnel->update_personnel === 'true')
                                <button class="btn btn-primary" id="btn_update_personnel">Cập Nhật</button>
                            @endif

                            <a data-bs-dismiss="offcanvas" aria-label="Close" class="btn btn-danger">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
