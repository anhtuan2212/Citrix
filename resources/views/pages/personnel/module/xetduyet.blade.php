    {{-- // Xếp Lịch  --}}
    <div id="updatedropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarphongvan"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" onclick="close2form()" data-bs-dismiss="offcanvas"
                        aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <h3 id="add-title" style="text-align: center">Xếp Lịch Phỏng Vấn</h3>
                <div id="form_eva" class="offcanvas-body">
                    <form id="submit_insert_interview" class="row d-flex mt-5" action="" method="post">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="col-4 col-form-label w-100">Ứng Viên</label>
                                <input class="form-control " name="cv_ut_inter" id="cv_ut_inter" value="">
                                <input class="d-none " name="id_cv_ut_inter" id="id_cv_ut_inter" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="col-4 col-form-label w-100">Người
                                    Phỏng Vấn 1</label>
                                <input class="form-control " name="interviewer1" id="interviewer1" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="col-4 col-form-label w-100">Người Phỏng Vấn
                                    2</label>
                                <input class="form-control " name="interviewer2" id="interviewer2" value="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="col-sm-4 col-form-label">Ngày</label>
                                <input class="form-control " type="date" name="interview_date" id="interview_date"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="col-sm-4 col-form-label">giờ</label>
                                <input class="form-control " type="time" name="interview_time" id="interview_time"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="col-sm-4 col-form-label w-100">Hình
                                    Thức</label>
                                <select class="form-control " name="cate_inter" id="cate_inter">
                                    <option value="1">Trực Tiếp</option>
                                    <option value="0">online</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label id="location-text" for="example-text-input" class="col-sm-4 col-form-label">Địa
                                    Chỉ</label>
                                <input class="form-control " type="text" id="interview_location"
                                    name="interview_location">
                            </div>
                        </div>
                        @if ($authentication->personnel->inter_cv_autho === 'true')
                            <div class="wrapper col-md-6 mt-2 ">
                                <button type="submit" class="btn btn-success">Thêm</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Đánh Giá PV  --}}
    <div id="updatedropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarInterview"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" onclick="close2form()" data-bs-dismiss="offcanvas"
                        aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <h1 id="add-title" style="text-align: center">Đánh Giá Hồ Sơ</h1>
                <div id="form_eva" class="offcanvas-body row">
                    <div class="col-md-6" style="min-height:40rem">
                        <embed id="cv_url_interview" src="" height="100%" width="100%"></embed>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="row border" style="border-radius:10px ;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-sm-4 col-form-label w-100 ">Tên
                                            Ứng
                                            Viên</label>
                                        <input id="id_interview" class="d-none">
                                        <input class="form-control  border-0" id="xd_name_interview" type="text"
                                            name="xd_name_interview" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Email</label>
                                        <input class="form-control border-0" id="xd_email_interview"
                                            name="xd_email_interview" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-sm-4 col-form-label  w-100">Số Điện
                                            Thoại</label>
                                        <input class="form-control  border-0" type="text" id="xd_phone_interview"
                                            name="xd_phone_interview" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Ngày
                                            Sinh</label>
                                        <input class="form-control  border-0" type="date"
                                            name="xd_date_of_birth_interview" id="xd_date_of_birth_interview"
                                            value=""disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Giới
                                            Tính</label>
                                        <select class="form-control  border-0" name="xd_gender_interview"
                                            id="xd_gender_interview" disabled>
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-sm-4 col-form-label w-100">Vị Trí
                                            Ứng
                                            Tuyển</label>
                                        <input class="form-control  border-0" type="text"
                                            name="xd_nominees_interview" id="xd_nominees_interview"
                                            value=""disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Điểm Đánh
                                        Giá</label>
                                    <div class="d-flex justify-content-between">
                                        <label for="example-text-input">0 Điểm</label>
                                        <label for="example-text-input" id="point_inter"></label>
                                        <label for="example-text-input">10 Điểm</label>
                                    </div>
                                    <input type="range" class="form-range" min="0" max="10"
                                        step="0.5" id="customRange3">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1" id="about-text" class="col-sm-4 col-form-label">
                                Đánh Giá</label>
                            <textarea class="form-control" name="xd_note_interview" id="xd_note_interview" rows="3"></textarea>
                        </div>
                        <div class="wrapper col-12 mt-5 " style="text-align: center">
                            @if ($authentication->personnel->eva_cv_autho === 'true')
                                <a id="accept_interview" class="btn btn-success " data=2 style="margin-right: 5%">Gửi
                                    Đánh Giá</a>
                            @endif
                            @if ($authentication->personnel->faild_cv_autho === 'true')
                                <a id="faild_interview" class="btn btn-secondary accept_cv" data="6"
                                    style="margin-right: 5%">Từ
                                    Chối</a>
                            @endif
                            <a class="btn btn-danger" onclick="close2form()" data-bs-dismiss="offcanvas">close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- offer  --}}
    <div id="updatedropdown" class="bg-light fixed-top">
        <div class="container-fluid">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarOffer"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" onclick="close2form()" data-bs-dismiss="offcanvas"
                        aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <h3 id="add-title" style="text-align: center">Offer Ứng Viên</h3>
                <div id="form_eva" class="offcanvas-body row">
                    <div class="col-md-6" style="min-height:40rem">
                        <embed id="cv_url_offer" src="" height="100%" width="100%"></embed>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label w-100">Tên Ứng
                                        Viên</label>
                                    <input id="id_offer" class="d-none">
                                    <input class="form-control" id="name_offer" type="text" name="name_offer"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Email</label>
                                    <input class="form-control" id="email_offer" name="email_offer" type="text"
                                        value="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label  w-100">Số Điện
                                        Thoại</label>
                                    <input class="form-control " type="text" id="phone_offer" name="phone_offer"
                                        value="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label w-100">Ngày
                                        Sinh</label>
                                    <input class="form-control " type="date" name="date_of_birth_offer"
                                        id="date_of_birth_offer" value=""disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label w-100">Vị Trí Ứng
                                        Tuyển</label>
                                    <input class="form-control " type="text" name="nominees_offer"
                                        id="nominees_offer" value=""disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label w-100">Điểm Đánh
                                        Giá</label>
                                    <input class="form-control " type="text" name="point_offer" id="point_offer"
                                        value=""disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1" id="about-text" class="col-sm-4 col-form-label">
                                Đánh Giá</label>
                            <textarea class="form-control" name="note_offer" id="note_offer" rows="3" disabled></textarea>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label w-100">Nhân Sự
                                        Phỏng Vấn 1</label>
                                    <input class="form-control " type="text" name="interviewer1_offer"
                                        id="interviewer1_offer" value=""disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label w-100">Nhân Sự
                                        Phỏng Vấn 2</label>
                                    <input class="form-control " type="text" name="interviewer2_offer"
                                        id="interviewer2_offer" value=""disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-4 col-form-label w-100">Offer Cho
                                        Ứng Viên</label>
                                    <textarea class="form-control" name="send_note_offer" id="send_note_offer" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper col-12 mt-5 " style="text-align: center">
                            @if ($authentication->personnel->offer_cv_autho === 'true')
                                <a id="accept_offer" class="btn btn-secondary " data=2 style="margin-right: 5%">Gửi
                                    Offer</a>
                                <a id="accept_personnel" class="btn btn-success" onclick="addToPersonnel()"
                                    style="margin-right: 5%">Chấp
                                    Thuận</a>
                            @endif
                            @if ($authentication->personnel->faild_cv_autho === 'true')
                                <a id="faild_offer" class="btn btn-danger accept_cv" data="6"
                                    style="margin-right: 5%">Từ
                                    Chối</a>
                            @endif
                            <a class="btn btn-warning" onclick="close2form()" data-bs-dismiss="offcanvas">close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
