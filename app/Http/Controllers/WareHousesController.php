<?php

namespace App\Http\Controllers;

use App\Models\storehouse;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use App\Models\equiment;

class WareHousesController extends Controller
{
    function Index()
    {
        $list_nha_cung_cap = Supplier::all();
        $list_loai = DB::table('equipment_types')->get();
        $list_kho = storehouse::all();
        return view('pages.Equiments.warehouse.wavehouse', compact('list_nha_cung_cap', 'list_loai', 'list_kho'));
    }

    public function Get($perpage, $orderby, $keyword = null)
    {
        if ($keyword == null) {
            $list = DB::table('storehouses')
                ->orderBy('created_at', $orderby)
                ->paginate($perpage);
            return response()->json(
                ['warehouses' => $list],
                200
            );
        }

        $list = DB::table('storehouses')
            ->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('address', 'like', '%' . $keyword . '%')
            ->orderBy('created_at', $orderby)
            ->paginate($perpage);

        return response()->json(
            ['warehouses' => $list],
            200
        );
    }

    public function Delete($id)
    {
        $mesage = "";
        $check = DB::table('storehouse_details')->where('storehouse_id', '=', $id)->get();
        if ($check->count() > 0) {
            $mesage = "Không thể xóa";
        } else {
            $result = DB::table('storehouses')->where('id', '=', $id)->delete();
            if ($result == 0) {
                $mesage = "Thất bại";
            } else {
                $mesage = "Thành công";
            }
        }

        return response()->json([
            'message' => $mesage,
        ], 200);
    }

    public function GetById($id)
    {
        $result = DB::table('storehouses')->find($id);

        return response()->json([
            'warehouse' => $result,
        ], 200);
    }

    public function Create(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:6'],
                'address' => ['required', 'min:6'],
            ],
            [
                'name.required' => "Tên kho không được để trống!",
                'name.min' => "Tên kho phải lớn hơn 6 kí tự!",
                'address.required' => "Địa chỉ không được để trống!",
                'address.min' => "Địa chỉ phải lớn hơn 6 kí tự!",
            ]
        );

        if ($request->has('image')) {
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $name = $request->name;
        $address = $request->address;
        $image = "uploads/" . $file_name;
        $status = $request->status == 'on' ? 1 : 0;

        $result = DB::table('storehouses')->insert([
            'name' => $name,
            'address' => $address,
            'image' => $image,
            'status' => $status,
        ]);

        $message = $result == 0 ? "Không thành công" : "Thành công";

        return response()->json([
            'message' => $message,
        ], 200);
    }

    public function Update($id, Request $request)
    {
        $image_old = DB::table('storehouses')->where('id', $id)->select(['image'])->get();

        $request->validate(
            [
                'name' => ['required', 'min:6'],
                'address' => ['required', 'min:6'],
            ],
            [
                'name.required' => "Tên kho không được để trống!",
                'name.min' => "Tên kho phải lớn hơn 6 kí tự!",
                'address.required' => "Địa chỉ không được để trống!",
                'address.min' => "Địa chỉ phải lớn hơn 6 kí tự!",
            ]
        );

        $file_name = "";

        if ($request->has('image')) {
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        } else {
            $file_name = str_replace('uploads/', '', $image_old[0]->image);
        }

        $name = $request->name;
        $address = $request->address;
        $image = "uploads/" . $file_name;
        $status = $request->status == 'on' ? 1 : 0;

        $result = DB::table('storehouses')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'address' => $address,
                'image' => $image,
                'status' => $status,
            ]);


        $message = $result == 0 ? "Không thành công" : "Thành công";

        return response()->json([
            'message' => $message,
        ], 200);
    }

    public function GetEquiments($perpage, $curentpage, $id, $keyword = null)
    {
        $equiment_types = DB::table('equipment_types')
            ->select(['id', 'name'])
            ->get()
            ->toArray();

        $newtable = array();

        foreach ($equiment_types as $value) {
            $result = DB::table('storehouse_details as sd')
                ->join('equipments as e', 'e.id', '=', 'sd.equipment_id')
                ->join('storehouses as sh', 'sh.id', '=', 'sd.storehouse_id')
                ->select(['e.id as equipment_id', 'sh.id as storehouse_id', 'sd.id as storehouse_details_id', 'sh.name as name_storehouse', 'e.name', 'e.image', 'sd.amount'])
                ->where([
                    ['sd.storehouse_id', $id],
                    ['e.equipment_type_id', $value->id]
                ])
                ->get()
                ->toArray();

            $list_equiment = $this->paginate($result, $perpage, $curentpage);

            if (count($list_equiment) != 0) {
                $newtable['' . $value->name . ''] = $list_equiment;
            }
        }
        return $newtable;
    }

    function paginate($item, $perpage, $page)
    {
        $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($item);
        $curentpage = $page;
        $offset = ($curentpage * $perpage) - $perpage;
        $itemtoshow = array_slice($item, $offset, $perpage);
        return new \Illuminate\Pagination\LengthAwarePaginator($itemtoshow, $total, $perpage);
    }

    function CreateEquipment(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:6'],
                'image' => ['required'],
                'specifications' => ['required', 'min:6'],
                'price' => ['required', 'regex:/^[0-9]+$/'],
                'warranty_date' => ['date'],
                'out_of_date' => ['date'],
            ],
            [
                'name.required' => "Tên thiết bị không được để trống!",
                'name.min' => "Tên thiết bị phải lớn hơn 6 kí tự!",
                'image.required' => "Ảnh thiết bị không được để trống!",
                'specifications.required' => "Thông số thiết bị không được để trống!",
                'specifications.min' => "Thông số thiết bị phải lớn hơn 6 kí tự!",
                'price.required' => "Giá nhập không được để trống!",
                'price.regex' => "Giá nhập phải là số!",
                'warranty_date.date' => "Ngày không hợp lệ!",
                'out_of_date.date' => "Ngày không hợp lệ!",
            ]
        );

        if ($request->has('image')) {
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $name = $request->name;
        $image = $file_name;
        $specifications = $request->specifications;
        $price = $request->price;
        $warranty_date = $request->warranty_date;
        $out_of_date = $request->out_of_date;
        $supplier_id = $request->supplier_id;

        $equipment = new equiment();
        $equipment->name = $name;
        $equipment->image = $image;
        $equipment->specifications = $specifications;
        $equipment->price = $price;
        $equipment->warranty_date = $warranty_date;
        $equipment->out_of_date = $out_of_date;
        $equipment->supplier_id = $supplier_id;
        $equipment->save();

        return response()->json([
            'equipment' => $equipment
        ], 200);
    }

    function CreateStoreHouseDetail(Request $request)
    {
        $result = DB::table('storehouse_details')->insert(['storehouse_id' => $request->storehouse_id, 'equipment_id' => $request->equipment_id, 'amount' => $request->amount]);
        return response()->json([
            'result' => $result,
        ]);
    }

    function ViewDetail($id, $name)
    {
        $id_kho = $id;
        $name_kho = $name;
        $list_nha_cung_cap = Supplier::all();
        $list_loai = DB::table('equipment_types')->get();
        $list_kho = storehouse::all();
        return view('pages.Equiments.Equipment.equipment_storehouse', compact('id_kho', 'name_kho', 'list_nha_cung_cap', 'list_loai', 'list_kho'));
    }

    function ViewStoreHouseDetail($perpage, $id)
    {
        $result = DB::table('storehouse_details as sd')
            ->join('equipments as e', 'e.id', '=', 'sd.equipment_id')
            ->select(['e.id', 'e.image', 'e.name', 'e.out_of_date', 'e.warranty_date', 'sd.amount', 'sd.created_at'])
            ->where('sd.storehouse_id', $id)
            ->paginate($perpage);

        return $result;
    }

    public function GetEquipmentById($id)
    {
        $equipment = equiment::find($id);
        return $equipment;
    }

    public function UpdateEquipment($id, Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:6'],
                'image' => ['required'],
                'specifications' => ['required', 'min:6'],
                'price' => ['required', 'regex:/^[0-9]+$/'],
                'warranty_date' => ['date'],
                'out_of_date' => ['date'],
            ],
            [
                'name.required' => "Tên thiết bị không được để trống!",
                'name.min' => "Tên thiết bị phải lớn hơn 6 kí tự!",
                'image.required' => "Ảnh thiết bị không được để trống!",
                'specifications.required' => "Thông số thiết bị không được để trống!",
                'specifications.min' => "Thông số thiết bị phải lớn hơn 6 kí tự!",
                'price.required' => "Giá nhập không được để trống!",
                'price.regex' => "Giá nhập phải là số!",
                'warranty_date.date' => "Ngày không hợp lệ!",
                'out_of_date.date' => "Ngày không hợp lệ!",
            ]
        );
        $equipment = equiment::find($id);

        if ($request->has('image')) {
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $name = $request->name;
        $image = $file_name;
        $specifications = $request->specifications;
        $price = $request->price;
        $warranty_date = $request->warranty_date;
        $out_of_date = $request->out_of_date;
        $supplier_id = $request->supplier_id;

        $equipment->name = $name;
        $equipment->image = $image;
        $equipment->specifications = $specifications;
        $equipment->price = $price;
        $equipment->warranty_date = $warranty_date;
        $equipment->out_of_date = $out_of_date;
        $equipment->supplier_id = $supplier_id;
        $equipment->save();

        return response()->json([
            'equipment' => $equipment,
        ]);
    }
}