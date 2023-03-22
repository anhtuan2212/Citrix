<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthoInsertRequest;
use App\Models\Authority;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    protected $autho;

    function index(Request $request)
    {
        // check quyền truy cập trang của user đăng nhập
        $this->authorize("authentication", Auth::user());

        if ($request->ajax()) {
            $body = Authority::paginate(7);
            if (empty($request->size)) {
                $user = User::build_autho()->paginate(config('const.AUTHO.PAGE_SIZE_AUTHO'));
            } else {
                $user = User::build_autho()->paginate($request->size);
            }
            $use = User::Autho_Build($user);
            $count = count($user);
            return response()->json(['status' => 'success', 'body' => $body, 'location' => 'auth', 'count' => $count, 'table_user' => $use]);
        }
        $authos = Authority::paginate(7);
        $authority = Authority::all();
        $users = User::build_autho()->paginate(config('const.AUTHO.PAGE_SIZE_AUTHO'));
        $departments = Department::all();
        return view('pages.authorization', compact('authos', 'departments', 'authority', 'users'));
    }
    function set_page_size_autho(Request $request)
    {
        // dd($request);
        if ($request->count > 100) {
            return response()->json(['status' => 'success', 'message' => 'Số lượng yêu cầu lớn hơn mức cho phép !']);
        }
        if (empty($request->search_autho) && !empty($request->department_auth)) {
            $users = User::build_autho_by_department($request->department_auth)->paginate($request->count);
        } else if (!empty($request->search_autho) && $request->department_auth === 0) {
            $users = User::search_user_autho($request->search)->paginate($request->count);
        } else {
            $users = User::build_autho()->paginate($request->count);
        }
        // dd($users);
        $use = User::Autho_Build($users);
        return response()->json(['status' => 'success', 'table_user' => $use, 'page_size' => $request->count]);
    }
    function get_user_by_department(Request $request)
    {
        if ($request->id == 0) {
            $users = User::build_autho()->paginate(config('const.AUTHO.PAGE_SIZE_AUTHO'));
        } else {
            $users = User::build_autho_by_department($request->id)->paginate(config('const.AUTHO.PAGE_SIZE_AUTHO'));
        }
        $data = User::Autho_Build($users);
        return response()->json(['status' => 'success', 'location' => 'auth', 'table_user' => $data]);
    }
    function search_autho(Request $request)
    {
        if (empty($request->search)) {
            if (empty($request->count)) {
                $user = User::build_autho()->paginate(config('const.AUTHO.PAGE_SIZE_AUTHO'));
            } else {
                $user = User::build_autho()->paginate($request->count);
            }
        } else {
            if (empty($request->count)) {
                $user = User::search_user_autho($request->search)->paginate(config('const.AUTHO.PAGE_SIZE_AUTHO'));
            } else {
                $user = User::search_user_autho($request->search)->paginate($request->count);
            }
        }
        $data = User::Autho_Build($user);
        return response()->json(['status' => 'success', 'location' => 'auth', 'table_user' => $data, 'count' => $request->count]);
    }
    function set_autho_for_user(Request $request)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->authority === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể cấp quyền !']);
        }
        foreach ($request->arr_user as $item) {
            $users = User::find($item);
            $users->autho = $request->id_autho;
            $users->save();
        }
        return  response()->json(['status' => 'success', 'message' => 'Cấp quyền thành công !']);
    }
    function recall_autho_user(Request $request)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->authority === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể thu hồi do không đủ quyền !']);
        }
        $a = null;
        foreach ($request->arr_user as $item) {
            $users = User::find($item);
            $users->autho = $a;
            $users->save();
        }
        return  response()->json(['status' => 'success', 'message' => 'Thu hồi thành công !']);
    }
    function save(AuthoInsertRequest $request)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->authority === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể thu hồi do không đủ quyền !']);
        }
        if (empty($request->id)) {
            $autho = new Authority();
            $request->validate([
                'autho_name' => 'unique:authorities,name_autho'
            ], [
                'autho_name.unique' => 'Tên nhóm quyền đã tồn tại !'
            ]);
        } else {
            $autho = Authority::find($request->id);
            if ($request->autho_name !== $autho->name_autho) {
                $request->validate([
                    'autho_name' => 'unique:authorities,name_autho'
                ], [
                    'autho_name.unique' => 'Tên nhóm quyền đã tồn tại !'
                ]);
            }
        }
        $autho->name_autho = $request->autho_name;

        if (
            $request->accept_cv_autho == "true" ||
            $request->delete_personnel == "true" ||
            $request->eva_cv_autho == "true" ||
            $request->inter_cv_autho == "true" ||
            $request->offer_cv_autho == "true" ||
            $request->update_cv_autho == "true" ||
            $request->insert_personnel == "true" ||
            $request->faild_inter_autho == "true" ||
            $request->faild_cv_autho == "true" ||
            $request->update_personnel == "true"
        ) {
            $personnel = [
                'personnel_autho_access' => "true",
                'insert_personnel' => $request->insert_personnel,
                'update_personnel' => $request->update_personnel,
                'delete_personnel' => $request->delete_personnel,
                'accept_cv_autho' => $request->accept_cv_autho,
                'update_cv_autho' => $request->update_cv_autho,
                'inter_cv_autho' => $request->inter_cv_autho,
                'eva_cv_autho' => $request->eva_cv_autho,
                'offer_cv_autho' => $request->offer_cv_autho,
                'faild_cv_autho' => $request->faild_cv_autho,
            ];
        } else {
            $personnel = [
                'personnel_autho_access' => $request->personnel_autho_access,
                'insert_personnel' => $request->insert_personnel,
                'update_personnel' => $request->update_personnel,
                'delete_personnel' => $request->delete_personnel,
                'accept_cv_autho' => $request->accept_cv_autho,
                'update_cv_autho' => $request->update_cv_autho,
                'inter_cv_autho' => $request->inter_cv_autho,
                'eva_cv_autho' => $request->eva_cv_autho,
                'offer_cv_autho' => $request->offer_cv_autho,
                'faild_cv_autho' => $request->faild_cv_autho,
            ];
        }

        $autho->authority = json_encode($request->authority);
        $autho->personnel = json_encode($personnel);
        $autho->departments = 'null';
        $autho->equipment = 'null';
        $autho->save();
        return response()->json(['status' => 'success']);
    }
    public function getAutho_Detail_By_Id(Request $request)
    {
        $body = Authority::find($request->id);
        $body->personnel = json_decode($body->personnel);
        $body->authority = json_decode($body->authority);
        return response()->json(['status' => 'success', 'body' => $body]);
    }
    public function getAll_autho()
    {
        $authority = Authority::all();
        return response()->json(['status' => 'success', 'body' => $authority]);
    }
    public function delete(Request $request)
    {
        $user = User::where('autho', $request->id)->get();
        if (count($user) !== 0) {
            return response()->json(['status' => 'error', 'message' => 'Có nhân sự đang sử dụng quyền này !']);
        }
        $body = Authority::find($request->id);
        $body->delete();
        return response()->json(['status' => 'success', 'body' => $body]);
    }
}
