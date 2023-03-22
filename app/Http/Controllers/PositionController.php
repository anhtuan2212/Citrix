<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\nominee;
use Illuminate\Http\Request;
use App\Models\User;

class PositionController extends Controller
{
    public function index(){
        // $positions = Position::with('nominees')->get();
        return view("auth.department.position.index");
    }

    public function get_positions()
    {
        $positions = Position::with('nominees')->paginate(5);
        return view('auth.department.position.data', compact('positions'));
    }

    public function delete_position(Request $request)
    {
        $positions = Position::findOrFail($request -> id);
        if ($positions) {
            $positions->delete();
            return response()->json(['status' => 1, 'msg' => 'Xóa thành công']);
        }
    }

    public function delete_nominee(Request $request)
    {
        $nominee = nominee::findOrFail($request -> id);
        if ($nominee) {
            $nominee->delete();
            return response()->json(['status' => 1, 'msg' => 'Xóa thành công']);
        }
    }

    public function update_position(Request $request)
    {
        $position = Position::findOrFail($request -> id);
        if ($position) {
            $position->position = $request -> name;
            $position -> save();
            return response()->json(['status' => 1, 'msg' => 'Sửa thành công']);
        }
    }

    public function add_position(Request $request)
    {
        $position = new Position;
        $position -> position = $request -> position_name;
        $position -> save();
        foreach(explode(',', $request->nominees) as $nominee){
            $nomineeNew = new nominee;
            $nomineeNew -> position_id = $position -> id;
            $nomineeNew -> nominees = $nominee;
            $nomineeNew -> save();
        }
        return response()->json(['status' => 1, 'msg' => 'Thêm thành công']);
    }

    public function add_nominee(Request $request)
    {
        $nominee = new nominee;
        $nominee -> nominees = $request -> nominee;
        $nominee -> position_id = $request -> id;
        $nominee -> save();
        return response()->json(['status' => 1, 'msg' => 'Thêm thành công']);
    }

    public function update_nominee(Request $request)
    {
        $nominee = nominee::with('users')->find($request -> id);
        if ($nominee) {
            $nominee->nominees = $request -> name;
            $nominee -> save();
            if($nominee -> users != null){
                foreach($nominee -> users as $user){
                    $userNew = User::find($user -> id);
                    $userNew -> nominee = $request -> name;
                    $userNew -> save();
                }
            }
            return response()->json(['status' => 1, 'msg' => 'Sửa thành công']);
        }
    }
}
