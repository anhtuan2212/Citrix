<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_allocation" aria-labelledby="offcanvasRightLabel"
    style="z-index: 99999">
    <div class="offcanvas-header text-center">
        <button type="button" style="margin-left:2% " class="btn-close text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        <h3 style="margin-right: 45%" id="offcanvasRightLabel">Cấp Phát Thiết Bị</h3>
    </div>
    <div class="offcanvas-body">
        <form id="allocation_form_submit" class="row d-flex mt-5 justify-content-center" method="post">
            <div class="col-md-12 mb-4 row  d-flex justify-content-center">
                <div class="col-3 row d-flex justify-content-center text-center imgcover">
                    <img class="col-12" width="210" height="200" id="user-img-allocation" src="./img/avatar2.png"
                        alt="avatar">
                    <span class="text-sm border row mt-1" style="width: 59%;border-radius:10px;">
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <img width="10" height="10"
                                src="data:image/png;base64,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"
                                alt="">
                        </div>
                        Đang Hoạt Động
                    </span>
                </div>
                <div class="card col-4 justify-content-center">
                    <div class="form-group">
                        <label for="user_allocation_code" class="col-4 col-form-label w-100">Mã Nhân Sự</label>
                        <input class="form-control border-0 " name="user_allocation_code" id="user_allocation_code"
                            disabled="">
                    </div>
                    <div class="form-group">
                        <label for="user_allocation_name" class="col-4 col-form-label w-100">Nhân Sự</label>
                        <input class="form-control " name="user_allocation_name" id="user_allocation_name"
                            placeholder="Tên nhân sự..." disabled="">
                    </div>
                </div>

                <div class="col-3 row d-flex justify-content-center" style=" margin-top: 16px; margin-bottom: 0px;">
                    <div class="form-group">
                        <label for="user_allocation_phongban" class="col-4 col-form-label w-100">Phòng Ban</label>
                        <input class="form-control  border-0" name="user_allocation_phongban"
                            id="user_allocation_phongban" disabled="">
                    </div>
                    <div class="form-group">
                        <label for="user_allocation_chucvu" class="col-4 col-form-label w-100">Chức Vụ</label>
                        <input class="form-control border-0" name="user_allocation_chucvu" id="user_allocation_chucvu"
                            disabled="">
                    </div>
                </div>
            </div>
            <div class="col-md-12 row mt-4">
                <div class="col-6" id="table_equipment_allocation">

                </div>
                <div class="col-6" id="table_equipment_detail_allocation">

                </div>
            </div>
            <hr>
            <div class="wrapper col-md-12 mt-5 d-flex justify-content-around">
                <button type="submit" class="btn btn-success">Cấp Phát</button>
            </div>
        </form>
    </div>
</div>
