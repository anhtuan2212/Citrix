<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_update_equipment_form"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header text-center">
        <button type="button" style="margin-left:2% " class="btn-close text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        <h3 style="margin-right: 45%" id="offcanvasRightLabel">Cập Nhật Thiết Bị</h3>
    </div>
    <div class="offcanvas-body">
        <form class="row d-flex mt-5 justify-content-center" id="form_update_equipment_submit" method="post"
            enctype="multipart/form-data">
            <div class="col-md-4 row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_detail_name_update" class="col-4 col-form-label w-100">Tên Thiết
                            Bị</label>
                        <input class="d-none" name="equipment_id_update" id="equipment_id_update">
                        <input class="form-control " name="equipment_name_update" id="equipment_name_update"
                            placeholder="Tên thiết bị...">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_detail_warranty_expiration_date" class="col-4 col-form-label w-100">Thể
                            Loại</label>
                        <select class="form-control " name="equipment_type_update" id="equipment_type_update">
                            <option value="0">Chưa sử dụng</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_code" class="col-4 col-form-label w-100">Mã Thiết Bị</label>
                        <input class="form-control" type="text" name="equipment_code_update"
                            id="equipment_code_update" placeholder="Mã sản phẩm..." disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_status" class="col-sm-4 col-form-label w-100">Trạng
                            Thái</label>
                        <select class="form-control " name="equipment_status_update" id="equipment_status_update">
                            <option value="0">Đang Sử Dụng</option>
                            <option value="1">Đang Bảo Trì</option>
                            <option value="2">Đang Hết Sản Phẩm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_code" class="col-4 col-form-label w-100">Số Lượng sản phẩm trong thiết
                            bị</label>
                        <input class="form-control" type="text" name="equipment_quantity_update"
                            id="equipment_quantity_update" placeholder="Số Lượng..." disabled>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div id="quantity_show" class="col-8 d-none" style="margin-left:2%;margin-right:2% ">
                        <div class="form-group row">
                            <label for="equipment_status" class="col-sm-4 col-form-label w-100">Số lượng thêm</label>
                            <input class="form-control" type="text" name="equipment_quantity_add"
                                id="equipment_quantity_add"placeholder="Số Lượng...">
                        </div>
                    </div>
                    <a class="btn btn-success" onclick="openform_add_equipment()" id="btn-show-form-add"
                        style="margin: 25px;height:45px;width: 80px;margin-top: 35px;margin-bottom: 18px;">Thêm</a>
                </div>
            </div>
            <div class="row m-5">
                @include('pages.Equiments.module.form_add_equipment')
                <div class="card " id="table_update_product">
                </div>
            </div>
            <hr>
            <div class="wrapper col-md-12 mt-5 d-flex justify-content-around table_update_product_animation">
                <div>
                    <button type="submit" class="btn btn-success">Cập Nhật</button>
                    <button type="button" id="btn-delete-equipment-detail" class="btn btn-danger">Xóa</button>
                </div>
            </div>
        </form>
    </div>
</div>
