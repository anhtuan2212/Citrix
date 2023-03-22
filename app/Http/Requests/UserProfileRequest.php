<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
        return [
            'fullname' => 'required|min:3|max:255',
            'email' => 'required|email',
            'date_of_birth' => 'date|required',
            'gender' => 'required|max:2',
            'phone' => 'min:5|max:15',
            'position_id' => 'min:1|max:4',
            'department_id' => 'required|max:5'
        ];
    }
    public function messages()
    {
        return [
            'fullname.min' => 'Tên phải có hơn 3 ký tự !',
            'fullname.required' => 'Tên không được để trống !',
            'email.email' => 'Email không đúng định dạng !',
            'email.required' => 'Email không được để trống !',
            'date_of_birth.required' => 'Ngày sinh không được để trống !',
            'date_of_birth.date' => 'Ngày sinh không đúng định dạng !',
            'gender.required' => 'giới tính không để trống !',
            'gender.max' => 'sai định dạng giới tính !',
            'phone.min' => 'Số điện thoại quá ngắn !',
            'phone.max' => 'Số điện thoại quá dài !',
            'position_id.max' => 'Chức vụ lỗi !',
            'position_id.min' => 'Chức vụ lỗi !',
            'department_id.required' => 'Phòng ban không được trống !',
            'department_id.max' => 'Phòng ban quá dài !'
        ];
    }
}
