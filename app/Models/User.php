<?php

namespace App\Models;

use App\Http\Controllers\AuthorizationController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\nominee;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'position_id',
        'department_id',
        'personnel_code',
        'nominee_id',
        'email',
        'password',
        'fullname',
        'phone',
        'date_of_birth',
        'about',
        'gender',
        'about',
        'status',
        'recruitment_date',
        'img_url',
        'autho',
        'level',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function nominees()
    {
        return $this->belongsTo(nominee::class);
    }
    public static function getallUser()
    {
        $user = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->select('users.*', 'nominees.nominees', 'departments.name');
        return $user->paginate(7);
    }
    public static function fillter_status($searchst)
    {
        $user = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->select('users.*', 'nominees.nominees', 'departments.name')
            ->where('users.status', '=', "$searchst");
        return $user->paginate(7);
    }

    public static function fillter_dp($searchdp)
    {
        $user = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->select('users.*', 'nominees.nominees', 'departments.name')
            ->where('users.department_id', '=', "$searchdp");
        return $user->paginate(7);
    }
    public static function getUserDetail($id)
    {
        $user = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->select('users.*', 'nominees.nominees', 'departments.name')
            ->where('users.id', '=', "$id");
        return $user->get();
    }
    public static function find_personnel_detail_equipment_by_id($id)
    {
        $user = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->select('users.*', 'nominees.nominees as chucvu', 'departments.name as phongban')
            ->find($id);
        // dd($user);
        if (empty($user->img_url)) {
            $user->img_url = 'avatar2.png';
        }
        if (empty($user->chucvu)) {
            $user->chucvu = 'Chưa có chức vụ';
        }
        if (empty($user->phongban)) {
            $user->phongban = 'Chưa có phòng ban';
        }
        return $user;
    }
    public static function interviewer($search)
    {
        $user = User::where('personnel_code', 'like', "%$search%")
            ->orWhere('fullname', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->Where('position_id', '<', 8)
            ->limit(5)->get();
        return $user;
    }
    public static function getAllUser_p_d()
    {
        $result = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->select('users.*', 'nominees.nominees', 'departments.name');
        return $result->paginate(7);
    }
    public static function search_user($search)
    {
        $result = User::where('personnel_code', 'like', "%$search%")
            ->orWhere('fullname', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->select('users.*', 'nominees.nominees', 'departments.name');
        return $result->paginate(7);
    }
    public static function search_user_autho($search)
    {
        $result = User::where('personnel_code', 'like', "%$search%")
            ->orWhere('fullname', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->leftjoin('authorities', 'users.autho', 'authorities.id')
            ->select('users.*', 'nominees.nominees', 'departments.name', 'authorities.name_autho');
        return $result;
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public static function getUsers()
    {
        $users = DB::table('users');
        return $users->paginate(7);
    }

    public static function build_autho_by_department($id)
    {
        $users = User::where('users.department_id', $id)
            ->leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->leftjoin('authorities', 'users.autho', 'authorities.id')
            ->select('users.*', 'nominees.nominees', 'departments.name', 'authorities.name_autho');
        return $users;
    }
    public static function build_autho()
    {
        $users = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->leftjoin('authorities', 'users.autho', 'authorities.id')
            ->select('users.*', 'nominees.nominees', 'departments.name', 'authorities.name_autho');
        // dd($users);
        return $users;
    }
    public static function getAll()
    {
        $users = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
            ->select('users.*', 'nominees.nominees', 'departments.name');
        return $users->paginate(7);
    }
    public static function UserBuild($nhansu)
    {
        $authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        $html = '
        <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã Nhân Sự</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ Tên</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Chức Vụ</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phòng Ban</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng Thái</th> 
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action</th>
                </tr>
            </thead>
            <tbody> ';

        if ($nhansu == null) {
            $html .= '<p>không có dữ liệu</p>';
        }

        foreach ($nhansu as $ns) {
            $html .= '
                    <tr>
                        <td class="">
                            <p class="text-sm font-weight-bold mb-0">' . $ns->personnel_code . '</p>
                        </td>
                        <td>
                            <div class="d-flex px-3 py-1">
                                <div>';
            if ($ns->img_url == '') {
                $ns->img_url = 'avatar2.png';
            }
            $html .= '<img src="./img/' . $ns->img_url . '" class="avatar me-3"
                                        alt="Avatar">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">' . $ns->fullname . '</h6>
                                </div>
                            </div>
                        </td>
                        <td><p class="text-sm font-weight-bold mb-0">' . $ns->email . '</p></td>
                        <td>';
            if ($ns->nominee_id == '') {
                $html .= '<p class="text-sm font-weight-bold  mb-0" >Chưa có chức vụ</p> ';
            } else {
                $html .= '<p class="text-sm font-weight-bold  mb-0" >' . $ns->nominees . '</p> ';
            }
            $html .= '</td>
                      <td class="align-middle text-center text-sm">';
            if (!$ns->name == '') {
                $html .= '<p class="text-sm font-weight-bold mb-0">' . $ns->name . '</p>';
            } else {
                $html .= '<p class="text-sm font-weight-bold mb-0">Chưa vào phòng ban</p>';
            }
            $html .= ' </td>
                        <td class="align-middle text-center text-sm"> ';
            if ($ns->status === 0) {
                $html .= '<span class ="badge badge-sm bg-gradient-secondary">Chưa kích hoạt</span>';
            } else if ($ns->status === 1) {
                $html .= '<span class="badge badge-sm bg-gradient-success">Hoạt Động</span> ';
            } else if ($ns->status === 2) {
                $html .= '<span class="badge badge-sm bg-gradient-light">Nghỉ Phép</span> ';
            } else if ($ns->status === 3) {
                $html .= '<span class="badge badge-sm bg-gradient-danger">Khoá</span> ';
            } else if ($ns->status === 4) {
                $html .= '<span class="badge badge-sm bg-gradient-danger">Nghỉ Việc</span> ';
            } else {
                $html .= '<span class="badge badge-sm bg-gradient-warning">Không xác định</span> ';
            }
            $html .= '</td>';
            $html .= '<td class="align-middle text-end">
                        <div class="d-flex px-3 py-1 justify-content-center align-items-center"> ';
            if ($authentication->personnel->delete_personnel === "true") {
                $html .= '|<a class="text-sm font-weight-bold mb-0 " id="btn-del" onclick="onDelete(' . $ns->id . ')">Xóa</a> ';
            }
            if ($authentication->personnel->update_personnel) {
                $html .= '   | <a id="btn-edit" data-bs-toggle="offcanvas" onclick="getdetail(' . $ns->id . ')" data-pos="' . $ns->position_id . '" data-bs-target="#offcanvasNavbarupdate" class="text-sm font-weight-bold mb-0 ps-2">Sửa</a>';
            }
            $html .= '     | <a id="btn-edit" data-bs-toggle="offcanvas" onclick="getdetailview(' . $ns->id . ')" data-bs-target="#offcanvasNavbarupdate" class="text-sm font-weight-bold mb-0 ps-2">Xem</a> |';
            $html .= '</div>
                        </td>
                    </tr> ';
        }
        $html .= '
            </tbody>
        </table>
        ' . $nhansu->links() . '
    </div> ';
        return $html;
    }

    public static function Autho_Build($nhansu)
    {
        $index = 0;
        $html = '<div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"> Mã Nhân Sự</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ Tên</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chức Vụ</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Phòng Ban</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Nhóm quyền hiện tại</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  ps-1">Cấp Quyền</th>
                            </tr>
                        </thead>
                        <tbody>';
        // if (empty($nhansu)) {
        //     $html .= '<tr><td><p>không có dữ liệu</p></td></tr>';
        // } else {
        foreach ($nhansu as $ns) {
            if (empty($ns->name_autho)) {
                $ns->name_autho = 'Chưa có nhóm quyền';
            }
            if (empty($ns->name)) {
                $ns->name = 'Chưa vào phòng ban';
            }
            if (empty($ns->nominees)) {
                $ns->nominees = 'Chưa thêm chức vụ';
            }
            if ($ns->img_url == '') {
                $ns->img_url = 'avatar2.png';
            }
            $index = $index + 1;
            $html .= '<tr>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">' . $ns->personnel_code . '</p>
                        </td>
                        <td>
                            <div class="d-flex px-3 py-1">
                                <div>';
            $html .= '  <img src="./img/' . $ns->img_url . '" class="avatar me-3" alt="Avatar">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">' . $ns->fullname . '</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">' . $ns->email . '</p>
                        </td>';
            $html .= '<td><p class="text-sm font-weight-bold mb-0">' . $ns->nominees . '</p></td>';

            $html .= '<td><p class="text-sm font-weight-bold mb-0 ">' . $ns->name . '</p></td>';
            $html .= '<td><p class="text-sm font-weight-bold mb-0 text-center">' . $ns->name_autho . '</p></td>';
            $html .= ' <td>
                            <div class="form-check justify-content-center">
                                <input class="form-check-input set_role_user " id="table_user_col_' . $index . '" style="margin-left:10%;" type="checkbox" data-user="' . $ns->id . '">
                            </div>
                        </td>
                    </tr>';
        }
        $html .= '</tbody>
                    </table>
                        <div class="row"> 
                            <div class="col-11">' . $nhansu->links() . '</div>
                            <div class="col-1">
                                <div class="form-group">
                                    <select class="form-control "id="count_result_autho">
                                        <option value="7">7 Kết Quả</option>
                                        <option value="10">10 Kết Quả</option>
                                        <option value="20">20 Kết Quả</option>
                                        <option value="50">50 Kết Quả</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>';
        return $html;
    }
    public static function build_personnel_in_equipment($personnel)
    {
        $html = '<div class="table-responsive p-0 box-shadow-items p-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-0">Mã Nhân Sự</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ Tên </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chức Vụ</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phòng Ban</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($personnel as $item) {
            if (empty($item->nominees)) {
                $item->nominees = 'Chưa thêm chức vụ';
            }
            if (empty($item->name)) {
                $item->name = 'Chưa vào phòng ban';
            }
            if ($item->img_url == '') {
                $item->img_url = 'avatar2.png';
            }
            $html .= '<tr>
                    <td class="">
                        <p class="text-sm font-weight-bold mb-0">' . $item->personnel_code . '</p>
                    </td>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <div>
                                <img src="./img/' . $item->img_url . '" class="avatar me-3"
                                    alt="Avatar">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $item->fullname . '</h6>
                            </div>
                        </div>
                    </td>
                    <td>' . $item->nominees . '</td>
                    <td>' . $item->name . '</td>
                    <td class="text-center"><a href="" id="view-equipment-personnel" class="font-weight-bold" data-bs-toggle="modal" onclick="find_personnel_in_Equipment(' . $item->id . ')" data-bs-target="#profile-handing-over">Xem</a></td>
                </tr>';
        }
        $html .= '</tbody>
            </table>
            ' . $personnel->links() . '
        </div>';
        return $html;
    }
}
