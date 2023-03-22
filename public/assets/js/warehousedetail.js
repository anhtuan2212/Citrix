import Pagination from "./Paginate.js";

var paginate = new Pagination();
var id_equipment = 0;

$(document).ready(function () {
    Get();
    Next();
    Previous();
    Redirect();
    showmodal();
    UpdateEquipment();
});

function Get() {
    let id = $('#idkho').attr('name');
    $.ajax({
        type: "get",
        url: `/warehouse/storehousedetail/${paginate.perPage}/${id}`,
        dataType: "json",
        success: function (response) {
            let html = '';
            $.each(response.data, function (index, value) {
                html += `<tr>
                            <td>${(index + 1)}</td>
                            <td><img src="${(index + 1)}"/></td>
                            <td>${value.name}</td>
                            <td>${value.out_of_date}</td>
                            <td>${value.warranty_date}</td>
                            <td>${value.amount}</td>
                            <td>${value.created_at}</td>
                            <td><button id="btnSuaThietBi" name="${value.id}" class="btn btn-primary">Sửa thiết bị</button></td>
                            <td><button id="btnXoaThietBi" name="${value.id}" class="btn btn-primary">Xóa thiết bị</button></td>
                        </tr>`;
            });
            $('#store-house-detail').html(html);
            paginate.lastPage = response.last_page;
            paginate.ViewPageLink(paginate.lastPage, paginate.currentPage, 'pageLink');
        }
    });
}

function Next() {
    $(document).on("click", "#btnNext", function () {
        paginate.Next(Get);
    });
}

function Previous() {
    $(document).on("click", "#btnPrevious", function () {
        paginate.Previous(Get);
    });
}

function Redirect() {
    $(document).on("click", "#btnRedirect", function (e) {
        let index = e.target.innerHTML;
        paginate.Redirect(index, Get);
    });
}

function showmodal() {
    $(document).on('click', '#btnSuaThietBi', function () {

        let id = $(this).attr('name');
        $.ajax({
            type: "get",
            url: "/warehouse/getequimentbyid/" + id,
            dataType: "json",
            success: function (response) {
                $('#exampleModalNhaKho').modal('show');
                $('#divsoluong').css('display', 'none');
                $('#divkho').css('display', 'none');
                $('input[name="name"]').val(response.name);
                $('#specifications').val(response.specifications);
                $('input[name="price"]').val(response.price);
                $('input[name="out_of_date"]').val(response.out_of_date);
                $('input[name="warranty_date"]').val(response.warranty_date);
                $(`#equiment_type_id option[value=${response.equipment_type_id}]`).attr('selected', 'selected');
                $(`#supplier_id option[value=${response.supplier_id}]`).attr('selected', 'selected');
                id_equipment = response.id;
            }
        });
    })
}

function UpdateEquipment() {
    $('#form-equiment').on('submit', function (e) {
        e.preventDefault();
        let data = new FormData(this);
        $.ajax({
            type: "post",
            url: "/warehouse/updateequipment/" + id_equipment,
            data: data,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                $('#exampleModalNhaKho').modal('hide');
                $('#divsoluong').css('display', 'block');
                $('#divkho').css('display', 'block');
                $('input[name="name"]').val("");
                $('#specifications').val("");
                $('input[name="price"]').val("");
                $('input[name="out_of_date"]').val("");
                $('input[name="warranty_date"]').val("");
                id_equipment = 0;
                Swal.fire("Thông báo", "Sửa thiết bị thành công", "success");
                Get();
            }
        });
    });
}

