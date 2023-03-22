<div class="card d-none" id="form_add_product">
    <div class="row justify-content-center">
        <div class="col-md-4 row border rounded">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="equipment_detail_name_update" class="col-4 col-form-label w-100">Ngày nhập</label>
                    <input class="d-none" type="text" name="equipment_add_id" id="equipment_add_id">
                    <input class="form-control " type="date" name="equipment_add_date" id="equipment_add_date">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="warranty_expiration_date_add" class="col-4 col-form-label w-100">Hạn
                        Bảo Hành</label>
                    <input class="form-control " type="date" name="warranty_expiration_date_add"
                        id="warranty_expiration_date_add">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="supplier_id_add" class="col-4 col-form-label w-100">Nhà Cung
                        Cấp</label>
                    <select class="form-control " name="supplier_id_add" id="supplier_id_add">

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="quantity_add" class="col-sm-4 col-form-label w-100">Số
                        lượng</label>
                    <input class="form-control " type="text" name="quantity_add_form_add" id="quantity_add_form_add">
                </div>
            </div>
            <div class="col-md-12">
                <label for="specifications_add_form" id="equipment_note" class="col-sm-4 col-form-label">
                    Thông Số Kỹ Thuật</label>
                <textarea class="form-control" name="specifications_add_form" id="specifications_add_form" rows="5"></textarea>
            </div>
            <div class="col-md-12 mb-4">
                <label for="equipment_detail_note" id="equipment_note" class="col-sm-4 col-form-label">
                    Ghi chú</label>
                <textarea class="form-control" name="equipment_add_note" id="equipment_add_note" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="text-center mt-2">
        <a id="btn_add_quantity_equipment"class="btn btn-success">Thêm</a>
        <a class="btn btn-danger" id="close_form_add_equipment">Đóng</a>
    </div>
    <hr>
</div>
