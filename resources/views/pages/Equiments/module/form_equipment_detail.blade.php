<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_update_equipment_detail"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header text-center">
        <button type="button" style="margin-left:2% " class="btn-close text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        <h3 style="margin-right: 45%" id="offcanvasRightLabel">Sửa Sản Phẩm</h3>
    </div>
    <div class="offcanvas-body">
        <form id="submit_update_equipment_detail" class="row d-flex mt-5 justify-content-center" method="post"
            enctype="multipart/form-data">
            <div class="col-md-4 row">
                <div class="card col-12" style="width: 100%;border-radius: 10px;">
                    <div class="card-body col-12">
                        <img id="img_equipment_detail_show"
                            style="border-radius: 10px;max-width: 23em;max-height: 23em;" class="card-img-top"
                            alt="...">
                    </div>
                </div>
            </div>
            <div class="col-md-4 row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_detail_name_update" class="col-4 col-form-label w-100">Tên Thiết
                            Bị</label>
                        <input class="d-none " name="equipment_detail_id_update" id="equipment_detail_id_update">
                        <input class="form-control " name="equipment_detail_name_update"
                            id="equipment_detail_name_update" placeholder="Tên thiết bị..." disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_detail_warranty_expiration_date" class="col-4 col-form-label w-100">Hạn
                            Bảo Hành</label>
                        <input class="form-control " type="date" name="equipment_detail_warranty_expiration_date"
                            id="equipment_detail_warranty_expiration_date" placeholder="Số lượng...">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_detail_date_added" class="col-sm-4 col-form-label w-100">Ngày Nhập</label>
                        <input class="form-control " type="date" name="equipment_detail_date_added"
                            id="equipment_detail_date_added">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="img_equipment_detail" class="col-4 col-form-label w-100">Ảnh</label>
                        <input type="file" name="img_equipment_detail" onchange="readURL_img_equipment_detail(this);"
                            class="form-control" id="img_equipment_detail">
                    </div>
                </div>
            </div>
            <div class="col-md-4 row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="eequipment_detail_code" class="col-4 col-form-label w-100">Mã Sản Phẩm</label>
                        <input class="form-control" type="text" name="equipment_detail_code"
                            id="equipment_detail_code" placeholder="Mã sản phẩm..." disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_detail_imei_update" class="col-sm-4 col-form-label w-100">IMEI</label>
                        <input class="form-control " type="text" name="equipment_detail_imei_update"
                            id="equipment_detail_imei_update">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_type" class="col-4 col-form-label w-100">Nhà Cung Cấp</label>
                        <select class="form-control " name="equipment_detail_supplier" id="equipment_detail_supplier">

                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_type" class="col-4 col-form-label w-100">Trạng Thái</label>
                        <select class="form-control " name="equipment_detail_status" id="equipment_detail_status">
                            <option value="0">Chưa sử dụng</option>
                            <option value="1">Đang sử dụng</option>
                            <option value="2">Đang bảo trì</option>
                            <option value="3">Đang bảo hành</option>
                            <option value="4">Đang sửa chữa</option>
                            <option value="5">Đang đổi trả</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <label for="equipment_detail_specifications" id="equipment_note" class="col-sm-4 col-form-label">
                        Thông Số Kỹ Thuật</label>
                    <textarea class="form-control" name="equipment_detail_specifications" id="equipment_detail_specifications"
                        rows="5"></textarea>
                </div>
                <div class="col-4">
                    <label for="equipment_detail_note" id="equipment_note" class="col-sm-4 col-form-label">
                        Ghi Chú</label>
                    <textarea class="form-control" name="equipment_detail_note" id="equipment_detail_note" rows="5"></textarea>
                </div>
            </div>
            <div class="wrapper col-md-12 mt-5 d-flex justify-content-around">
                <button type="submit" class="btn btn-success">Cập Nhật</button>
            </div>
        </form>
    </div>
</div>
