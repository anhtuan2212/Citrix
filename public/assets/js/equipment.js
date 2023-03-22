var arr_data_equipment = [];
var arr_data_allocation = [];
sessionStorage.removeItem("arr_data_equipment");
sessionStorage.removeItem("arr_data_allocation");
// phần xóa thiết bị
$(document).on("change", ".checked_delete_in_update", function () {
    var isChecked = $(this).is(":checked");
    var id_eq = $(this).attr("data-equipment");
    if (isChecked) {
        arr_data_equipment.push(id_eq);
    } else {
        arr_data_equipment.splice(arr_data_equipment.indexOf(id_eq), 1);
    }
    sessionStorage.setItem("arr_data_equipment", arr_data_equipment);
});
function checked_paginate_equipment() {
    var ar = sessionStorage.getItem("arr_data_equipment");
    if (ar == null) {
        return;
    }
    var arr = ar.split(",");
    for (let index = 1; index <= 6; index++) {
        var id_eq = $("#data-equipment-row-" + index).attr("data-equipment");
        var x = arr.indexOf(id_eq);
        if (x !== -1) {
            $("#data-equipment-row-" + index).prop("checked", true);
        }
    }
}
//phần cấp phát
$(document).on("change", ".checked_select_equipment_detail", function () {
    var isChecked = $(this).is(":checked");
    var id_eq_detail = $(this).attr("data-equipment-detail");
    var id_eq = $("#title-allocation-equipment").attr("data-quipment");
    if (isChecked) {
        arr_data_allocation.push(id_eq_detail);
        console.log(arr_data_allocation);
    } else {
        arr_data_allocation.splice(
            arr_data_allocation.indexOf(id_eq_detail),
            1
        );
    }
    sessionStorage.setItem("arr_data_allocation", arr_data_allocation);
});
function checked_paginate_equipment_allocation() {
    var id = $("#title-allocation-equipment").attr("data-quipment");
    $("#id_equipment_select_" + id).addClass("bgr-selected2");
    var ar = sessionStorage.getItem("arr_data_allocation");
    if (ar == null) {
        return;
    }
    var arr = ar.split(",");
    for (let index = 1; index <= 6; index++) {
        var id_eq = $("#row-data-equipment-detail-" + index).attr(
            "data-equipment-detail"
        );
        var x = arr.indexOf(id_eq);
        if (x !== -1) {
            $("#row-data-equipment-detail-" + index).prop("checked", true);
        }
    }
}
function get_quipment_detail_allocation(id) {
    $(".bgr-selected2").removeClass("bgr-selected2");
    $.ajax({
        type: "GET",
        url: "/equipment_detail/allocation/get",
        data: {
            id: id,
        },
        success: (response) => {
            if (response.status == "error") {
                onAlertError(response.message);
            } else {
                $("#table_equipment_detail_allocation").html(response.body);
                checked_paginate_equipment_allocation();
                var id = $("#title-allocation-equipment").attr("data-quipment");
                $("#id_equipment_select_" + id).addClass("bgr-selected2");
            }
        },
        error: function (error) {
            onAlertError(error.responseJSON.message);
        },
    });
}
//allocation
$(document).ready(function () {
    $("#allocation_form_submit").on("submit", function (e) {
        var user_id = $("#id_user_in_equipment").val();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/equipment/allocation",
            data: {
                user_id: user_id,
                arr: arr_data_allocation,
            },
            success: (response) => {
                if (response.status == "error") {
                    onAlertError(response.message);
                } else {
                    onAlertSuccess(response.message);
                    arr_data_allocation = [];
                    sessionStorage.removeItem("arr_data_allocation");
                }
            },
            error: function (error) {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});

$(document).on("click", ".equipment-table-row", function () {
    // e.preventDefault();
    $(".bgr-selected").removeClass("bgr-selected");
    var id = $(this).attr("data-get");
    var id_element = $(this).attr("select-id");
    $.ajax({
        url: "/equipment_detail",
        type: "GET",
        data: {
            id: id,
        },
        success: (response) => {
            if (response.status == "success") {
                $("#table_equipment_detail").html(response.body);
                $("#" + id_element).addClass("bgr-selected");
            }
        },
        error: (error) => {},
    });
});
$(document).on("click", "#btn-delete-equipment-detail", function () {
    if (arr_data_equipment.length === 0) {
        onAlertError("Vui lòng chọn sản phẩm cần xóa !");
        return;
    }
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
    });
    swalWithBootstrapButtons
        .fire({
            title: "Xác nhận xóa ?",
            text: "Bạn muốn xóa những sản phẩm này !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Xóa",
            cancelButtonText: "Không",
            reverseButtons: true,
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/equipment_detail/delete",
                    type: "post",
                    data: {
                        // code: "123",
                        id: arr_data_equipment,
                    },
                    success: (response) => {
                        if (response.status == "success") {
                            getall_equipment_detail_for_update();
                            swalWithBootstrapButtons.fire(
                                "Thành Công !",
                                "Xóa thành công !",
                                "success"
                            );
                            arr_data_equipment = [];
                            sessionStorage.removeItem("arr_data_equipment");
                        } else {
                            onAlertError(response.message);
                        }
                    },
                    error: (error) => {
                        onAlertError(error.responseJSON.message);
                    },
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    "Đã Hủy !",
                    "Tác vụ xóa đã được hủy !",
                    "success"
                );
            }
        });
});
$(document).ready(() => {
    $("#btn_add_quantity_equipment").on("click", () => {
        openform_add_equipment();
    });
});
function openform_add_equipment() {
    var id = $("#equipment_id_update").val();
    $("#equipment_add_id").val(id);
    $("#form_add_product").removeClass("d-none");
    $("#form_add_product").addClass("d-block");
    $("#btn-show-form-add").addClass("d-none");
    $("#form_add_product").addClass("btn-animation-top");
    $("#table_update_product_animation").removeClass("d-block");
    $("#table_update_product").addClass("d-none");
    $(".table_update_product_animation").addClass("d-none");
}
function closeform_add_equipment() {
    $("#equipment_add_id").val("");
    $("#btn-show-form-add").removeClass("d-none");
    $("#form_add_product").removeClass("d-block");
    $("#form_add_product").addClass("d-none");
    $("#table_update_product").removeClass("d-none");
    $("#table_update_product").addClass("d-block");
    $("#table_update_product").addClass("table-animation-bottom");
    $(".table_update_product_animation").removeClass("d-none");
    $(".table_update_product_animation").addClass("table-animation-bottom");
}
function readURL_img_equipment(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#img_img_equipment_show").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
function readURL_img_equipment_detail(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#img_equipment_detail_show").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
//get equipment_type build on insert equipment3
$(document).ready(() => {
    $("#btn-add-equipment").on("click", () => {
        builalltypes();
    });
});
function builalltypes() {
    $.ajax({
        url: "equipment_type",
        type: "GET",
        success: (response) => {
            var data = response.equipment_types;
            let html = "";
            $.each(data, (index, value) => {
                html += `<option value="${value.id}">${value.name}</option>`;
            });
            $("#equipment_type").html(html);
            $("#equipment_type_update").html(html);
            get_all_supplier();
            builalltypes_update();
        },
    });
}
builalltypes_update();
function builalltypes_update() {
    $.ajax({
        url: "equipment_type",
        type: "GET",
        success: (response) => {
            var data = response.equipment_types;
            let html = "";
            $.each(data, (index, value) => {
                html += `<option value="${value.id}">${value.name}</option>`;
            });
            $("#equipment_type_update").html(html);
        },
    });
}
$(document).ready(() => {
    $("#btn-equipmnet-manager").on("click", () => {
        getAlldataEquipmentTypes();
    });
});
$(document).ready(() => {
    $("#btn-manager-suppliers").on("click", () => {
        GetAllSuppliers();
    });
});
function GetAllSuppliers() {
    $.ajax({
        url: "/suppliers",
        type: "GET",
        success: (response) => {
            var data = response.suppliers;
            let html = "";
            $.each(data, (index, value) => {
                html += `
                    <div class="w-100 row  p-2 mb-1 justify-content-between d-flex  rounded">
                            <a class="justify-content-start col-8 ">
                                <i class="ni ni-fat-delete"></i>${value.name}</a>
                            <div class="col-4 d-flex justify-content-end">
                                <a onclick="get_suppliers_by_id(${value.id})" class="text-sm font-weight-bold mb-0 " id="btn_supplier_update"
                                    style="cursor: pointer">Sửa
                                </a>
                                | <a class="text-sm font-weight-bold mb-0 " onclick="delete_suppliers_by_id(${value.id})" id="btn_supplier_delete"
                                    style="cursor: pointer">
                                    Xóa</a>
                            </div>
                        </div>`;
            });
            $("#list_supplier_build").html(html);
        },
    });
}
function delete_suppliers_by_id(id) {
    $.ajax({
        url: "/suppliers",
        type: "DELETE",
        data: { id: id },
        success: (response) => {
            if (response.status == "success") {
                onAlertSuccess(response.message);
                GetAllSuppliers();
            } else {
                onAlertError(response.message);
            }
        },
        error: (error) => {
            onAlertError(error.responseJSON.message);
        },
    });
}
function get_suppliers_by_id(id) {
    $.ajax({
        url: "/supplier/s",
        type: "GET",
        data: { id: id },
        success: (response) => {
            if (response.status == "success") {
                $("#suppliers_id").val(response.body.id);
                $("#suppliers").val(response.body.name);
                $("#insert-suppliers-btn").html("Lưu");
            } else {
                onAlertError(response.message);
            }
        },
        error: (error) => {
            onAlertError(error.responseJSON.message);
        },
    });
}
$(document).ready(function () {
    $("#insert-suppliers-btn").on("click", (e) => {
        e.preventDefault();
        var id = $("#suppliers_id").val();
        var suppliers = $("#suppliers").val();
        $.ajax({
            url: "/suppliers",
            type: "POST",
            data: { suppliers: suppliers, id: id },
            success: (response) => {
                if (response.status == "success") {
                    onAlertSuccess(response.message);
                    $("#insert-suppliers-btn").html("Thêm");
                    GetAllSuppliers();
                } else {
                    onAlertError(response.message);
                }
            },
            error: (error) => {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});
$(document).ready(function () {
    $("#close_form_add_equipment").on("click", (e) => {
        closeform_add_equipment();
    });
});
$(document).ready(function () {
    $("#btn_add_quantity_equipment").on("click", (e) => {
        var id = $("#equipment_add_id").val();
        var quantity = $("#quantity_add_form_add").val();
        var add_date = $("#equipment_add_date").val();
        var warranty = $("#warranty_expiration_date_add").val();
        var supplier_id = $("#supplier_id_add").val();
        var specifications = $("#specifications_add_form").val();
        var note = $("#equipment_add_note").val();
        $.ajax({
            url: "/equipment/add/quantity",
            method: "POST",
            data: {
                id: id,
                quantity: quantity,
                add_date: add_date,
                warranty: warranty,
                supplier_id: supplier_id,
                specifications: specifications,
                note: note,
            },
            success: (result) => {
                if (result.status == "success") {
                    onAlertSuccess(result.message);
                    getall_equipment_detail_for_update();
                    closeform_add_equipment();
                } else {
                    onAlertError(result.message);
                }
            },
            error: (error) => {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});

$(document).ready(function () {
    $("#search_equipment").keyup(function () {
        var search = $("#search_equipment").val();
        $.ajax({
            url: "/equipment/search",
            method: "GET",
            data: {
                search: search,
            },
            success: function (result) {
                $("#table_equipment").html(result.body);
            },
        });
    });
});
function getAlldataEquipmentTypes() {
    $.ajax({
        type: "GET",
        url: "equipment_type",
        success: (response) => {
            var data = response.equipment_types;
            let html = "";
            $.each(data, (index, value) => {
                html += `
                    <div class="w-100 row  p-2 mb-1 justify-content-between d-flex  rounded">
                        <a class="justify-content-start col-8 ">
                            <i class="ni ni-fat-delete"></i>${value.name}
                        </a>
                        <div class="col-4 d-flex justify-content-end">
                            <a onclick="get_equipment_type_by_id(${value.id})" class="text-sm font-weight-bold mb-0 " id="btn_autho_update" style="cursor: pointer">Sửa</a> |
                            <a class="text-sm font-weight-bold mb-0 " onclick="deleteEquipmentByID(${value.id})" id="btn_autho_delete" style="cursor: pointer">Xóa</a>
                        </div>
                    </div>`;
            });
            $("#list_equipment_type_build").html(html);
        },
    });
    builalltypes();
}
function get_equipment_type_by_id(id) {
    $.ajax({
        url: "/equipment_type/s",
        type: "GET",
        data: {
            id: id,
        },
        success: (response) => {
            $("#insert_emquipment_types").html("Lưu");
            $("#equipment_type_code_insert").val(response.equipment_type.code);
            $("#equipment_type_insert").val(response.equipment_type.name);
            $("#equipment_type_id").val(response.equipment_type.id);
            response.equipment_type.accessory == 0
                ? $("#ischild").prop("checked", false)
                : $("#ischild").prop("checked", true);
        },
    });
}
function get_all_supplier() {
    $.ajax({
        url: "equipment_supplier",
        type: "GET",
        success: (response) => {
            var data = response.suppliers;
            let html = "";
            $.each(data, (index, value) => {
                html += `<option value="${value.id}">${value.name}</option>`;
            });
            $("#equipment_supplier").html(html);
            $("#supplier_id_add").html(html);
            $("#equipment_detail_supplier").html(html);
        },
    });
}
$(document).on("click", ".equipment-edit-btn", function () {
    var id = $(this).attr("id-equipment");
    $.ajax({
        url: "/equipment_detail/product",
        type: "GET",
        data: { id: id },
        success: (response) => {
            $("#table_update_product").html(response.build_product);
            $("#equipment_id_update").val(response.equipment.id);
            $("#equipment_name_update").val(response.equipment.name);
            $("#equipment_code_update").val(response.equipment.code);
            $("#equipment_type_update").val(response.equipment.id_type);
            $("#equipment_quantity_update").val(response.count_detail);
            $("#equipment_status_update").val(response.equipment.status);
            arr_data_equipment = [];
            sessionStorage.removeItem("arr_data_equipment");
        },
    });
});
function getall_equipment_detail_for_update() {
    var id = $("#equipment_id_update").val();
    $.ajax({
        url: "/equipment_detail/product",
        type: "GET",
        data: { id: id },
        success: (response) => {
            $("#equipment_quantity_update").val(response.count_detail);
            $("#table_update_product").html(response.build_product);
        },
    });
}

//insert equipment
$(document).ready(function () {
    $("#submit_insert_equipment").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        // console.log(formData);
        $.ajax({
            type: "POST",
            url: "/equipment",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status == "error") {
                    onAlertError(response.message);
                } else {
                    onAlertSuccess(response.message);
                }
            },
            error: function (error) {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});
//update equipment
$(document).ready(function () {
    $("#form_update_equipment_submit").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        // console.log(formData);
        $.ajax({
            type: "POST",
            url: "/equipment/update",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status == "error") {
                    onAlertError(response.message);
                } else {
                    onAlertSuccess(response.message);
                    getall_equipment_detail_for_update();
                }
            },
            error: function (error) {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});
get_all_supplier();
function get_equipment_detail_update(id) {
    $.ajax({
        type: "GET",
        url: "/equipment_detail/u",
        data: { id: id },
        success: (response) => {
            if (response.status == "success") {
                var data = response.body;
                if ((data.img == null) | (data.img == "")) {
                    data.img = "anime-chibi.webp";
                }
                $("#img_equipment_detail_show").attr(
                    "src",
                    "./img/" + data.img
                );
                $("#equipment_detail_name_update").val(data.equiment_name);
                $("#equipment_detail_id_update").val(data.id);
                $("#equipment_detail_date_added").val(data.date_added);
                $("#equipment_detail_code").val(data.equipment_code);
                $("#equipment_detail_imei_update").val(data.imei);
                $("#equipment_detail_supplier").val(data.supplier_id);
                $("#equipment_detail_specifications").val(data.specifications);
                $("#equipment_detail_status").val(data.status);
                $("#equipment_detail_warranty_expiration_date").val(
                    data.warranty_expiration_date
                );
                $("#equipment_detail_note").val(data.note);
            } else {
                onAlertError(response.message);
            }
        },
        error: (error) => {
            onAlertError(error.responseJSON.message);
        },
    });
}
//update equipment detail
$(document).ready(function () {
    $("#submit_update_equipment_detail").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/equipment_detail",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.status == "error") {
                    onAlertError(response.message);
                } else {
                    onAlertSuccess(response.message);
                    $("#table_equipment_detail").html(
                        response.equipment_detail
                    );
                    $("#img_equipment_detail").val("");
                    $("#equipment_detail_id_update").val("");
                }
            },
            error: function (error) {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});

function getEquipmentDetail(id) {
    $.ajax({
        url: "/equipment_detail",
        type: "GET",
        data: {
            id: id,
        },
        success: (response) => {
            if (response.status == "success") {
                $("#table_equipment_detail").html(
                    response.build_equipment_detail
                );
            }
        },
    });
}
function getAllEquipment() {
    $.ajax({
        url: "/equipment",
        type: "GET",
        success: (response) => {
            if (response.status == "success") {
                $("#table_equipment").html(response.body);
            }
        },
    });
}
//Fillter status
$(document).ready(function () {
    $("#equipment_types_fillter").on("change", function () {
        var fillter = $("#equipment_types_fillter").val();
        $.ajax({
            url: "/equipment/fillter",
            method: "GET",
            data: {
                equipment_type: fillter,
            },
            success: function (result) {
                $("#table_equipment").html(result.body);
            },
        });
    });
});

function getAllEquipmentTypes() {
    $.ajax({
        url: "/",
        type: "GET",
        success: (response) => {
            if (response.status == "success") {
                $("#table_equipment_detail").html(
                    response.build_equipment_detail
                );
            }
        },
    });
}
function get_equipment_allocation() {
    $.ajax({
        url: "/equipment/allocation",
        type: "GET",
        success: (response) => {
            if (response.status == "success") {
                $("#table_equipment_allocation").html(response.equipment);
                $("#table_equipment_detail_allocation").html(
                    response.equipment_detail
                );
            }
        },
    });
}
function find_personnel_in_Equipment(id) {
    $.ajax({
        url: "/personnel/detail",
        type: "GET",
        data: { id: id },
        success: (response) => {
            if (response.status == "success") {
                var value = response.data;
                var name_code = value.personnel_code + " - " + value.fullname;
                var chucvuphongban = `<i class="ni business_briefcase-24 mr-2"></i>${value.chucvu} - ${value.phongban}`;
                $("#img_user_equipment").attr("src", "./img/" + value.img_url);
                $("#user-img-allocation").attr("src", "./img/" + value.img_url);
                $("#img_user_device_recall").attr(
                    "src",
                    "./img/" + value.img_url
                );
                $("#name_and_code_personnel").html(name_code);
                $("#id_user_in_equipment").val(value.id);
                $("#nonimes_and_department").html(chucvuphongban);
                $("#user_allocation_code").val(value.personnel_code);
                $("#device_recall_user_code").val(value.personnel_code);
                $("#user_allocation_name").val(value.fullname);
                $("#device_recall_user_name").val(value.fullname);
                $("#user_allocation_chucvu").val(value.chucvu);
                $("#device_recall_user_chucvu").val(value.chucvu);
                $("#user_allocation_phongban").val(value.phongban);
                $("#device_recall_user_phongban").val(value.phongban);
            } else {
                onAlertError("Lỗi");
            }
        },
    });
}
function deleteEquipmentByID(id) {
    $.ajax({
        url: "equipment_type",
        type: "DELETE",
        data: { id: id },
        success: (response) => {
            onAlertSuccess(response.message);
            getAlldataEquipmentTypes();
        },
    });
}
$(document).ready(function () {
    $("#insert_emquipment_types").on("click", (e) => {
        e.preventDefault();
        var equipment_type_code_insert = $("#equipment_type_code_insert").val();
        var equipment_type = $("#equipment_type_insert").val();
        var equipment_type_id = $("#equipment_type_id").val();
        var isCheched = $("#ischild").is(":checked");
        $.ajax({
            url: "/equipment_type",
            type: "POST",
            data: {
                equipment_type_code_insert: equipment_type_code_insert,
                id: equipment_type_id,
                equipment_type: equipment_type,
                accessory: isCheched,
            },
            success: (response) => {
                if (response.status == "success") {
                    onAlertSuccess("Thêm thể loại thành công !");
                    getAlldataEquipmentTypes();
                    $("#equipment_type_code_insert").val("");
                    $("#insert_emquipment_types").html("Thêm");
                    $("#equipment_type_insert").val("");
                    $("#equipment_type_id").val("");
                } else {
                    onAlertError(response.message);
                }
            },
            error: (error) => {
                onAlertError(error.responseJSON.message);
            },
        });
    });
});
