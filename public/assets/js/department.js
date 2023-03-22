$(document).ready(function() {
    var name_error = $(".name-error")
    var code_error = $(".code-error")
    var id_department_parent_error = $(".id_department_parent_error")

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    clear();

    // Tự động tìm phòng ban gần đúng
    $("#department_search").on('focus', function() {
        $('#search_close').show();
    }).focusout(function() {
        setTimeout(() => {
            $('#search_close').hide();
        }, 1000);
    }).autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: "{{ route('department.search') }}",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            // Set selection
            $('#department_search').val(ui.item.label); // display the selected text
            $("input[name='id_department_parent']").val(ui.item.value);
            return false;
        }
    });

    // Hủy chỉnh sửa
    $('.clear').on('click', function(e) {
        e.preventDefault();
        clear();
    })

    // Thêm hoặc sửa phòng ban
    $('.save').on('click', function(e) {
        e.preventDefault()
        var form = $('#form').serialize();

        $.ajax({
            url: "{{ route('department.create_or_update') }}",
            type: 'POST',
            data: form,
            success: function(response) {
                if (response.status == 0) {
                    if (response.msg.name) {
                        name_error.html(response.msg.name)
                    } else {
                        name_error.empty();
                    }

                    if (response.msg.code) {
                        code_error.html(response.msg.code)
                    } else {
                        code_error.empty();
                    }

                    if (response.msg.id_department_parent) {
                        id_department_parent_error.html(response.msg
                            .id_department_parent)
                    } else {
                        id_department_parent_error.empty();
                    }

                    showAlert('error', typeof response.msg == 'object' ? 'Thao Tác Thất Bại' : response.msg)
                } else {
                    showAlert('success', response.msg);
                    clear();
                }
            }
        });
    })

    // Hiển thị phòng ban lên form
    $(document).on('click', '.edit', function() {
        var id = $(this).data('id');
        $.get("{{ route('department.display') }}" + '/' + id).done(function(data) {
            $("input[name='code']").val(data.code);
            $("input[name='name']").val(data.name);
            if (data.status != true) {
                $("input[name='status']").removeAttr("checked");
            } else {
                $("input[name='status']").attr("checked", '');
            }
            $.get("{{ route('department.display') }}" + '/' + data.parent_id)
                .done(function(data) {
                    $("input[name='department_name']").val(data.name);
                    $("input[name='id_department_parent']").val(data.id);
                    $('#form').append(
                        `<input for="example-text-input" class="form-control-label" hidden name="id" value="${id}"></input>`
                    )
                    $(".clear").show()
                    clearError();
                })
        })
    })

    // Xóa phòng ban
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).attr('action');
        showAlert('info', 'Bạn có chắc muốn xóa không', function() {
            $.ajax({
                url: url,
                data: {
                    "id": id
                },
                type: 'DELETE',
                success: function(response) {
                    if (response.status == 0) {
                        showAlert('error', response.msg)
                    } else {
                        showAlert('success', response.msg)
                    }
                }
            });
            clear();
        })
    })

    // đóng tìm kiếm
    $('#search_close').on('click', function() {
        $('#department_search').val('');
        $("input[name='id_department_parent']").val('');
        $('#search_close').hide();
    })

    // lọc
    $('#filter').on('change', function() {
        filter();
    })

    // phân trang
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        if ($(this).attr('href')) {
            $.get($(this).attr('href'), function(data) {
                $('#departments').empty().html(data);
            })
        }
    })

    $.get("{{ route('department.get_users') }}" + '/' + $("input[name='department_id' ]").val(), function(
        data) {
        $('#table_users').empty().html(data);
    })

    $("#user_search").autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: "{{ route('department.searchUsers') }}",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            Swal.fire({
                title: 'Bạn Có Chắc Muốn Thêm',
                showDenyButton: true,
                icon: 'info',
                confirmButtonText: 'Đồng ý',
                denyButtonText: "Hủy",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('department.addUser') }}",
                        type: 'POST',
                        data: {
                            'id': ui.item.value,
                            'department_id': $("input[name='department_id' ]")
                                .val()
                        },
                        success: function(response) {
                            $.get("{{ route('department.get_users') }}" +
                                '/' + $(
                                    "input[name='department_id' ]")
                                .val(),
                                function(
                                    data) {
                                    $('#table_users').empty().html(
                                        data);
                                })
                        }
                    });
                }
            })
            return false;
        }
    });

    $.get("{{ route('department.get_users') }}" + '/' + $("input[name='department_id' ]").val(), function(
        data) {
        $('#table_users').empty().html(data);
    })

    $(document).on('click', '.delete_user', function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Bạn Có Chắc Muốn Xóa",
            showDenyButton: true,
            icon: "info",
            confirmButtonText: 'Đồng ý',
            denyButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('department.deleteUser') }}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        'id': $(this).attr('data-id')
                    },
                    success: function(data) {
                        $.get("{{ route('department.get_users') }}" + '/' + $(
                                "input[name='department_id' ]").val(),
                            function(data) {
                                $('#table_users').empty().html(data);
                            })
                    }
                });
            }
        })
    })

    $(document).on('change', 'select[name="position_id"]', function() {
        var options = $(this).closest('tr');
        var position_id = options.find('select[name="position_id"]').find(":selected").val();
        var select = options.find('select[name="nominee_id"]');
        var indexs = 0;
        $(select.find('option')).each(function(index) {
            var id = options.find('.update_user').attr('data-id')
            if ($(this).attr('data-id') == position_id) {
                indexs = index;
                $(this).removeAttr('hidden');
            } else {
                $(this).attr('hidden', '')
            }
        })
        select.prop("selectedIndex", indexs)
    });

    $(document).on('click', '.update_user', function(e) {
        e.preventDefault();
        var parent = $(this).closest('tr');
        $.ajax({
            url: "{{ route('department.updateUser') }}",
            type: 'post',
            dataType: "json",
            data: {
                'id': $(this).attr('data-id'),
                'nominee_id': parent.find('select[name="nominee_id"]').find(":selected")
                    .val(),
                'position_id': parent.find('select[name="position_id"]').find(":selected")
                    .val(),
                'level': parent.find('input[name="level"]').val()
            },
            success: function(data) {
                if (data.status == 0) {
                    showAlert("error", data.msg)
                } else {
                    $.get("{{ route('department.get_users') }}" + '/' + $(
                        "input[name='department_id' ]").val(), function(data) {
                        $('#table_users').empty().html(data);
                    })
                    showAlert("success", data.msg)
                }
            }
        });
    })  
})

function clear() {
    var test = <?= echo 123 ?>
    $.get(, function(data) {
        $('#departments').empty().html(data);
    })
    $('#not_found').hide();
    $("input[name='code' ]").val('');
    $("input[name='name' ]").val('');
    $("input[name='department_name' ]").val('');
    $("input[name='id_department_parent' ]").val('');
    $("input[name='status' ]").attr("checked", '');
    $(".clear").hide()
    $(".code-error").empty();
    $(".name-error").empty();
    $(".id_department_parent_error").empty();
    $("#search_close").hide()
    $("input[name='id']").remove();
}

function filter() {
    var status = $('select#status').val();
    var per_page = $('select#per_page').val();
    var name = $('#name').val();
    var datetime = $('#datetime').val();
    $.ajax({
        url: "{{ route('department.filter') }}",
        type: 'GET',
        data: {
            'status': status,
            'per_page': per_page,
            'name': name,
            'datetime': datetime
        },
        success: function(response) {
            $('#departments').empty().html(response);
        }
    });
}

function clearError() {
    $(".code-error").empty();
    $(".name-error").empty();
    $(".id_department_parent_error").empty();
}

function showAlert(status, msg, eventHandler) {
    if (eventHandler) {
        Swal.fire({
            title: msg,
            showDenyButton: true,
            icon: status,
            confirmButtonText: 'Đồng ý',
            denyButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                eventHandler()
            }
        })
    } else {
        Swal.fire({
            icon: status,
            title: msg
        })
    }
}