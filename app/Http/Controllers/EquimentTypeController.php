<?php

namespace App\Http\Controllers;

use App\Models\equiment;
use App\Models\Equiment_Type;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class EquimentTypeController extends Controller
{
    public function Get($perpage, $oderby, $keyword = null)
    {
        if ($keyword == null) {
            $list = DB::table('equipment_types')
                ->orderBy('created_at', $oderby)
                ->paginate($perpage);
            return $list;
        }

        $list = DB::table('equipment_types')
            ->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('status', $keyword)
            ->orderBy('created_at', $oderby)
            ->paginate($perpage);
        return $list;
    }

    public function Post(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:6']
            ],
            [
                'name.required' => "Tên loại không được để trống!",
                'name.min' => "Tên loại phải lớn hơn 6 kí tự!"
            ]
        );

        $name = $request->name;
        $status = $request->status == 'on' ? 1 : 0;
        $created_at = Carbon::Now();
        $updated_at = Carbon::Now();

        return DB::table('equipment_types')->insert([
            'name' => $name,
            'status' => $status,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);
    }

    public function Delete($id)
    {
        return DB::table('equipment_types')->where('id', '=', $id)->delete();
    }

    public function Get_By_Id($id)
    {
        return DB::table('equipment_types')->find($id);
    }

    public function Update($id, Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:6']
            ],
            [
                'name.required' => "Tên loại không được để trống!",
                'name.min' => "Tên loại phải lớn hơn 6 kí tự!"
            ]
        );

        $name = $request->name;
        $status = $request->status == 'on' ? 1 : 0;
        $updated_at = Carbon::Now();

        return DB::table('equipment_types')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'status' => $status,
                'updated_at' => $updated_at,
            ]);
    }
}