<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CurriculumVitae extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'name',
        'phone',
        'date_of_birth',
        'position_id',
        'nominee',
        'gender',
        'address',
        'status', // 0 default | 1 faild cv | 2 pass cv or đợi xếp lịch pv  | 4 đã xếp lịch phỏng vấn | 5 phỏng vấn faild | 6 pv Pass | 7 no nhận ofer | 8 chuyển sang thử việc 
        'point',
        'offer',
        'note',
        'url_cv',
        'created_at',
        'updated_at',
        'interview_id',
    ];
    public static function get_All_CV_UT()
    {
        $cv = CurriculumVitae::where('status', '=', 0)->orWhere('status', '=', 1)->orWhere('status', '=', 2)
            ->leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->select('curriculum_vitaes.*', 'nominees.nominees');
        return $cv->paginate(12);
    }
    public static function fillter_cv($search)
    {
        $cv = CurriculumVitae::leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->select('curriculum_vitaes.*', 'nominees.nominees')
            ->where('status', '=', "$search");
        return $cv->paginate(12);
    }
    public static function search_cv($search)
    {
        $cv = CurriculumVitae::where('curriculum_vitaes.status', '<', 3)
            ->where('curriculum_vitaes.name', 'like', "%$search%")
            // ->orWhere('curriculum_vitaes.email', 'like', "%$search%")
            ->leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->select('curriculum_vitaes.*', 'nominees.nominees')
            ->paginate(12);
        return $cv;
    }
    public static function getCVByID($id)
    {
        $cv = CurriculumVitae::join('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->join('positions', 'curriculum_vitaes.position_id', 'positions.id')
            ->select('curriculum_vitaes.*', 'nominees.nominees', 'positions.position')->where('curriculum_vitaes.id', '=', "$id")->get();
        return $cv;
    }
    public static function search_offer($search)
    {
        $cv = CurriculumVitae::where('curriculum_vitaes.name', 'like', "%$search%")
            ->orWhere('curriculum_vitaes.email', 'like', "%$search%")
            ->where('curriculum_vitaes.status', '>', 2)
            ->leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->leftjoin('interviews', 'curriculum_vitaes.interview_id', 'interviews.id')
            ->orderBy('interviews.interview_date')->orderBy('interviews.interview_time')
            ->select('curriculum_vitaes.*', 'nominees.nominees', 'interviews.interview_date', 'interviews.interview_time', 'interviews.interviewer1', 'interviews.interviewer2');
        return $cv->paginate(12);
    }
    public static function fillter_offer($search)
    {
        $cv = CurriculumVitae::where('curriculum_vitaes.status', '=', "$search")
            ->leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->leftjoin('interviews', 'curriculum_vitaes.interview_id', 'interviews.id')
            ->orderBy('interviews.interview_date')->orderBy('interviews.interview_time')
            ->select('curriculum_vitaes.*', 'nominees.nominees', 'interviews.interview_date', 'interviews.interview_time', 'interviews.interviewer1', 'interviews.interviewer2')
            ->paginate(12);
        return $cv;
    }
    public static function find_interview($id)
    {
        $inter = CurriculumVitae::where('curriculum_vitaes.id', '=', "$id")
            ->leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->leftjoin('interviews', 'curriculum_vitaes.interview_id', 'interviews.id')
            ->select('curriculum_vitaes.*', 'nominees.nominees', 'interviews.interviewer1', 'interviews.interviewer2')->get();
        return $inter;
    }
    public static function get_All_Cv_PV()
    {
        $cv = CurriculumVitae::where('curriculum_vitaes.status', '>', 2)
            ->leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->leftjoin('interviews', 'curriculum_vitaes.interview_id', 'interviews.id')
            ->orderBy('interviews.interview_date')->orderBy('interviews.interview_time')
            ->select('curriculum_vitaes.*', 'nominees.nominees', 'interviews.interview_date', 'interviews.interview_time', 'interviews.interviewer1', 'interviews.interviewer2');

        return $cv->paginate(12);
    }
    public static function get_All_Cv_Pass()
    {
        $cv = CurriculumVitae::where('status', '=', 2)
            ->leftjoin('nominees', 'curriculum_vitaes.nominee', 'nominees.id')
            ->select('curriculum_vitaes.*', 'nominees.nominees');
        return $cv->paginate(12);
    }

    public static function UTBuild($cvs)
    {
        $authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        $html = '<div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên Ứng Viên</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số Điện Thoại</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vị Trí Ứng Tuyển</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng Thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
        if ($cvs == null) {
            $html .= '<p>không có dữ liệu</p>';
        }
        foreach ($cvs as $cv) {
            $html .= '<tr>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->name . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->email . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->phone . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->nominees . '</p></td>
                        <td class="text-center">';

            if ($cv->status == 0) {
                $html .= ' <p class="badge bg-gradient-secondary" style="margin-bottom: -100%;">Chưa Duyệt</p>';
            } else if ($cv->status == 2) {
                $html .= ' <p class="badge bg-gradient-success" style="margin-bottom: -100%;">Đã Duyệt</p>';
            } else if ($cv->status == 1) {
                $html .= ' <p class="badge bg-gradient-danger" style="margin-bottom: -100%;">Từ Chối</p>';
            }

            $html .= '  </td>
                        <td class="text-center">';
            if ($authentication->personnel->accept_cv_autho === "true") {
                if ($cv->status == 0) {
                    $html .= '| <a id="btn-edit" data-bs-toggle="offcanvas"  data-bs-target="#offcanvasNavbarevaluatecv" onclick="get_CV_By_ID_eva(' . $cv->id .
                        ')" class="text-sm font-weight-bold mb-0 ps-2">Duyệt</a> |';
                }
            }
            if ($authentication->personnel->inter_cv_autho === "true") {
                if ($cv->status == 2) {
                    $html .= '| <a id="btn_interview_in_table" data-bs-toggle="offcanvas" code="' . $cv->id . '" data-bs-target="#offcanvasNavbarphongvan" onclick="get_cv_by_Id(' . $cv->id . ')"  style="cursor: pointer" class="text-sm font-weight-bold mb-0 ps-2">Xếp Lịch</a>';
                }
            }
            if ($authentication->personnel->update_cv_autho === "true") {
                $html .= '   |<a id="btn-edit" data-bs-toggle="offcanvas"  data-bs-target="#offcanvasNavbareditcv" data-pos="' . $cv->position_id . '" onclick="get_CV_By_ID_edit(' . $cv->id .
                    ')" class="text-sm font-weight-bold mb-0 ps-2">Sửa</a> |
                           </td>';
            }


            $html .= ' </tr>';
        }

        $html .= '   </tbody>
                </table>
                     ' . $cvs->LINKS() . '
            </div>';
        return $html;
    }
    public static function XDBuild($cvs)
    {
        $authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        $html = '<div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên Ứng Viên</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vị Trí Ứng Tuyển</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày Phỏng Vấn</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giờ Phỏng Vấn</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người Phỏng Vấn 1</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người Phỏng Vấn 2</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng Thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
        if ($cvs == null) {
            $html .= '<p>không có dữ liệu</p>';
        } else {
            # code...

            foreach ($cvs as $cv) { #
                $user_name1 = User::select('fullname')->where('id', $cv->interviewer1)->first()->fullname;
                $user_name2 = User::select('fullname')->where('id', $cv->interviewer2)->first()->fullname;
                $html .= '<tr>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->name . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->email . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->nominees . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->interview_date . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">' . $cv->interview_time . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0" style="text-align: center;">' . $user_name1 . '</p></td>
                        <td><p class="text-sm font-weight-bold mb-0"style="text-align: center;">' . $user_name2 . '</p></td>';
                if ($cv->status === 3) {
                    $html .= '<td><p class="badge bg-gradient-primary" style="margin-bottom: -100%;">Đang đánh giá</p></td>';
                } else if ($cv->status === 4) {
                    $html .= '<td><p class="badge bg-gradient-secondary" style="margin-bottom: -100%;">Đang offer</p></td>';
                } else if ($cv->status === 5) {
                    $html .= '<td><p class="badge bg-gradient-success" style="margin-bottom: -100%;">Đã Offer</p></td>';
                } else if ($cv->status === 6) {
                    $html .= '<td><p class="badge bg-gradient-danger" style="margin-bottom: -100%;">Từ Chối</p></td>';
                }
                $html .= ' <td>';
                if ($cv->status == 3) {
                    if ($authentication->personnel->eva_cv_autho === 'true') {
                        $html .= '<p class="text-sm font-weight-bold mb-0" style="cursor: pointer" data-bs-toggle="offcanvas" onclick="find_interview(' . $cv->id . ')"  data-bs-target="#offcanvasNavbarInterview">Đánh Giá</p>';
                    }
                } else if ($cv->status == 4 || $cv->status == 5) {
                    if ($authentication->personnel->offer_cv_autho === 'true') {
                        $html .= '<p class="text-sm font-weight-bold mb-0" style="cursor: pointer" data-bs-toggle="offcanvas" onclick=" find_offer(' . $cv->id . ')"  data-bs-target="#offcanvasNavbarOffer">Offer</p>';
                    }
                } else if ($cv->status == 6) {
                    $html .= '<p class="text-sm font-weight-bold mb-0" style="cursor: pointer" data-bs-toggle="offcanvas" onclick=" find_offer(' . $cv->id . ')"  data-bs-target="#offcanvasNavbarOffer">Xem</p>';
                }

                $html .= ' </td></tr>';
            }
        }

        $html .= '   </tbody>
                </table>
                     ' . $cvs->LINKS() . '
            </div>';
        return $html;
    }
}
