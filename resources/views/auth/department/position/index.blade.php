@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div>
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Thêm Chức Danh</p>
                                <div>
                                    <button id="save" class="btn btn-primary btn-sm ms-auto save me-2">
                                        Thêm Chức Vụ
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" id="position_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" id="add-nominee">
                                        <div class="mt-2 d-flex flex-wrap" id="container_nominees">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <table class="table align-center align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Chức Vụ</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                        style="width: 35%">
                                                        Chức Danh</th>
                                                </tr>
                                            </thead>
                                            <tbody id="positions">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('position_handler')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.get("{{ URL::to('get_position') }}", function(data) {
                $('#positions').empty().html(data);
            })

            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                if ($(this).attr('href')) {
                    $.get($(this).attr('href'), function(data) {
                        $('#positions').empty().html(data);
                    })
                }
            })

            $(document).on('click', '#delete_nominee', function(e) {
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
                            url: "{{ route('department.delete_nominee') }}",
                            type: 'post',
                            dataType: "json",
                            data: {
                                'id': $(this).attr('data-id')
                            },
                            success: function(data) {
                                $.get("{{ URL::to('get_position') }}", function(data) {
                                    $('#positions').empty().html(data);
                                })
                                Swal.fire(
                                    'Thông Báo',
                                    'Xóa Thành Công',
                                    'success'
                                )
                            }
                        });
                    }
                })
            })

            $(document).on('dblclick', '#nominee_name_edit', function() {
                $(this).removeAttr('disabled');
                $(this).removeClass('no-border');
                $(this).focus();
                $(this).focusout(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Bạn Có Chắc Muốn Sửa",
                        showDenyButton: true,
                        icon: "info",
                        confirmButtonText: 'Đồng ý',
                        denyButtonText: "Hủy",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('department.update_nominee') }}",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    'id': $(this).attr('data-id'),
                                    'name': $(this).val()
                                },
                                success: function(data) {
                                    $.get("{{ URL::to('get_position') }}",
                                        function(data) {
                                            $('#positions').empty().html(
                                                data);
                                        })
                                    Swal.fire({
                                        title: data.msg,
                                        icon: "success",
                                    })
                                }
                            });
                        }
                    })
                    $(this).attr('disabled', '');
                    $(this).addClass('no-border');
                })
            })

            $(document).on('keypress', '#add-nominee', function(e) {
                if (e.which == 13) {
                    $('#container_nominees').append(
                        `<span class="badge bg-gradient-primary me-2 mb-2" id="nominee_child">${$(this).val()}</span>`
                    )
                }
            })

            $(document).on('click', '#nominee_child', function() {
                $(this).remove();
            })

            $(document).on('click', '#save', function() {
                const nominees = document.querySelectorAll('#nominee_child');
                var nominees_container = [];
                for (var obj of nominees) {
                    nominees_container.push(obj.innerHTML);
                }
                let unique = [...new Set(nominees_container)];
                $.ajax({
                    url: "{{ route('department.add_position') }}",
                    type: 'post',
                    data: {
                        'nominees': unique.join(','),
                        'position_name': $('#position_name').val()
                    },
                    success: function(data) {
                        $.get("{{ URL::to('get_position') }}", function(data) {
                            $('#positions').empty().html(data);
                        })
                        $("#container_nominees").empty();
                        Swal.fire(
                            'Thông Báo',
                            'Thêm Thành Công',
                            'success'
                        )
                    }
                });
            })

            $(document).on('keypress', '#add-nominee-2', function(e) {
                if (e.which == 13) {
                    $.ajax({
                        url: "{{ route('department.add_nominee') }}",
                        type: 'post',
                        data: {
                            'id': $(this).attr("data-id"),
                            'nominee': $(this).val()
                        },
                        success: function(data) {
                            $.get("{{ URL::to('get_position') }}", function(data) {
                                $('#positions').empty().html(data);
                            })
                            Swal.fire(
                                'Thông Báo',
                                'Thêm Thành Công',
                                'success'
                            )
                        }
                    });
                }
            })
        })
    </script>
@endpush
