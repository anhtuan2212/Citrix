<!-- Modal -->
<div class="modal fade" id="profile-handing-over" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-profile imgcover">
                        <img src="/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                        <div class="row justify-content-center">
                            <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                    <a href="javascript:;">
                                        <img id="img_user_equipment" src="/img/marie.jpg"
                                            class="rounded-circle img-fluid border border-2 border-white ob-cover">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="d-none" id="id_user_in_equipment">
                        <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                            <div class="d-flex justify-content-between">
                                <a href="" class="btn btn-sm btn-info mb-0 d-none d-lg-block"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvas_device_recall"
                                    aria-controls="offcanvas_device_recall">Thu Hồi</a>
                                <a href="" class="btn btn-sm btn-info mb-0 d-block d-lg-none"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvas_device_recall"
                                    aria-controls="offcanvas_device_recall"><i class="ni ni-collection"></i></a>
                                <a href="" onclick=" get_equipment_allocation()" id="btn_allocation_in_user1"
                                    class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvas_allocation"
                                    aria-controls="offcanvas_allocation">Cấp
                                    Phát</a>
                                <a type="button" onclick=" get_equipment_allocation()" id="btn_allocation_in_user2"
                                    class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvas_allocation"
                                    aria-controls="offcanvas_allocation"><i class="ni ni-email-83"></i></a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="text-center mt-4">
                                <h5 id="name_and_code_personnel">
                                </h5>
                                <div class="h6 mt-4" id="nonimes_and_department">
                                    Solution Manager - SCONNECT
                                </div>
                                <div class="h6 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i>Thiết bị đang sử dụng
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
