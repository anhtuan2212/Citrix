<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormDataRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;
use App\Models\Position;
use App\Models\nominee;
use Illuminate\Support\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use  Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate as FacadesGate;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('auth.department.form');
    }

    public function create_or_update(FormDataRequest $request)
    {
        if (!$request->validated()) {
            return response()->json(['status' => 0, 'msg' => $request->errors()]);
        } else {
            if ($request->id) {
                $department = Department::find($request->id);
            } else {
                $department = new Department;
            }

            if($request -> id_department_parent){
                $department_parent = Department::withDepth()->find($request -> id_department_parent);
                if($department_parent != null){
                    if($department_parent -> depth >= 3){
                        return response()->json(['status' => 0, 'msg' => 'Không Hỗ Trợ Từ 3 Cấp Trở Lên']);
                    }
                }
            }

            $department->name = $request->name;
            $department->status = $request->status == 'on' ? 1 : 0;
            $department->code = $request->code;

            if($department -> id){
                $department_exist = Department::where('code', $request -> code)->get();
                if($department_exist -> count() > 0){
                    if($department_exist[0] -> code == $department -> code && $department -> id != $department_exist[0] -> id){
                        return response()->json(['status' => 0, 'msg' => 'Mã Phòng Ban Đã Tồn Tại']);
                    }else{
                        $department->save();
                        return response()->json(['status' => 1, 'msg' => 'Sửa thành công']);
                    }
                }else{
                    $department->appendToNode($department_parent)->save();
                    return response()->json(['status' => 1, 'msg' => 'Sửa thành công']);
                }
            }else{
                $department_unique = Department::where('code', $request -> code)->get();
                if($department_unique -> count() > 0){
                    return response()->json(['status' => 0, 'msg' => 'Đã Tồn Tại']);
                }else{
                    if($request -> id_department_parent){
                        $department->appendToNode($department_parent)->save();
                    }else{
                        $department->saveAsRoot();

                        $department->makeRoot()->save();
                    }
                    return response()->json(['status' => 1, 'msg' => 'Thêm thành công']);
                }
            }
            return response()->json(['status' => 0, 'msg' => 'Thao tác thất bại']);
        }
    }

    public function search(Request $request)
    {
        $search = $request->search;

        if (!empty($search)) {
            $departments = Department::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($departments as $department) {
            $response[] = array("value" => $department->id, "label" => $department->name);
        }

        return response()->json($response);
    }

    public function searchUsers(Request $request)
    {
        $search = $request->search;

        if (!empty($search)) {
            $users = User::orderby('fullname', 'asc')->select('id', 'fullname', 'phone', 'gender')->where('fullname', 'like', '%' . $search . '%')->whereNull('department_id')->limit(5)->get();
        }

        $response = array();
        foreach ($users as $user) {
            $response[] = array("value" => $user->id, "label" => $user->fullname, 'phone' => $user->phone, 'gender' => $user->gender);
        }

        return response()->json($response);
    }

    public function user(Request $request)
    {
        $department = Department::with('users')->where('id', $request->id)->get();
        $department_parent = Department::with('users')->find($department[0] -> parent_id);
        $user_max = false;
        if(Auth::user() -> department_id == $department[0] -> id && $department[0] -> users[0] -> position_id == Auth::user() -> position_id){
            $user_max = true;
        }
        // if(Auth::user() -> id == $department[0] -> users[0] -> id){
        //     $user_max = true;
        // }
        // if($department[0] -> parent_id != null){
        //     if($department_parent -> users -> count() > 0){
        //         if($department_parent -> users[0] -> position_id == Auth::user() -> position_id){
        //             $user_max = true;
        //         }
        //     }
        // }
        
        $positions = Position::with('nominees')->get();
        return view('auth.department.user.index', compact('department', 'positions', 'user_max'));
    }

    public function addUser(Request $request)
    {
        if ($request->id) {
            $user = User::find($request->id);
            $user->department_id = $request->department_id;
            $user->position_id = 10;
            $user->nominee_id = 57;

            $user->nominee = nominee::find(57)->nominees;

            if ($user->save()) {
                return response()->json(['status' => 1, 'msg' => 'Thêm thành công']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Thêm thất bại']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Thêm thất bại']);
        }
    }

    public function deleteUser(Request $request)
    {
        if ($request->id) {
            $user = User::findOrFail($request->id);
            if ($user) {
                $user->department_id = NULL;
                $user->save();
                return response()->json(['status' => 1, 'msg' => 'Xóa thành công']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Xóa thất bại']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Xóa thất bại']);
        }
    }
    public function updateUser(Request $request)
    {
        if ($request->id) {
            $user = User::find($request->id);
            $user->position_id = $request->position_id;
            $user->nominee_id = $request->nominee_id;
            $user -> level_department = $request -> level;
            $user->nominee = nominee::find($request->nominee_id)->nominees;
            if ($user->save()) {
                return response()->json(['status' => 1, 'msg' => 'Sửa thành công']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Sửa thất bại']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Sửa thất bại']);
        }
    }

    public function get_users(Request $request)
    {
        if ($request->id) {
            $user_max = $request -> user_max;
            $positions = Position::with('nominees')->get();
            $users = User::with('position')->where('department_id', $request->id)->get();
            return view('auth.department.user.data', compact('users', 'positions', 'user_max'));
        }
    }

    public function display($id)
    {
        $department = Department::find($id);
        return response()->json($department);
    }

    public function filter(Request $request)
    {
        $status = $request->status ?? '';
        $per_page = $request->per_page ?? 5;
        $name = $request->name ?? '';
        $datetime = $request->datetime ?? date('Y-m-d H:i:s');

        $departments = Department::where([
            ['status', 'like', '%' . $status . '%'],
            ['name', 'like', '%' . $name . '%']
        ])->whereDate('created_at', '<=', $datetime)->orderby('id', 'desc')->paginate($per_page);
        return view('auth.department.data', compact('departments'));
    }

    public function delete(Request $request)
    {
        $department = Department::findOrFail($request->id);
        if ($department) {
            $department->delete();
            return response()->json(['status' => 1, 'msg' => 'Xóa thành công']);
        }
    }

    public function overview()
    {
        $departments = Department::with("users")->get()->toTree();
        return view('auth.department.overview', compact('departments'));
    }

    public function get_departments()
    {
        $departments = Department::paginate(5);
        return view('auth.department.data', compact('departments'));
    }
}
