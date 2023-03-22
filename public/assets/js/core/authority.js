var arr_data_user = [];
sessionStorage.removeItem("arr_data_user");
var id_autho = $("#gender_ut_update").val();
$(document).on("change", ".set_role_user", function () {
    var isChecked = $(this).is(":checked");
    var id_user = $(this).attr("data-user");
    if (isChecked) {
        arr_data_user.push(id_user);
    } else {
        arr_data_user.splice(arr_data_user.indexOf(id_user), 1);
    }
    sessionStorage.setItem("arr_data_user", arr_data_user);
});

$(document).ready(() => {
    $("#gender_ut_update").on("change", () => {
        var id = $("#gender_ut_update").val();
        id_autho = id;
    });
});
function getAll_Autho_set() {
    $.ajax({
        type: "GET",
        url: "/authorization/all",
        success: function (result) {
            let html = "";
            $.each(result.body, (index, value) => {
                html += `<option value="${value.id}">${value.name_autho}</option>`;
            });
            $("#gender_ut_update").html(html);
        },
    });
}
$(document).on("click", "#recall_autho", function () {
    if (arr_data_user.length == 0) {
        onAlertError("Vui lòng chọn nhân sự !");
        return;
    }
    $.ajax({
        url: "/authorization/recall",
        type: "POST",
        data: {
            id_autho: id_autho,
            arr_user: arr_data_user,
        },
        success: (response) => {
            if (response.status == "success") {
                onAlertSuccess(response.message);
                get_all_autho();
                arr_data_user = [];
                sessionStorage.removeItem("arr_data_user");
                $("#checked_all").prop("checked", false);
            } else {
                onAlertError("Lỗi serve !");
            }
        },
        error: (error) => {
            // onAlertError(error.responseJSON.message);
        },
    });
});
$(document).on("click", "#add_autho_modal", function () {
    if (arr_data_user.length == 0) {
        onAlertError("Vui lòng chọn nhân sự !");
        return;
    }
    $.ajax({
        url: "/authorization/add",
        type: "POST",
        data: {
            id_autho: id_autho,
            arr_user: arr_data_user,
        },
        success: (response) => {
            if (response.status == "success") {
                onAlertSuccess(response.message);
                get_all_autho();
                arr_data_user = [];
                sessionStorage.removeItem("arr_data_user");
                $("#checked_all").prop("checked", false);
            } else {
                onAlertError("Lỗi serve !");
            }
        },
        error: (error) => {
            // onAlertError(error.responseJSON.message);
        },
    });
});

//Search User
$(document).ready(function () {
    $("#search_autho").keyup(function () {
        var count = $("#count_result_autho").val();
        var search = $("#search_autho").val();
        $.ajax({
            url: "/authorization/search",
            method: "GET",
            data: {
                count: count,
                search: search,
            },
            success: function (result) {
                $("#table_user_autho").html(result.table_user);
                $("#count_result_autho").val(result.count);
            },
        });
    });
});

$(document).on("change", "#department_auth", function () {
    var id = $(this).val();
    getUserByDepartment(id);
});
$(document).on("change", "#checked_all", function () {
    var checked = $("#checked_all").is(":checked");
    var num = $("#count_result_autho").val();
    if (checked) {
        for (let index = 1; index <= num; index++) {
            var isChecked = $("#table_user_col_" + index).is(":checked");
            if (isChecked == false) {
                $("#table_user_col_" + index).prop("checked", true);
                var id_user = $("#table_user_col_" + index).attr("data-user");
                arr_data_user.push(id_user);
                sessionStorage.setItem("arr_data_user", arr_data_user);
            }
        }
    } else {
        for (let index = 1; index <= num; index++) {
            $("#table_user_col_" + index).prop("checked", false);
            var isChecked = $("#table_user_col_" + index).is(":checked");
            var id_user = $("#table_user_col_" + index).attr("data-user");
            arr_data_user.splice(arr_data_user.indexOf(id_user), 1);
            sessionStorage.setItem("arr_data_user", arr_data_user);
        }
    }
});
$(document).on("change", "#count_result_autho", function () {
    var count = $("#count_result_autho").val();
    var search_autho = $("#search_autho").val();
    var department_auth = $("#department_auth").val();
    $.ajax({
        url: "/authorization",
        type: "POST",
        data: {
            count: count,
            search_autho: search_autho,
            department_auth: department_auth,
        },
        success: (response) => {
            $("#table_user_autho").html(response.table_user);
            $("#count_result_autho").val(response.page_size);
        },
        error: () => {},
    });
});

$(document).ready(() => {
    $("#btn_save_autho").on("click", (e) => {
        e.preventDefault();
        var name = $("#autho_name").val();
        var id = $("#id_autho").val();
        var personnel = $("#personnel_autho_access").is(":checked");
        var insert_personnel = $("#insert_personnel").is(":checked");
        var update_personnel = $("#update_personnel").is(":checked");
        var delete_personnel = $("#delete_personnel").is(":checked");
        var accept_cv_autho = $("#accept_cv_autho").is(":checked");
        var update_cv_autho = $("#update_cv_autho").is(":checked");
        var inter_cv_autho = $("#inter_cv_autho").is(":checked");
        var eva_cv_autho = $("#eva_cv_autho").is(":checked");
        var offer_cv_autho = $("#offer_cv_autho").is(":checked");
        var authority_role = $("#authority_role").is(":checked");
        var faild_cv_autho = $("#faild_cv_autho").is(":checked");
        $.ajax({
            type: "POST",
            url: "/authorization/insert",
            data: {
                id: id,
                autho_name: name,
                personnel_autho_access: personnel,
                insert_personnel: insert_personnel,
                update_personnel: update_personnel,
                delete_personnel: delete_personnel,
                accept_cv_autho: accept_cv_autho,
                update_cv_autho: update_cv_autho,
                inter_cv_autho: inter_cv_autho,
                eva_cv_autho: eva_cv_autho,
                offer_cv_autho: offer_cv_autho,
                authority: authority_role,
                faild_cv_autho: faild_cv_autho,
            },
            success: (result) => {
                if (result.status == "success") {
                    onAlertSuccess("Thay đổi đã được áp dụng !");
                    $("#btn_save_autho").html("Thêm Mới");
                    reset_id();
                    form_clear();
                    get_all_autho();
                    getAll_Autho_set();
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

function get_all_autho() {
    $.ajax({
        type: "GET",
        url: "/authorization",
        success: (result) => {
            if (result.status == "success") {
                let html = "";
                $.each(result.body.data, (index, value) => {
                    html += `<div class="w-100 row  p-2 mb-1 justify-content-between d-flex  rounded">
                                    <a class="justify-content-start col-8 ">
                                        <i class="ni ni-fat-delete"></i>${value.name_autho}</a>
                                    <div class="col-4 d-flex justify-content-end">
                                                <a onclick="get_autho_By_Id(${value.id});"
                                                    class="text-sm font-weight-bold mb-0 " id="btn_autho_update"
                                                    style="cursor: pointer">Sửa
                                                </a>
                                                | <a class="text-sm font-weight-bold mb-0 " onclick="delete_autho_By_Id(${value.id});"
                                                 id="btn_autho_delete"
                                                    style="cursor: pointer">
                                                    Xóa</a>
                                    </div>
                                </div>
                                `;
                });
                $("#list_autho_build").html(html);
                $("#table_user_autho").html(result.table_user);
            } else {
                onAlertError(result.message);
            }
        },
        error: (error) => {
            onAlertError(error.responseJSON.message);
        },
    });
}
function getUserByDepartment(id) {
    $.ajax({
        url: "/authorization/user",
        type: "GET",
        data: { id: id },
        success: (response) => {
            $("#table_user_autho").html(response.table_user);
        },
    });
}
function get_autho_By_Id(id) {
    $("#btn_save_autho").html("Lưu");
    $.ajax({
        url: "/authorization/id",
        method: "GET",
        data: {
            id: id,
        },
        success: (response) => {
            if (response.status == "success") {
                var data = response.body;
                var quyen = data.personnel;
                $("#autho_name").val(data.name_autho);
                $("#id_autho").val(data.id);
                quyen.personnel_autho_access == "true"
                    ? $("#personnel_autho_access").prop("checked", true)
                    : $("#personnel_autho_access").prop("checked", false);
                quyen.insert_personnel == "true"
                    ? $("#insert_personnel").prop("checked", true)
                    : $("#insert_personnel").prop("checked", false);
                quyen.update_personnel == "true"
                    ? $("#update_personnel").prop("checked", true)
                    : $("#update_personnel").prop("checked", false);
                quyen.delete_personnel == "true"
                    ? $("#delete_personnel").prop("checked", true)
                    : $("#delete_personnel").prop("checked", false);
                quyen.accept_cv_autho == "true"
                    ? $("#accept_cv_autho").prop("checked", true)
                    : $("#accept_cv_autho").prop("checked", false);
                quyen.update_cv_autho == "true"
                    ? $("#update_cv_autho").prop("checked", true)
                    : $("#update_cv_autho").prop("checked", false);
                quyen.inter_cv_autho == "true"
                    ? $("#inter_cv_autho").prop("checked", true)
                    : $("#inter_cv_autho").prop("checked", false);
                quyen.offer_cv_autho == "true"
                    ? $("#offer_cv_autho").prop("checked", true)
                    : $("#offer_cv_autho").prop("checked", false);
                quyen.eva_cv_autho == "true"
                    ? $("#eva_cv_autho").prop("checked", true)
                    : $("#eva_cv_autho").prop("checked", false);
                quyen.faild_cv_autho == "true"
                    ? $("#faild_cv_autho").prop("checked", true)
                    : $("#faild_cv_autho").prop("checked", false);
                data.authority == "true"
                    ? $("#authority_role").prop("checked", true)
                    : $("#authority_role").prop("checked", false);
            } else {
                onAlertError("Lỗi server !");
            }
        },
        error: () => {
            onAlertError("Lỗi trong quá trình tìm kiếm nhóm quyền !");
        },
    });
}

function delete_autho_By_Id(id) {
    $.ajax({
        url: "/authorization",
        method: "DELETE",
        data: {
            id: id,
        },
        success: (response) => {
            if (response.status == "success") {
                onAlertSuccess("Xóa Thành Công !");
                reset_id();
                $("#btn_save_autho").html("Thêm Mới");
                get_all_autho();
            } else {
                onAlertError(response.message);
            }
        },
        error: () => {
            onAlertError("Lỗi trong quá trình tìm kiếm nhóm quyền !");
        },
    });
}
function reset_id() {
    $("#id_autho").val("");
}
function form_clear() {
    $("#autho_name").val("");
    $("#id_autho").val("");
    $("#personnel_autho_access").prop("checked", false);
    $("#insert_personnel").prop("checked", false);
    $("#update_personnel").prop("checked", false);
    $("#delete_personnel").prop("checked", false);
    $("#accept_cv_autho").prop("checked", false);
    $("#update_cv_autho").prop("checked", false);
    $("#inter_cv_autho").prop("checked", true);
    $("#inter_cv_autho").prop("checked", false);
    $("#offer_cv_autho").prop("checked", false);
    $("#eva_cv_autho").prop("checked", false);
    $("#authority_role").prop("checked", false);
    $("#faild_cv_autho").prop("checked", false);
}
function checked_paginate_user(count) {
    var ar = sessionStorage.getItem("arr_data_user");
    if (ar == null) {
        return;
    }
    var arr = ar.split(",");
    for (let index = 1; index <= count; index++) {
        var id_user = $("#table_user_col_" + index).attr("data-user");
        var x = arr.indexOf(id_user);
        if (x !== -1) {
            $("#table_user_col_" + index).prop("checked", true);
        }
    }
    // $("#body_table_user_in_autho");
}
