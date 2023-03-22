<?php

namespace App\Http\Controllers;

use App\Models\storehouse;
use App\Models\storehouse_detail;
use App\Models\transfer;
use App\Models\transfer_detail;
use App\Models\use_detail;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function Index()
    {
        $user = Auth::user();
        $storehouse = storehouse::all();
        return view('pages.Equiments.Transfer.transfer', compact('user', 'storehouse'));
    }

    public function GetNhanSu($id = null)
    {
        $user = Auth::user();
        $users = DB::table('users')->select(['img_url', 'id', 'fullname'])->where([['id', '<>', $id], ['id', '<>', $user->id]])->get();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function GetStoreHouse($keyword = null)
    {
        $equipment_storehouse = DB::table('storehouse_details as td')
            ->join('equipments as e', 'e.id', '=', 'td.equipment_id')
            ->join('storehouses as sh', 'sh.id', '=', 'td.storehouse_id')
            ->select(['td.id as id_storehouse_detail', 'e.id', 'e.name', 'e.image', 'td.amount'])
            ->where('sh.id', $keyword)
            ->get();

        return response()->json([
            'equipment' => $equipment_storehouse,
        ]);
    }

    public function GetUseDetail($id = null)
    {
        $usedetail = DB::table('use_details as ud')
            ->join('equipments as e', 'e.id', '=', 'ud.equipment_id')
            ->join('users as u', 'u.id', '=', 'ud.user_id')
            ->select(['ud.id', 'u.id as id_user', 'u.fullname', 'u.img_url', 'e.name', 'e.image', 'ud.amount'])
            ->where('u.id', $id)
            ->get();

        return response()->json([
            'usedetails' => $usedetail,
        ]);
    }

    public function GetEquimentById($id = null)
    {
        $equipment = DB::table('storehouse_details as td')
            ->join('equipments as e', 'e.id', '=', 'td.equipment_id')
            ->join('storehouses as sh', 'sh.id', '=', 'td.storehouse_id')
            ->select(['td.id as id_storehousedetail', 'e.id', 'e.name', 'e.image', 'td.amount'])
            ->where('td.id', $id)
            ->get();

        return response()->json([
            'equipment' => $equipment,
        ]);
    }

    public function GetEquimentUseDetailById($id = null)
    {
        $usedetail = DB::table('use_details as ud')
            ->join('equipments as e', 'e.id', '=', 'ud.equipment_id')
            ->join('users as u', 'u.id', '=', 'ud.user_id')
            ->select(['ud.id as id_usedetail', 'u.fullname', 'u.img_url', 'e.id', 'e.name', 'e.image', 'ud.amount'])
            ->where('ud.id', $id)
            ->get();

        return response()->json([
            'equipment' => $usedetail,
        ]);
    }

    public function CreateTransfer(Request $request)
    {
        $user_transfer_id = $request->user_transfer_id;
        $user_receive_id = $request->user_receive_id;
        $performer_id = $request->performer_id;
        $transfer_type = $request->transfer_type;
        $transfer_detail = $request->transfer_detail;

        $transfer = new transfer();
        $transfer->user_transfer_id = $user_transfer_id;
        $transfer->user_receive_id = $user_receive_id;
        $transfer->performer_id = $performer_id;
        $transfer->transfer_type = $transfer_type;
        $transfer->transfer_detail = $transfer_detail;
        $transfer->save();

        return response()->json([
            'transfer' => $transfer,
        ]);
    }

    public function CreateTransferDetail(Request $request)
    {
        $equipment_id = $request->equipment_id;
        $transfer_id = $request->transfer_id;
        $amount = $request->amount;

        $transfer_detail = new transfer_detail();
        $transfer_detail->equipment_id = $equipment_id;
        $transfer_detail->transfer_id = $transfer_id;
        $transfer_detail->amount = $amount;
        $transfer_detail->save();

        return response()->json([
            'transfer_detail' => $transfer_detail,
        ]);
    }

    public function UpdateAmountStoreHouseDetail(Request $request)
    {
        $storehouse_detail = storehouse_detail::find($request->id);
        $storehouse_detail->amount = $storehouse_detail->amount - $request->amount;
        $storehouse_detail->save();

        return response()->json([
            'transfer_detail' => $storehouse_detail,
        ]);
    }

    public function AddOrUpdateUseDetail(Request $request)
    {
        $id_equipment = $request->id_equipment;
        $id_user = $request->id_user;
        $amount = $request->amount;
        $use_details = DB::table('use_details')->where([['equipment_id', '=', $id_equipment], ['user_id', '=', $id_user]])->get()->toArray();

        if (count($use_details) == 0) {
            $use_detail = new use_detail();
            $use_detail->equipment_id = $id_equipment;
            $use_detail->user_id = $id_user;
            $use_detail->amount = $amount;
            $use_detail->save();
            return response()->json([
                'use_detail' => $use_detail,
            ]);
        }

        $newamount = $use_details[0]->amount + $amount;
        $result = DB::table('use_details')->where([['equipment_id', '=', $id_equipment], ['user_id', '=', $id_user]])->update(['amount' => $newamount]);
        return response()->json([
            'result' => $result == 0 ? "Thất bại" : "Thành công",
        ]);
    }

    public function UpdateUseDetail(Request $request)
    {
        $usedetail_id = $request->usedetail_id;
        $amount = $request->amount;
        $use_details = use_detail::find($usedetail_id);
        $newamount = $use_details->amount - $amount;
        if ($newamount == 0) {
            $use_details->delete();
        } else {
            $use_details->amount = $newamount;
            $use_details->save();
        }

        return response()->json([
            'use_details' => $newamount,
        ]);
    }

    public function UpdateKhoDetail(Request $request)
    {
        $storehouse_details = DB::table('storehouse_details')->where([['storehouse_id', $request->storehouse_id], ['equipment_id', $request->equipment_id]])->get()->toArray();
        if (count($storehouse_details) == 0) {
            $result = DB::table('storehouse_details')->insert(['storehouse_id' => $request->storehouse_id, 'equipment_id' => $request->equipment_id, 'amount' => $request->amount]);
        } else {
            $newamount = $storehouse_details[0]->amount + $request->amount;
            $result = DB::table('storehouse_details')->where([['storehouse_id', $request->storehouse_id], ['equipment_id', $request->equipment_id]])->update(['amount' => $newamount]);
        }

        return response()->json([
            'result' => $result,
        ]);
    }
}