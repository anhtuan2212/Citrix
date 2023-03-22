<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_equipment',
        'equipment_code',
        'imei',
        'warranty_expiration_date',
        'img',
        'status',
        'specifications',
        'date_added',
        'supplier_id',
        'note',
    ];
    public static function get_equipment_detail_by_equipment($equiments)
    {
        $equiments_detail = EquipmentDetail::where('id_equipment', $equiments)
            ->leftjoin('suppliers', 'equipment_details.supplier_id', 'suppliers.id')
            ->select('equipment_details.*', 'suppliers.name as supplier')
            ->paginate(config('const.EQUIPMENT.PAGE_SIZE_EQUIPMENT_DETAIL'));
        // dd($equiments_detail);
        return $equiments_detail;
    }
    public static function get_equipment_detail_by_equipment_and_st($equiments, $st)
    {
        $equiments_detail = EquipmentDetail::where('id_equipment', $equiments)->where('status', $st)
            ->leftjoin('suppliers', 'equipment_details.supplier_id', 'suppliers.id')
            ->select('equipment_details.*', 'suppliers.name as supplier')
            ->paginate(config('const.EQUIPMENT.PAGE_SIZE_EQUIPMENT_ALLOCATION'));
        return $equiments_detail;
    }
    public static function get_equipment_detail_by_equipment_no_paginate($equiments)
    {
        $equiments_detail = EquipmentDetail::where('id_equipment', $equiments)
            ->leftjoin('suppliers', 'equipment_details.supplier_id', 'suppliers.id')
            ->select('equipment_details.*', 'suppliers.name as supplier')->get();
        return $equiments_detail;
    }
    public static function get_equipment_detail_by_id($equiments)
    {
        $equiments_detail = EquipmentDetail::leftjoin('equipment', 'equipment_details.id_equipment', 'equipment.id')
            ->select('equipment_details.*', 'equipment.name as equiment_name')->find($equiments);
        return $equiments_detail;
    }
    public static function get_all_equipment_detail_by_equipment_no_paginate($equiments)
    {
        $equiments_detail = EquipmentDetail::where('id_equipment', $equiments)
            ->leftjoin('suppliers', 'equipment_details.supplier_id', 'suppliers.id')
            ->select('equipment_details.*', 'suppliers.name as supplier')
            ->get();
        return $equiments_detail;
    }
    public static function build_update_product($equipment_details)
    {
        $html = '
       <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã sản phẩm</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">imei</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng Thái</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày Nhập</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hạn Bảo Hành</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nhà cung cấp</th>
                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Chọn</th>
                    </tr>
                </thead>
                <tbody>';
        $i = 0;
        foreach ($equipment_details as $item) {
            $i = $i + 1;
            if (count($equipment_details) == 0) {
                $html .= '<tr class="">
                        <td colspan="5" class="table-active text-center "><p class="text-sm font-weight-bold  mb-0">Không Có Sản Phẩm</p></td>
                      </tr>';
            }
            if (empty($item->img)) {
                $item->img = 'thumbnail.png';
            }
            if (empty($item->imei)) {
                $item->imei = 'chưa có imei';
            }
            $html .= '
                    <tr>
                        <td>
                            <div class="d-flex px-2">
                                <div>
                                    <img src="./img/' . $item->img . '"
                                        class="avatar avatar-sm rounded-circle me-2">
                                </div>
                                <div class="my-auto">
                                    <h6 class="mb-0 text-xs">' . $item->equipment_code . '</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">' . $item->imei . '</p>
                        </td>
                        <td>';
            if ($item->status == 0) {
                $html .= ' <span class="badge badge-sm bg-gradient-secondary">Chưa sử dụng</span>';
            } else if ($item->status == 1) {
                $html .= ' <span class="badge badge-sm bg-gradient-success">Đang sử dụng</span>';
            } else if ($item->status == 2) {
                $html .= ' <span class="badge badge-sm bg-gradient-warning">Đang bảo trì</span>';
            } else if ($item->status == 3) {
                $html .= ' <span class="badge badge-sm bg-gradient-warning">Đang bảo hành</span>';
            } else if ($item->status == 4) {
                $html .= ' <span class="badge badge-sm bg-gradient-light">Đang sửa chữa</span>';
            } else if ($item->status == 5) {
                $html .= ' <span class="badge badge-sm bg-gradient-danger">Đang đổi trả</span>';
            }
            $html .= '</td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">' . $item->date_added . '</p>
                        </td>
                        <td class="align-middle">
                             <p class="text-xs font-weight-bold mb-0">' . $item->warranty_expiration_date . '</p>
                        </td>
                        <td>
                             <p class="text-xs font-weight-bold mb-0">' . $item->supplier . '</p>
                        </td>
                        <td class="text-center"> 
                        <input type="checkbox" id="data-equipment-row-' . $i . '" name="checked_delete" data-equipment="' . $item->id . '" class="checked_delete_in_update">
                        </td>
                    </tr>';
        }
        $html .= '
                </tbody>
              </table>
              ' . $equipment_details->links() . '
          </div>';

        return $html;
    }
    public static function build_equipment_detail($equipment_details, $equipment)
    {
        $html = '
        <div class="text-center" id="wraper_equipment_name" code="' . $equipment->id . '">
        <h5>' . $equipment->name . '</h5>
        </div>
        <div class="table-responsive p-0"
            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Mã Sản Phẩm</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hạn Bảo Hành</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nhà Cung Cấp</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng Thái</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>';
        if (count($equipment_details) == 0) {
            $html .= '<tr class="">
                        <td colspan="5" class="table-active text-center "><p class="text-sm font-weight-bold  mb-0">Không Có Sản Phẩm</p></td>
                      </tr>';
        }
        foreach ($equipment_details as $eq_detail) {
            if (empty($eq_detail->img)) {
                $eq_detail->img = 'thumbnail.png';
            }
            $html .=
                '
             <tr>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div>
                            <img src="./img/' . $eq_detail->img . '" class="avatar me-3" alt="Avatar">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $eq_detail->equipment_code . '</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-sm font-weight-bold  mb-0" >' . $eq_detail->warranty_expiration_date . '</p>
                </td>
                <td class="d-flex justify-content-center">
                    <p class="text-sm font-weight-bold  mb-0" >' . $eq_detail->supplier . '</p>
                </td>
                <td class="align-middle text-center text-sm">';
            if ($eq_detail->status == 0) {
                $html .= '<span class="badge badge-sm bg-gradient-success">Chưa sử dụng</span>';
            } else {
                $html .= '<span class="badge badge-sm bg-gradient-danger">Chưa cài trạng thái</span>';
            }
            $html .= '</td>
                <td class="d-flex justify-content-center mt-3">
                    <a href="" class="text-sm font-weight-bold " onclick="get_equipment_detail_update(' . $eq_detail->id . ')" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_update_equipment_detail"  aria-controls="offcanvas_update_equipment_detail">Sửa</a>
                </td>
            </tr>';
        }
        $html .= '  </tbody>
             </table>
             ' . $equipment_details->links() . '
        </div>';
        return $html;
    }
    public static function build_equipment_detail_allocation($equiments_detail)
    {
        $i = 0;
        $html = '
        <div class="table-responsive">
            <table class="table table-hover	" >
                <colgroup>
                    <col width="150" span="1">
                </colgroup>
                <caption></caption>
                <thead class="table-light">
                    <tr>
                        <th class="align-items-center">Mã Sản Phẩm</th>
                        <th class="text-center">Nhà Cung Cấp</th>
                        <th class="text-center">Chọn</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($equiments_detail as $item) {
            $i++;
            $html .= ' <tr>
                        <td class="text-center">' . $item->equipment_code . '</td>
                        <td class="text-center">' . $item->supplier . '</td>
                        <td class="text-center"><input type="checkbox" id="row-data-equipment-detail-' . $i . '" class="checked_select_equipment_detail" data-equipment-detail="' . $item->id . '" name="" id=""></td>
                    </tr>';
        }
        $html .= '</tbody>
                <tfoot>
                    <h4 id="title-allocation-equipment" class="text-center" data-quipment="' . $item->id_equipment . '">Các Sản Phẩm Của Thiết Bị</h4>
                </tfoot>
            </table>
            ' . $equiments_detail->links() . '
        </div>';
        return $html;
    }
}
