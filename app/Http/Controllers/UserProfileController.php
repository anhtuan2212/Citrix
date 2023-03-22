<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\TransferController;

class UserProfileController extends Controller
{

    public function show()
    {
        $birthDate = Auth::user()->date_of_birth;
        $userx = User::getUserDetail(Auth::user()->id);
        $users = $userx[0];
        // dd($users);
        $phongbans = Department::all();
        $postions = Position::all();
        $age = floor((time() - strtotime($birthDate)) / 31556926);
        return view('pages.user-profile', compact('users', 'postions', 'phongbans'))->with('age', $age);
    }

    public function update_profile(UserProfileRequest $request)
    {
        // dd($request);
        $user = User::findOrFail(Auth::user()->id);
        $age = floor((time() - strtotime($request->date_of_birth)) / 31556926);
        if ($age < 15) {
            return response()->json(['status' => 'error', 'message' => 'Tuổi của nhân sự phải lớn hơn 15 !']);;
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
            $request->img_url->move(public_path('file'), $fileName);
            $user->img_url = $fileName;
        }
        // dd($user);
        $user->gender = $request->gender;
        $user->about = $request->about;
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        $user->date_of_birth = $request->date_of_birth;
        $user->position_id = $request->position_id;
        $user->address = $request->address;
        $user->save();
        $nhansu2 = User::leftjoin('departments', 'users.department_id', 'departments.id')
            ->select('users.*', 'departments.name')->paginate(8);
        $body = User::UserBuild($nhansu2);
        return response()->json(['status' => 'succes', 'body' => $body]);
    }
}
