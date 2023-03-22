<?php

namespace App\Http\Controllers\equipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddEquipmentRequest;
use App\Http\Requests\InsertEquipmentRequest;
use App\Http\Requests\InsertEquipmentTypesRequest;
use App\Http\Requests\UpdateEquipmentDetailRequest;
use App\Models\Equipment;
use App\Models\equipment_tranfer;
use App\Models\EquipmentDetail;
use App\Models\EquipmentType;
use App\Models\Supplier;
use App\Models\Transfer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{


    public function index(Request $request)
    {
        $equiment = Equipment::first();
        if ($request->ajax()) {
            $equipments = Equipment::getAll_Equipment_AND_TYPE();
            $build = Equipment::biuld_equipment($equipments);
            $equipment_detail = EquipmentDetail::paginate(config('const.EQUIPMENT.PAGE_SIZE_EQUIPMENT_DETAIL'));
            $equipment_build = EquipmentDetail::build_equipment_detail($equipment_detail, $equipments[0]);
            return  response()->json(['status' => 'success', 'location' => 'build_equipment', 'body' => $build]);
        }
        $equiment_type = EquipmentType::all();
        $equipments = Equipment::getAll_Equipment_AND_TYPE();
        $equipment_detail = EquipmentDetail::get_equipment_detail_by_equipment($equiment->id);
        $equipment_detail->setPath('equiment_detail/paginate');
        $personnel = User::getAll();
        $personnel->setpath('equipment/personnel');
        return view('pages.Equiments.equipment', compact('equipments', 'equipment_detail', 'personnel', 'equiment', 'equiment_type'));
    }
    public function get_equipment_detail_by_equipment(Request $request)
    {
        $equipment = Equipment::find($request->id);
        $equipment_details = EquipmentDetail::get_equipment_detail_by_equipment($request->id);
        $equipment_details->setPath('equiment_detail/paginate');
        $build = EquipmentDetail::build_equipment_detail($equipment_details, $equipment);

        return  response()->json(['status' => 'success', 'body' => $build]);
    }
    public function equipment_detail_allocation(Request $request)
    {
        $equipment_detail = EquipmentDetail::get_equipment_detail_by_equipment_and_st($request->id, 0);
        $equipment_detail->setpath('equipment_detail/allocation');
        $build = EquipmentDetail::build_equipment_detail_allocation($equipment_detail);
        return  response()->json(['status' => 'success', 'body' => $build]);
    }
    public function allocation_equipment(Request $request)
    {
        dd($request);
        $max = Transfer::select('id')->orderBy('id', 'DESC')->first();
        if (empty($max)) {
            $max->id = 1;
        }
        $tranfer = new Transfer();
        $tranfer->user_transfer = Auth::user()->id;
        $tranfer->user_recipient = $request->user_id;
        $tranfer->transfer_date = Carbon::now();
        $tranfer->save();
        $equipment_tranfer = new equipment_tranfer();
        $equipment_tranfer->id_transfer = $max->id;
        foreach ($request->arr as $item) {
            $eq_detail = EquipmentDetail::find($item);
        }
    }
    public function get_all_equipment_detail_paginate_staus_0(Request $request)
    {
        // dd($request);
        $equipment_detail = EquipmentDetail::get_equipment_detail_by_equipment_and_st($request->id_eq_detail, 0);
        $equipment_detail->setpath('/equipment_detail/allocation');
        $build = EquipmentDetail::build_equipment_detail_allocation($equipment_detail);
        return  response()->json(['status' => 'success', 'location' => 'eq_detail_allocation', 'eq_detail' => $build]);
    }
    public function get_all_equipment_staus_0(Request $request)
    {
        if ($request->ajax()) {
            $equipment = Equipment::get_all_equipment_staus_0();
            $equipment->setpath('equipment/allocation');
            $build_equipment = Equipment::build_table_equipment_allocation($equipment);
            return  response()->json(['status' => 'success', 'location' => 'eq_allocation', 'equipment' => $build_equipment]);
        }
        $equipment = Equipment::get_all_equipment_staus_0();
        $equipment->setpath('equipment/allocation');
        $build_equipment = Equipment::build_table_equipment_allocation($equipment);
        $equipment_detail = EquipmentDetail::get_equipment_detail_by_equipment_and_st($equipment[0]->id, 0);
        $equipment_detail->setpath('equipment_detail/allocation');
        $build_detail = EquipmentDetail::build_equipment_detail_allocation($equipment_detail);
        return  response()->json(['status' => 'success', 'location' => 'eq_allocation', 'equipment' => $build_equipment, 'equipment_detail' => $build_detail]);
    }

    public function equipment_fillter(Request $request)
    {
        if ($request->equipment_type == "99") {
            $equipment = Equipment::getAll_Equipment_AND_TYPE();
            $equipment->setpath('equipment');
        } else {
            $equipment = Equipment::fillter($request->equipment_type);
            $equipment->setPath('/equipment/fillter');
        }
        $build = Equipment::biuld_equipment($equipment);

        return  response()->json(['status' => 'success', 'location' => 'build_equipment', 'body' => $build]);
    }
    public function get_equipment_detail_by_id(Request $request)
    {
        $eq_detail = EquipmentDetail::get_equipment_detail_by_id($request->id);

        return  response()->json(['status' => 'success', 'body' => $eq_detail]);
    }
    public function equipment_detail_delete(Request $request)
    {
        // dd($request);
        foreach ($request->id as $item) {
            $eq_detail = EquipmentDetail::find($item);
            $eq_detail->delete();
        }

        return  response()->json(['status' => 'success', 'message' => 'Xóa thành công !']);
    }
    public function search_emquipment(Request $request)
    {
        if (empty($request->search)) {
            $equipments = Equipment::getAll_Equipment_AND_TYPE();
            $equipments->setpath('equipment');
        } else {
            $equipments = Equipment::search_equipment($request->search);
            $equipments->setpath('equipment_search');
        }
        $build = Equipment::biuld_equipment($equipments);

        return  response()->json(['status' => 'success', 'body' => $build]);
    }
    public function search_emquipment_paginate(Request $request)
    {
        if (empty($request->eq_search)) {
            $equipments = Equipment::getAll_Equipment_AND_TYPE();
            $equipments->setpath('equipment');
        } else {
            $equipments = Equipment::search_equipment($request->eq_search);
            $equipments->setpath('equipment_search');
        }
        $build = Equipment::biuld_equipment($equipments);

        return  response()->json(['status' => 'success', 'location' => 'build_equipment', 'body' => $build]);
    }
    public function get_all_equipment_paginate(Request $request)
    {
        $equipment = Equipment::find($request->id);
        $equipment_details = EquipmentDetail::get_equipment_detail_by_equipment($request->id);
        $equipment_details->setPath('equiment_detail/paginate');
        $build = EquipmentDetail::build_equipment_detail($equipment_details, $equipment);

        return  response()->json(['status' => 'success', 'location' => 'equipment_detail', 'body' => $build]);
    }

    public function update_equipment(Request $request)
    {
        $equipment = Equipment::find($request->equipment_id_update);
        $equipment->name = $request->equipment_name_update;
        if ($equipment->id_type !== $request->equipment_type_update) {
            $eq = EquipmentDetail::get_all_equipment_detail_by_equipment_no_paginate($equipment->id);
            $current_type = EquipmentType::find($equipment->id_type);
            $type = EquipmentType::find($request->equipment_type_update);
            foreach ($eq as $item) {
                $result = str_replace($current_type->code, $type->code, $item->equipment_code);
                $item->equipment_code = $result;

                $item->save();
            }
        }
        $equipment->status = $request->equipment_status_update;
        $equipment->id_type = $request->equipment_type_update;

        $equipment->save();

        return  response()->json(['status' => 'success', 'message' => 'Cập Nhật Thành Công !']);
    }
    public function update_equipment_detail(UpdateEquipmentDetailRequest $request)
    {
        $eq_detail = EquipmentDetail::find($request->equipment_detail_id_update);
        if ($request->equipment_detail_imei_update !== $eq_detail->imei) {
            $request->validate([
                'equipment_detail_imei_update' => 'unique:equipment_details,imei'
            ], [
                'equipment_detail_imei_update.unique' => 'IMEI đã tồn tại !'
            ]);
        }
        if (!empty($eq_detail->img)) {
            if ($eq_detail->img !== $request->img_equipment_detail) {
                File::delete($eq_detail->img);
            }
        }
        if (!$request->img_equipment_detail == '') {
            $fileName = time() . '.' . $request->img_equipment_detail->extension();
            $request->img_equipment_detail->move(public_path('img'), $fileName);
            $eq_detail->img = $fileName;
        }
        $eq_detail->imei = $request->equipment_detail_imei_update;
        $eq_detail->supplier_id = $request->equipment_detail_supplier;
        $eq_detail->warranty_expiration_date = $request->equipment_detail_warranty_expiration_date;
        $eq_detail->status = $request->equipment_detail_status;
        $eq_detail->specifications = $request->equipment_detail_specifications;
        $eq_detail->note = $request->equipment_detail_note;
        $eq_detail->date_added = $request->equipment_detail_date_added;
        $eq_detail->save();

        $equipment = Equipment::find($eq_detail->id_equipment);
        $equipment_details = EquipmentDetail::get_equipment_detail_by_equipment($equipment->id);
        $equipment_details->setPath('equiment_detail/paginate');
        $build = EquipmentDetail::build_equipment_detail($equipment_details, $equipment);

        return  response()->json(['status' => 'success', 'message' => 'Cập nhật thành công !', 'equipment_detail' => $build]);
    }
    public function get_all_equipment_type()
    {
        $build = EquipmentType::all();
        return  response()->json(['status' => 'success', 'equipment_types' => $build]);
    }
    public function get_all_equipment_supplier()
    {
        $build = Supplier::all();
        return  response()->json(['status' => 'success', 'suppliers' => $build]);
    }
    public function get_all_equipment_detail(Request $request)
    {

        $eq = Equipment::get_Equipment_AND_TYPE_by_id($request->id);
        $eq_detail = EquipmentDetail::get_equipment_detail_by_equipment($request->id);
        $eq_detail->setpath('equipment_detail_update');
        $count_detail = count(EquipmentDetail::get_equipment_detail_by_equipment_no_paginate($request->id));
        $build = EquipmentDetail::build_update_product($eq_detail);
        return  response()->json(['status' => 'success', 'build_product' => $build, 'equipment' => $eq, 'count_detail' => $count_detail]);
    }
    public function get_equipment_detail_paginate(Request $request)
    {
        $eq_detail = EquipmentDetail::get_equipment_detail_by_equipment($request->id_eq);
        $eq_detail->setpath('equipment_detail_update');
        $build = EquipmentDetail::build_update_product($eq_detail);
        return  response()->json(['status' => 'success', 'location' => 'table_equipment_update', 'body' => $build]);
    }
    public function delete_Suppliers_by_id(Request $request)
    {
        $sup = Supplier::find($request->id);
        $sup->delete();
        return  response()->json(['status' => 'success', 'message' => 'Xóa thành công !']);
    }
    public function get_suppliers_by_id(Request $request)
    {
        $sup = Supplier::find($request->id);
        return  response()->json(['status' => 'success', 'body' => $sup]);
    }
    public function save_suppliers(Request $request)
    {
        $request->validate([
            'suppliers' => 'required|min:4|max:100',
        ], [
            'suppliers.required' => "Tên thể loại không được để trống !",
            'suppliers.min' => "Tên thể loại quá ngắn !",
            'suppliers.max' => "Tên thể loại quá dài !",
        ]);
        if (empty($request->id)) {
            $sup = new Supplier();
            $request->validate([
                'suppliers' => 'unique:suppliers,name',
            ], [
                'suppliers.unique' => "Tên thể loại đã tồn tại !",
            ]);
        } else {
            $sup = Supplier::find($request->id);
            if ($request->suppliers !== $sup->name) {
                $request->validate([
                    'suppliers' => 'unique:suppliers,name',
                ], [
                    'suppliers.unique' => "Tên thể loại đã tồn tại !",
                ]);
            }
        }
        $sup->name = $request->suppliers;
        $sup->save();
        return  response()->json(['status' => 'success', 'message' => "Lưu Thành Công !"]);
    }
    public function insert_emquipment_types(InsertEquipmentTypesRequest $request)
    {
        if (empty($request->id)) {
            $types = new EquipmentType();
            $request->validate([
                'equipment_type_code_insert' => 'unique:equipment_types,code'
            ], [
                'equipment_type_code_insert.unique' => 'Mã thể loại đã tồn tại !',
            ]);
        } else {
            $types = EquipmentType::find($request->id);
            if ($request->equipment_type_code_insert !== $types->code) {
                $request->validate([
                    'equipment_type_code_insert' => 'unique:equipment_types,code'
                ], [
                    'equipment_type_code_insert.unique' => 'Mã thể loại đã tồn tại !',
                ]);
            }
        }

        $types->name = $request->equipment_type;
        $types->code = strtoupper($request->equipment_type_code_insert);
        $types->accessory = $request->accessory == "false" ? 0 : 1;
        $types->save();
        return  response()->json(['status' => 'success']);
    }
    public function get_ALL_Suppliers()
    {
        $sup = Supplier::all();
        return response()->json(['status' => 'success', 'suppliers' => $sup]);
    }
    public function get_equipment_type_by_id(Request $request)
    {
        $type = EquipmentType::find($request->id);
        return response()->json(['status' => 'success', 'equipment_type' => $type]);
    }
    public function delete_equipment_type_by_id(Request $request)
    {
        $type = EquipmentType::find($request->id);
        $type->delete();
        return response()->json(['status' => 'success', 'message' => "Xóa Thành Công !"]);
    }
    public function insert_equipment(InsertEquipmentRequest $request)
    {

        if ($request->equipment_quantity < 1) {
            return  response()->json(['status' => 'error', 'message' => 'Số lượng thiết bị quá nhỏ !']);
        }
        $daterq = $request->equipment_warranty_expiration_date;
        $now = Carbon::now()->addMonth();
        if ($daterq <= $now) {
            return response()->json(['status' => 'error', 'message' => 'Thời hạn bảo hành tối thiểu 1 tháng !']);
        }
        $equipment = new Equipment();
        //set code equipment
        $max = Equipment::orderBy('id', 'DESC')->first();
        if (strlen($max->id) < 2) {
            $equipment->code = 'SKU00000' . $max->id + 1;
        } else if (strlen($max->id) < 3) {
            $equipment->code = 'SKU0000' . $max->id + 1;
        } else if (strlen($max->id) < 4) {
            $equipment->code = 'SKU000' . $max->id + 1;
        } else if (strlen($max->id) < 5) {
            $equipment->code = 'SKU00' . $max->id + 1;
        } else if (strlen($max->id) < 6) {
            $equipment->code = 'SKU0' . $max->id + 1;
        } else if (strlen($max->id) < 7) {
            $equipment->code = 'SKU' . $max->id + 1;
        }
        $equipment->id_type = $request->equipment_type;
        $equipment->name = $request->equipment_name;
        $equipment->save();

        $eq = Equipment::find_equipment_and_types_by_code($equipment->code);
        if (!$request->img_equipment == '') {
            $fileName = time() . '.' . $request->img_equipment->extension();
            $request->img_equipment->move(public_path('img'), $fileName);
            $img = $fileName;
        }
        $max_for = (int) $request->equipment_quantity;
        for ($i = 1; $i <= $max_for; $i++) {
            $eq_detail = new EquipmentDetail();
            $eq_detail->id_equipment = $eq[0]->id;
            if (empty($img)) {
                $a = null;
                $eq_detail->img = $a;
            } else {
                $eq_detail->img = $img;
            }
            $eq_detail->supplier_id = $request->equipment_supplier;
            $eq_detail->warranty_expiration_date = $request->equipment_warranty_expiration_date;
            $eq_detail->specifications = $request->equipment_specifications;
            $eq_detail->note = $request->equipment_note;
            $eq_detail->date_added = $request->equipment_date_added;
            $max_detail = EquipmentDetail::orderBy('id', 'DESC')->first();

            if (strlen($max_detail->id) < 2) {
                $eq_detail->equipment_code = $eq[0]->equipment_type_code . '00000' . $max_detail->id;
            } else if (strlen($max_detail->id) < 3) {
                $eq_detail->equipment_code = $eq[0]->equipment_type_code . '0000' . $max_detail->id;
            } else if (strlen($max_detail->id) < 4) {
                $eq_detail->equipment_code = $eq[0]->equipment_type_code . '000' . $max_detail->id;
            } else if (strlen($max_detail->id) < 5) {
                $eq_detail->equipment_code = $eq[0]->equipment_type_code . '00' . $max_detail->id;
            } else if (strlen($max_detail->id) < 6) {
                $eq_detail->equipment_code = $eq[0]->equipment_type_code . '0' . $max_detail->id;
            } else if (strlen($max_detail->id) < 7) {
                $eq_detail->equipment_code = $eq[0]->equipment_type_code . '' . $max_detail->id;
            }

            $eq_detail->save();
        }

        return  response()->json(['status' => 'success', 'message' => 'Thêm Mới Thiết Bị Mới Thành Công !']);
    }
    public function add_emquipment_quantity(AddEquipmentRequest $request)
    {
        $daterq = $request->warranty;
        $now = Carbon::now()->addMonth();
        if ($daterq <= $now) {
            return response()->json(['status' => 'error', 'message' => 'Thời hạn bảo hành tối thiểu 1 tháng !']);
        }
        $eq = Equipment::find_equipment_and_types($request->id);
        $x = 0;
        $max = (int) $request->quantity;
        for ($i = 1; $i <= $max; $i++) {
            $x++;
            $eq_detail = new EquipmentDetail();
            $eq_detail->id_equipment = $eq->id;
            $eq_detail->supplier_id = $request->supplier_id;
            $eq_detail->warranty_expiration_date = $request->warranty;
            $eq_detail->specifications = $request->specifications;
            $eq_detail->note = $request->note;
            $eq_detail->date_added = $request->add_date;
            $max_detail = EquipmentDetail::orderBy('id', 'DESC')->first();
            if (strlen($max_detail->id) < 2) {
                $eq_detail->equipment_code = $eq->equipment_type_code . '00000' . $max_detail->id;
            } else if (strlen($max_detail->id) < 3) {
                $eq_detail->equipment_code = $eq->equipment_type_code . '0000' . $max_detail->id;
            } else if (strlen($max_detail->id) < 4) {
                $eq_detail->equipment_code = $eq->equipment_type_code . '000' . $max_detail->id;
            } else if (strlen($max_detail->id) < 5) {
                $eq_detail->equipment_code = $eq->equipment_type_code . '00' . $max_detail->id;
            } else if (strlen($max_detail->id) < 6) {
                $eq_detail->equipment_code = $eq->equipment_type_code . '0' . $max_detail->id;
            } else if (strlen($max_detail->id) < 7) {
                $eq_detail->equipment_code = $eq->equipment_type_code . '' . $max_detail->id;
            }
            $eq_detail->save();
        }
        return response()->json(['status' => 'success', 'message' => 'Thêm Thành Công !']);
    }
}
