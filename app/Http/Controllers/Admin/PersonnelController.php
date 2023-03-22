<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddInterviewRequest;
use App\Http\Requests\saveCV;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\updateCVRequest;
use App\Http\Requests\updateInterviewRequest;
use App\Http\Requests\updateUserRequest;
use App\Jobs\SendMailJob;
use App\Mail\PassCV_FaildInter;
use App\Mail\PersonnelAcceptMailer;
use App\Mail\PersonnelFaildCVMailer;
use App\Mail\Send_Offer;
use App\Models\Authority;
use App\Models\CurriculumVitae;
use App\Models\Department;
use App\Models\EquipmentDetail;
use App\Models\interview;
use App\Models\nominee;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\PseudoTypes\IntegerRange;

class PersonnelController extends Controller
{


    public function index(Request $rq)
    {
        //check quyền truy cập trang của user đang đăng nhập
        $this->authorize("personnel", Auth::user());
        //active new user
        if (Auth::user()->status == 0) {
            $user = User::find(Auth::user()->id);
            $user->status = 1;
            $user->save();
        }
        //truy vấn từ ajax
        if ($rq->ajax()) {
            $data = User::getAll();
            $body = User::UserBuild($data);
            return response()->json(['body' => $body]);
        };

        //lấy số lượng có trong db
        $ucount = User::all()->count();
        $xdcount = CurriculumVitae::where('status', '=', 3)->count();
        $cvcount = CurriculumVitae::where('status', '=', 0)->orWhere('status', '=', 1)->orWhere('status', '=', 2)->count();
        // lấy tất cả phòng ban
        $phongbans = Department::all();
        //lấy tất cả chức vụ
        $postions = Position::all();
        //build table CV
        $cvs = CurriculumVitae::get_All_CV_UT();
        $cvut = CurriculumVitae::UTBuild($cvs);
        $authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        $authority = Authority::all();
        $nhansu = User::getAll();
        return view('pages.personnel.personnel', compact('phongbans', 'authority', 'authentication', 'postions', 'nhansu', 'xdcount', 'cvcount', 'cvs', 'ucount',));
    }

    //====================PERSONNEL====================================
    public function edit(Request $rq)
    {
        //get user by id , response to form update
        $id = $rq->id;
        $personneldetail = User::find($id);
        return response()->json(['status' => 'success', 'data' => $personneldetail]);
    }
    //update user
    public function update(updateUserRequest $request)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->personnel->update_personnel === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể sửa do không đủ quyền !']);
        }
        $user = User::findOrFail($request->id);
        //check tuổi
        $age = floor((time() - strtotime($request->date_of_birth)) / 31556926);
        if ($age < 15) {
            return response()->json(['status' => 'error', 'message' => 'Tuổi của nhân sự phải lớn hơn 15 !']);
        }
        //check email
        if ($user->email !== $request->email) {
            $request->validate([
                'email' => 'unique:users,email'
            ], [
                'email.unique' => 'Email đã tồn tại !'
            ]);
        }

        if (!$request->img_url == '') {
            $fileName = time() . '.' . $request->img_url->extension();
            $request->img_url->move(public_path('img'), $fileName);
            $user->img_url = $fileName;
        }
        $user->autho = $request->autho_roles_ud;
        $user->gender = $request->gender;
        $user->about = $request->about;
        $user->nominee_id = $request->nominee_bild;
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        $user->date_of_birth = $request->date_of_birth;
        $user->position_id = $request->position_id;
        $user->recruitment_date = $request->recruitment_date;
        if ($request->status == 3 | $request->status == 4) {
            $request->validate(
                [
                    'about' => 'required|min:5|max:1000'
                ],
                [
                    'about.required' => 'Để đổi sang trạng thái này, bạn vui lòng nhập lý do !',
                    'about.min' => 'Lý do quá ngắn !',
                    'about.max' => 'Lý do quá dài !',
                ]
            );
        }
        $user->status = $request->status;
        $user->address = $request->address;
        $user->save();
        $nhansu2 = User::getAll();
        $body = User::UserBuild($nhansu2);
        return response()->json(['status' => 'succes', 'body' => $body]);
    }
    public function get_all_personnel_in_equipment()
    {
        $personnel = User::getAll();
        $build = User::build_personnel_in_equipment($personnel);
        return  response()->json(['status' => 'success', 'location' => 'personnel_in_equipment', 'body' => $build]);
    }

    //lấy sản phẩm theo mã nhân sự
    public function get_personnel_detail_equipment(Request $request)
    {
        $pn = User::find_personnel_detail_equipment_by_id($request->id);
        return response()->json(['status' => 'success', 'data' => $pn]);
    }

    // public function update_level(Request $request)
    // {

    //     $user = User::find($request->id);
    //     if ($request->id == Auth::user()->id) {
    //         return response()->json(['status' => 'error', 'message' => 'Bạn không thể đổi quyền của chính bạn !']);
    //     }
    //     if (!Auth::user()->level == 2) {
    //         return response()->json(['status' => 'error', 'message' => 'Bạn không đủ thẩm quyền !']);
    //     }

    //     $user->level = $request->level;
    //     $user->save();
    //     return response()->json(['status' => 'success', 'message' => 'Thay đổi đã được áp dụng !']);
    // }

    //xóa user
    public function destroy(Request $rq)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->personnel->delete_personnel === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể xóa do không đủ quyền !']);
        }
        //check user
        $id = $rq->input('count_type');
        $userDelete = Auth::user()->id;
        if ($userDelete == $id) {
            return response()->json(['status' => 'error', 'message' => 'Bạn không thể xoá chính bạn !']);
        } else {
            //delete user by id
            $id = $rq->input('count_type');
            $nhansu =  User::find($id);
            $nhansu->delete();
            $nhansu2 = User::getAll();
            $body = User::UserBuild($nhansu2);
            return response()->json(['body' => $body]);
        }
    }


    public function search(Request $request)
    {
        //search by personnel_code , fullname and email
        $search = $request->search;
        if ($search == '') {
            $result = User::getAllUser_p_d();
            $body = User::UserBuild($result);
            return response()->json(['body' => $body]);
        } else {
            $result = User::search_user($search);
            $body = User::UserBuild($result);
            return response()->json(['body' => $body]);
        }
    }

    //xếp lịch
    public function Add_interview(AddInterviewRequest $request)
    {
        //check level
        $level1 = Auth::user()->level;
        if ($request->interviewer1 == $request->interviewer2) {
            return response()->json(['status' => 'error', 'message' => '2 người phỏng vấn phải khác nhau !']);
        }
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->personnel->inter_cv_autho === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể xếp lịch do không đủ quyền !']);
        }
        //check date
        $daterq = $request->interview_date;
        $now = Carbon::now();
        if ($daterq <= $now) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng chọn lịch phỏng vấn phù hợp !']);
        }
        //check cv
        $cv = CurriculumVitae::find($request->id_cv);
        if (!empty($cv->interview_id)) {
            return response()->json(['status' => 'error', 'message' => 'Ứng viên này đã được xếp lịch !']);
        }
        if ($cv->status !== 2) {
            return response()->json(['status' => 'error', 'message' => 'Ứng viên này không thể xếp lịch !']);
        }
        //check date 
        $user1 = interview::find($request->interviewer1);

        if (!empty($user1)) {
            $date1 = $user1->interview_date;
            $time1 = $user1->interview_time;
            if ($date1 == $request->interview_date && $time1 == $request->interview_time) {
                return response()->json(['status' => 'error', 'message' => 'Người phỏng vấn đã có lịch vào thời gian này !']);
            }
        }
        $interview = new interview();
        $interview->interviewer1 = $request->interviewer1;
        $interview->interviewer2 = $request->interviewer2;
        $interview->interview_date = $request->interview_date;
        $interview->interview_time = $request->interview_time;
        $interview->cate_inter = $request->cate_inter;
        $interview->location = $request->location;
        $interview->status = 1;
        $interview->save();
        $id_inter = interview::select('id')->orderBy('id', 'DESC')->first()->id;
        $cv->interview_id = $id_inter;
        $cv->status = 3;
        $cv->save();
        $sendMail = new SendMailJob($cv->id, 2);
        dispatch($sendMail);
        return response()->json(['status' => 'success', 'message' => 'Xếp Lịch Thành Công !']);
    }

    //auto search
    public function search_interviewer(Request $request)
    {
        $search = $request->search;
        if (!empty($search)) {
            $result = User::interviewer($search);
        }
        $response = array();
        foreach ($result as $result) {
            $response[] = array("value" => $result->id, "label" => $result->fullname);
        }

        return response()->json($response);
    }

    //thêm nhân sự mới (Ứng viên chấp nhận offer)
    public function add_new_user(Request $request)
    {
        $user = CurriculumVitae::find($request->id);
        $max = User::orderBy('id', 'DESC')->first();
        $new_user = new User();
        $new_user->personnel_code = 'SCN' . $max->id + 1;
        $new_user->email = $user->email;
        $new_user->password = $new_user->personnel_code;
        $new_user->fullname = $user->name;
        $new_user->phone = $user->phone;
        $new_user->date_of_birth = $user->date_of_birth;
        $new_user->status = 0;
        $new_user->recruitment_date = Carbon::now();
        $new_user->position_id = $user->position_id;
        $new_user->nominee_id = $user->nominee;
        $new_user->save();
        $user->delete();
        return response()->json(['status' => 'success', 'message' => 'Đã Thêm Nhân Sự Mới !']);
    }

    public function find_interviewer(Request $request)
    {
        $inter = CurriculumVitae::find_interview($request->id);
        $user1 = User::find($inter[0]->interviewer1);
        $user2 = User::find($inter[0]->interviewer2);
        return response()->json(['status' => 'success', 'body' => $inter, 'user1' => $user1, 'user2' => $user2]);
    }

    public function send_offer(Request $request)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->personnel->offer_cv_autho === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể gửi offer do không đủ quyền !']);
        }
        //send_offer
        $offer = CurriculumVitae::find($request->id);
        $offer->offer = $request->offer;
        if ($offer->status == 4) {
            $st = $offer->status;
            $offer->status = 1 + $st;
        }
        $id = $offer->id;
        $sendMail = new SendMailJob($id, 1);
        dispatch($sendMail);
        $offer->save();
        return response()->json(['status' => 'success', 'message' => 'Offer Thành Công !']);
    }

    //Xét Duyệt Ứng Viên
    public function update_xd_interview(updateInterviewRequest $request)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->personnel->eva_cv_autho === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể đánh giá ứng viên do không đủ quyền !']);
        }
        // check cv 
        $inter = CurriculumVitae::find($request->id);
        if ($inter->status != 3) {
            return response()->json(['status' => 'error', 'message' => 'Không thể đánh giá ứng viên này !']);
        }
        if (!empty($inter->point)) {
            return response()->json(['status' => 'error', 'message' => 'Ứng viên đã được đánh giá !']);
        }
        $inter->status = 4;
        $inter->note = $request->note;
        $inter->point = $request->point;
        $inter->save();
        return response()->json(['status' => 'success', 'message' => 'Đánh giá đã được lưu lại !']);
    }

    //fillter in user
    public function fillter(Request $request)
    {
        if (empty($request->status_filter) && empty($request->department_filter)) {

            $nhansu2 = User::getallUser();
            $body = User::UserBuild($nhansu2);
            return response()->json(['body' => $body]);
        } else  if (empty($request->department_filter)) {

            $searchst = $request->status_filter;
            $resultst = User::fillter_status($searchst);
            $body = User::UserBuild($resultst);
            return response()->json(['body' => $body]);
        } else if (empty($request->status_filter)) {

            $searchdp = $request->department_filter;
            $resultdp = User::fillter_dp($searchdp);
            $body = User::UserBuild($resultdp);
            return response()->json(['body' => $body]);
        } else {

            $searchst1 = $request->status_filter;
            $searchdp1 = $request->department_filter;
            $resultall = User::leftjoin('departments', 'users.department_id', 'departments.id')
                ->leftjoin('nominees', 'users.nominee_id', 'nominees.id')
                ->select('users.*', 'nominees.nominees', 'departments.name')
                ->where('users.department_id', '=', "$searchdp1")
                ->where('users.status', '=', "$searchst1")->paginate(7);
            $body = User::UserBuild($resultall);

            return response()->json(['body' => $body]);
        }
    }
    public function store(StorePostRequest $request)
    {
        $user = new User();
        $max = User::orderBy('id', 'DESC')->first();
        $user->personnel_code = 'SCN' . $max->id + 1;
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->address = $request->address;

        $user->save();

        $nhansu2 = User::getAll();
        $body = User::UserBuild($nhansu2);
        return response()->json(['status' => 'succes', 'body' => $body]);
    }
    //====================CV====================================

    public function fillter_cv(Request $request)
    {
        if ($request->status == 9) {
            $resultst = CurriculumVitae::get_All_CV_UT();
            $body = CurriculumVitae::UTBuild($resultst);
            return response()->json(['status' => 'succes', 'cvbody' => $body]);
        } else {
            $search = $request->status;
            $resultall = CurriculumVitae::fillter_cv($search);
            $body = CurriculumVitae::UTBuild($resultall);
            return response()->json(['status' => 'succes', 'cvbody' => $body]);
        }
    }
    public function fillter_offer(Request $request)
    {
        if ($request->status == 9) {
            $cvs = CurriculumVitae::get_All_Cv_PV();
            $cvut = CurriculumVitae::XDBuild($cvs);
            return response()->json(['status' => 'succes', 'cvbody' => $cvut]);
        } else {
            $search = $request->status;
            $resultall = CurriculumVitae::fillter_offer($search);
            $body = CurriculumVitae::XDBuild($resultall);
            return response()->json(['status' => 'succes', 'cvbody' => $body]);
        }
    }
    //search cv
    public function search_cv(Request $request)
    {
        $search = $request->search;
        if (empty($search)) {
            //search by fullname and email
            $result = CurriculumVitae::get_All_CV_UT();
            $body = CurriculumVitae::UTBuild($result);
            return response()->json(['status' => 'succes', 'cvbody' => $body]);
        } else {
            //search by fullname and email
            $result = CurriculumVitae::search_cv($search);
            $body = CurriculumVitae::UTBuild($result);
            return response()->json(['status' => 'succes', 'cvbody' => $body]);
        }
    }
    //search offer
    public function search_offer(Request $request)
    {
        $search = $request->search;
        if (empty($search)) {
            $cvs = CurriculumVitae::get_All_Cv_PV();
            $cvut = CurriculumVitae::XDBuild($cvs);
            return response()->json(['status' => 'succes', 'cvbody' => $cvut]);
        } else {
            //search by name and email
            $result = CurriculumVitae::search_offer($search);
            $body = CurriculumVitae::XDBuild($result);
            return response()->json(['status' => 'succes', 'cvbody' => $body]);
        }
    }

    public function get_cv_update(Request $request)
    {
        $cv = CurriculumVitae::find($request->id);
        return response()->json(['status' => 'success', 'body' => $cv]);
    }
    public function update_cv(Request $request)
    {
        // dd($request);
    }
    public function getcount()
    {
        //lấy số lượng nhân sự có trong db
        $ucount = User::all()->count();
        $xdcount = CurriculumVitae::where('status', '>', 2)->count();
        $cvcount = CurriculumVitae::where('status', '=', 0)->orWhere('status', '=', 1)->orWhere('status', '=', 2)->count();
        return response()->json(['status' => 'success', 'user_count' => $ucount, 'cv_xd_count' => $xdcount, 'cv_uv_count' => $cvcount]);
    }
    public function update_status_cv(Request $request)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->personnel->faild_cv_autho === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể từ chối do không đủ quyền !']);
        }

        $cv = CurriculumVitae::find($request->id);
        if ($cv->status > 2) {
            $cv->status = 6;
            $cv->save();
            $sendMail = new SendMailJob($cv->id, 4);
            dispatch($sendMail);
            return response()->json(['status' => 'succes', 'message' => 'Ứng viên đã được từ chối !']);
        }
        if ($cv->status == 1) {
            return response()->json(['status' => 'error', 'message' => 'CV đã bị từ chối trước đó !']);
        } else if ($cv->status == 2) {
            return response()->json(['status' => 'error', 'message' => 'CV đã được duyệt trước đó !']);
        }

        if ($request->status == 1) {
            $cv->note = $request->note;
            $request->validate(
                [
                    'note' => 'required|min:5|max:1000'
                ],
                [
                    'note.required' => 'Để từ chối cv này, bạn vui lòng nhập lý do !',
                    'note.min' => 'Lý do quá ngắn !',
                    'note.max' => 'Lý do quá dài !',
                ]
            );
        }

        $cv->status = $request->status;
        if ($cv->status == 1) {
            $message = 'CV đã được từ chối !';
        } else if ($cv->status == 2) {
            $message = 'CV đã duyệt thành công !';
        }
        $cv->save();
        $id = $cv->id;
        if ($cv->status == 1) {
            $sendMail = new SendMailJob($id, 3);
            dispatch($sendMail);
        }
        return response()->json(['status' => 'succes', 'message' => $message]);
    }
    public function getCVbyID(Request $request)
    {
        $cv = CurriculumVitae::getCVByID($request->id);
        return response()->json(['status' => 'succes', 'body' => $cv]);
    }
    public function getAllCVT()
    {
        $cvs = CurriculumVitae::get_All_CV_UT();
        $cvut = CurriculumVitae::UTBuild($cvs);
        return response()->json(['location' => 'curriculumvitae', 'status' => 'succes', 'cvbody' => $cvut]);
    }
    public function getAllInter()
    {
        $cvs = CurriculumVitae::get_All_Cv_PV();
        $cvut = CurriculumVitae::XDBuild($cvs);
        return response()->json(['location' => 'interview', 'status' => 'succes', 'cvbody' => $cvut]);
    }
    public function saveCV(saveCV $request)
    {
        $cv = new CurriculumVitae();

        $fileName = 'CV' . time() . '.' . $request->cv_ut->extension();
        $request->cv_ut->move(public_path('cv'), $fileName);
        $cv->url_cv = $fileName;
        $cv->name = $request->name_ut;
        $cv->email = $request->email_ut;
        $cv->date_of_birth = $request->date_of_birth_ut;
        $cv->phone = $request->phone_ut;
        $cv->gender = $request->gender;
        $cv->position_id = $request->position_ut;
        $cv->nominee = $request->nominees_ut;
        $cv->about = $request->about_cv;
        $cv->save();
        $cvs = CurriculumVitae::get_All_CV_UT();
        $cvut = CurriculumVitae::UTBuild($cvs);
        return response()->json(['status' => 'succes', 'cvbody' => $cvut]);
    }
    //====================nominees====================================
    public function nominees(Request $request)
    {
        $id = $request->id;
        $result = nominee::where('position_id', '=', "$id")->get();
        // dd($result);
        $body = nominee::nomineeBuild($result);
        return response()->json(['body' => $body]);
    }
    public function nominees_first(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $result = nominee::where('position_id', '=', "$user->position_id")->get();
        // dd($result);
        $body = nominee::nomineeBuild($result);
        return response()->json(['body' => $body]);
    }
    public function nominees_cv(Request $request)
    {
        $id = $request->id;
        $cver = CurriculumVitae::find($id);
        $result = nominee::where('position_id', '=', "$cver->position_id")->get();
        $body = nominee::nomineeBuild($result);
        return response()->json(['body' => $body]);
    }

    public function update_cv_all(updateCVRequest $request)
    {
        // check quyền user đăng nhập
        $Authentication = Authority::get_Roles_By_Id_User(Auth::user()->id);
        if ($Authentication->personnel->update_cv_autho === "false") {
            return response()->json(['status' => 'error', 'message' => 'Không thể sửa cv này do không đủ quyền !']);
        }
        $cv = CurriculumVitae::find($request->id_ut_update);
        if ($request->email_ut_update !== $cv->email) {
            $request->validate(
                [
                    'email_ut_update' => 'unique:curriculum_vitaes,email',
                ],
                [
                    'email_ut_update.unique' => 'Email đã tồn tại !',
                ]
            );
        };
        $fileName = 'CV' . time() . '.' . $request->cv_ut_update->extension();
        $request->cv_ut_update->move(public_path('cv'), $fileName);
        $cv->url_cv = $fileName;
        $cv->name = $request->name_ut_update;
        $cv->email = $request->email_ut_update;
        $cv->date_of_birth = $request->date_of_birth_ut_update;
        $cv->phone = $request->phone_ut_update;
        $cv->gender = $request->gender_ut_update;
        $cv->position_id = $request->position_ut_update;
        $cv->nominee = $request->nominees_ut_update;
        $cv->about = $request->about_ut_update;
        $cv->save();
        $cvs = CurriculumVitae::get_All_CV_UT();
        $cvut = CurriculumVitae::UTBuild($cvs);
        return response()->json(['status' => 'succes', 'cvbody' => $cvut]);
    }
}
