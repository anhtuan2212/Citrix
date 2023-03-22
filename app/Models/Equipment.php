<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'id_type',
        'status',
    ];
    public static function getAll_Equipment_AND_TYPE()
    {
        $eq = Equipment::leftjoin('equipment_types', 'equipment.id_type', 'equipment_types.id')
            ->select('equipment.*', 'equipment_types.name as equipment_type')->paginate(config('const.EQUIPMENT.PAGE_SIZE_EQUIPMENT'));
        // dd($eq);
        return $eq;
    }
    public static function fillter($fillter)
    {
        $eq = Equipment::where('id_type', '=', "$fillter")->leftjoin('equipment_types', 'equipment.id_type', 'equipment_types.id')
            ->select('equipment.*', 'equipment_types.name as equipment_type');
        return $eq->paginate(config('const.EQUIPMENT.PAGE_SIZE_EQUIPMENT'));
    }
    public static function get_Equipment_AND_TYPE_by_id($id)
    {
        $eq = Equipment::leftjoin('equipment_types', 'equipment.id_type', 'equipment_types.id')
            ->select('equipment.*', 'equipment_types.name as equipment_type')
            ->find($id);
        return $eq;
    }
    public static function get_all_equipment_staus_0()
    {
        $eq = Equipment::where('status', 0)->paginate(config('const.EQUIPMENT.PAGE_SIZE_EQUIPMENT_ALLOCATION'));
        return $eq;
    }
    public static function search_equipment($search)
    {
        $eq = Equipment::where('equipment.code', 'like', "%$search%")
            ->orWhere('equipment.name', 'like', "%$search%")
            ->leftjoin('equipment_types', 'equipment.id_type', 'equipment_types.id')
            ->select('equipment.*', 'equipment_types.name as equipment_type')->paginate(config('const.EQUIPMENT.PAGE_SIZE_EQUIPMENT'));
        return $eq;
    }
    public static function find_equipment_and_types($search)
    {
        $eq = Equipment::leftjoin('equipment_types', 'equipment.id_type', 'equipment_types.id')
            ->select('equipment.*', 'equipment_types.code as equipment_type_code')
            ->find($search);
        return $eq;
    }
    public static function find_equipment_and_types_by_code($search)
    {
        $eq = Equipment::where('equipment.code', $search)
            ->leftjoin('equipment_types', 'equipment.id_type', 'equipment_types.id')
            ->select('equipment.*', 'equipment_types.code as equipment_type_code')->get();
        return $eq;
    }

    public static function biuld_equipment($equiments)
    {
        $i = 0;
        $html = '
        <div class="table-responsive p-0 h-100"
             style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
             <table class="table  table-hover align-items-center mb-0">
                 <thead>
                     <tr>
                         <th
                             class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                             Mã Thiết Bị</th>
                         <th
                             class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                             Thiết Bị</th>
                         <th
                             class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                             Thể Loại</th>
                         <th
                             class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                             Thao Tác</th>
                     </tr>
                 </thead>
                 <tbody>';
        if (count($equiments) == 0) {
            $html .= '<tr class="">
                        <td colspan="5" class="table-active text-center "><p class="text-sm font-weight-bold  mb-0">Không có thiết bị</p></td>
                      </tr>';
        }
        foreach ($equiments as $eq) {
            $i = $i + 1;
            if ($i == 1) {
                $html .= ' <tr id="data-row-' . $i . '" class="poiter bgr-selected">';
            } else {
                $html .= ' <tr id="data-row-' . $i . '" class="poiter " >';
            }
            $html .= ' 
            
             <td select-id="data-row-' . $i . '" class="equipment-table-row" data-get="' . $eq->id . '">
                 <p class="text-sm font-weight-bold  mb-0" >' . $eq->code . '</p>
            </td>
            <td select-id="data-row-' . $i . '" class="equipment-table-row" data-get="' . $eq->id . '">
                <p class="text-sm font-weight-bold  mb-0" >' . $eq->name . '</p>
            </td>
            <td select-id="data-row-' . $i . '" class="equipment-table-row" data-get="' . $eq->id . '">
                <p class="text-sm font-weight-bold  mb-0 text-center" >' . $eq->equipment_type . '</p>
            </td>
                <td class="d-flex justify-content-center">
                <a href="" class="text-sm font-weight-bold  equipment-edit-btn" id-equipment="' . $eq->id . '" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_update_equipment_form"  aria-controls="offcanvas_update_equipment_form">Sửa</a>
                </td>
            </tr>
            ';
        }

        $html .= '  </tbody>
             </table>
             ' . $equiments->links() . '
        </div>';
        return $html;
    }
    public static function build_table_equipment_allocation($equipment)
    {
        $html = '<div class="table-responsive">
                    <table class="table table-hover	">
                        <colgroup>
                            <col width="150" span="1">
                        </colgroup>
                        <caption></caption>
                        <thead class="table-light">
                            <tr>
                                <th class="align-items-center">Mã Thiết Bị</th>
                                <th class="text-center">Tên Thiết Bị</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($equipment as $item) {
            $html .= '<tr class="poiter" id="id_equipment_select_'.$item->id.'" onclick="get_quipment_detail_allocation(' . $item->id . ')">
                    <td class="text-center">' . $item->code . '</td>
                    <td>' . $item->name . '</td>
                </tr>';
        }
        $html .= '</tbody>
                  <tfoot>
                    <h4 class="text-center">Danh Sách Thiết Bị</h4>
                  </tfoot>
              </table>
          </div>
          ' . $equipment->links() . '
          ';
        return $html;
    }
}
