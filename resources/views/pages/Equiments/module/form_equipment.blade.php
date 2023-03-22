<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header text-center">
        <h3 id="offcanvasRightLabel ">Thêm Thiết Bị</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fa fa-times" aria-hidden="true"></i></button>
    </div>
    <div class="offcanvas-body">
        <form id="submit_insert_equipment" class="row d-flex mt-5" action="{{ route('insert.equipment') }} method="post"
            enctype="multipart/form-data">
            <div class="col-md-6 row">
                <div class="card col-12" style="width: 100%;">
                    <div class="card-body col-12">
                        <img id="img_img_equipment_show"
                            src="https://i0.wp.com/thatnhucuocsong.com.vn/wp-content/uploads/2022/09/anh-anime-chibi.jpg?ssl=1"
                            class="card-img-top" alt="...">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="img_equipment" class="col-4 col-form-label w-100">Ảnh</label>
                        <input type="file" name="img_equipment" onchange="readURL_img_equipment(this);"
                            class="form-control" id="img_equipment">
                    </div>
                </div>
            </div>
            <div class="col-md-6 row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="example-text-input" class="col-4 col-form-label w-100">Tên Thiết Bị</label>
                        <input class="form-control " name="equipment_name" id="equipment_name"
                            placeholder="Tên thiết bị...">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="example-text-input" class="col-4 col-form-label w-100">Thể Loại</label>
                        <select class="form-control " name="equipment_type" id="equipment_type">
                            <option selected>Thể Loại</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_quantity" class="col-4 col-form-label w-100">Số lượng</label>
                        <input class="form-control " type="number" name="equipment_quantity" id="equipment_quantity"
                            placeholder="Số lượng...">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_date_added" class="col-sm-4 col-form-label w-100">Ngày Nhập</label>
                        <input class="form-control " type="date" name="equipment_date_added"
                            id="equipment_date_added">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_warranty_expiration_date" class="col-sm-4 col-form-label w-100">Hạn Bảo
                            Hành</label>
                        <input class="form-control " type="date" name="equipment_warranty_expiration_date"
                            id="equipment_warranty_expiration_date">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="equipment_type" class="col-4 col-form-label w-100">Nhà Cung Cấp</label>
                        <select class="form-control " name="equipment_supplier" id="equipment_supplier">
                            <option selected>Nhà cung cấp</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="equipment_specifications" id="equipment_note" class="col-sm-4 col-form-label">
                        Thông Số Kỹ Thuật</label>
                    <textarea class="form-control" name="equipment_specifications" id="equipment_specifications" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <label for="equipment_note" id="equipment_note" class="col-sm-4 col-form-label">
                        Ghi Chú</label>
                    <textarea class="form-control" name="equipment_note" id="equipment_note" rows="3"></textarea>
                </div>
            </div>
            <div class="wrapper col-md-12 mt-5 d-flex justify-content-around">
                <button type="submit" class="btn btn-success">Thêm</button>
                <button type="button" class="btn btn-secondary" id="btn-equipmnet-manager" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop_equipment_type">
                    Thể Loại
                </button>
                <button type="button" id="btn-manager-suppliers" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop_supplier">
                    Nhà Cung Cấp
                </button>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop_equipment_type" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Quản Lý Thể Loại</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body" style="min-height: 50vh; min-width: 90% !important;">
                <div class="rom-add-type w-100">
                    <div class="mb-3 row">
                        <div class="col-sm-9">
                            <label class="col-4 col-form-label w-100" for="equipment_type_code_insert">Mã Thể
                                Loại</label>
                            <input class="d-none" type="text" name="equipment_type_id" id="equipment_type_id" />
                            <input type="text" name="equipment_type_insert" id="equipment_type_insert"
                                class="form-control" placeholder="Vui lòng nhập tên..." />
                        </div>
                        <div class="col-3 align-items-center mt-4"><a href="" id="insert_emquipment_types"
                                class="btn btn-success mt-3">Thêm</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="col-4 col-form-label w-100" for="equipment_type_code_insert">Mã Thể
                                Loại</label>
                            <input type="text" name="equipment_type_code_insert" id="equipment_type_code_insert"
                                class="form-control" placeholder="Vui lòng nhập mã..." />
                        </div>
                        <div class="col-4 mt-5">
                            <input type="checkbox" name="ischild" id="ischild">Linh kiện
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-center">Các thể loại</h5>
                    </div>
                </div>
                <div class="show-cate w-100">
                    <div id="list_equipment_type_build">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop_supplier" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Quản Lý Nhà Cung Cấp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body" style="min-height: 50vh; min-width: 90% !important;">
                <div class="rom-add-type w-100">
                    <div class="mb-3 row">
                        <label for="suppliers" class="col-sm-3 col-form-label">Tên đơn vị</label>
                        <div class="col-sm-6">
                            <input type="text" name="suppliers_id" id="suppliers_id" class="d-none" />
                            <input type="text" name="suppliers" id="suppliers" class="form-control"
                                placeholder="Tên đơn vị..." />
                        </div>
                        <div class="col-1 align-items-center"><a href="" id="insert-suppliers-btn"
                                class="btn btn-success">Thêm</a></div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-center">Các Nhà Cung Cấp Hiện Có</h5>
                    </div>
                </div>
                <div class="show-cate w-100">
                    <div id="list_supplier_build">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
