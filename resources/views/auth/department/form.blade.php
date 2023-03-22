@extends('auth.department.index')

@section('department')
    <div class="col-12">
        <div class="card mb-4">
            <form id="form">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0">Thêm Phòng Ban</p>
                        <button class="btn btn-primary btn-sm ms-auto save me-2">
                            Lưu thông tin
                        </button>
                        <button class='btn btn-primary btn-sm clear'>Hủy</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="example-text-input" class="form-control-label">Mã phòng ban</label>
                                    <label for="example-text-input" class="form-control-label text-danger code-error"></label>
                                </div>
                                <input class="form-control" type="text" name="code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="example-text-input" class="form-control-label">Tên phòng ban</label>
                                    <label for="example-text-input" class="form-control-label text-danger name-error"></label>
                                </div>
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="example-text-input" class="form-control-label">Phòng ban cha</label>
                                    <label for="example-text-input"
                                        class="form-control-label text-danger id_department_parent_error"></label>
                                </div>
                                <div style="position: relative">
                                    <input class="form-control" type="text" id="department_search"
                                        name="department_name">
                                    <span id="search_close" style="color: red; cursor: pointer; position: absolute; right: 10px; bottom: 15%">
                                        <i class="fas fa-times"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" hidden name="id_department_parent">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Trạng thái hoạt động</label>
                                <div class="form-check form-switch mt-1">
                                    <input class="form-check-input" type="checkbox" name="status" id="flexSwitchCheckDefault" checked="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
