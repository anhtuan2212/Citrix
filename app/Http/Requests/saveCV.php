<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class saveCV extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $dt = new Carbon();
        $before = $dt->subYears(15)->format('d-m-Y');
        return [
            'name_ut' => 'required|min:3|max:255',
            'email_ut' => 'required|email|max:255|unique:curriculum_vitaes,email',
            'phone_ut' => 'required|min:6|max:20',
            'date_of_birth_ut' => 'required|date|before:' . $before,
            'gender' => 'required|max:1',
            'cv_ut' => 'required|mimes:pdf|max:10000',
            'position_ut' => 'required',
            'nominees_ut' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name_ut.min' => 'Tên phải có hơn 3 ký tự !',
            'name_ut.required' => 'Tên không được để trống !',
            'name_ut.max' => 'Tên quá dài !',
            'email_ut.max' => 'Email quá dài !',
            'email_ut.email' => 'Email không đúng định dạng !',
            'email_ut.unique' => 'Email đã tồn tại !',
            'email_ut.required' => 'Email không được để trống !',
            'phone_ut.required' => 'Số điện thoại không được để trống !',
            'phone_ut.min' => 'Số điện thoại quá ngắn !',
            'phone_ut.max' => 'Số điện thoại quá dài !',
            'date_of_birth_ut.required' => 'ngày sinh không được để trống !',
            'date_of_birth_ut.date' => 'ngày sinh không đúng định dạng !',
            'date_of_birth_ut.before' => 'Tuổi của ứng viên phải lớn hơn 15 !',
            'gender.required' => 'Giới tính không được để trống !',
            'gender.max' => 'Giới tính quá dài !',
            'cv_ut.max' => 'CV có dung lượng quá lớn !',
            'cv_ut.mimes' => 'CV phải là file PDF !',
            'cv_ut.required' => 'CV không được để trống !',
            'position_ut.required' => 'Chức vụ không được để trống !',
            'nominees_ut.required' => 'Vị trí ứng tuyển không được để trống !',
        ];
    }
}
