<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            'img_url' => 'image|mimes:jpg,png,webp,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=3000,max_height=3000',
            'fullname' => 'required|min:3|max:255',
            'email' => 'required|email',
            'date_of_birth' => 'date|required',
            'recruitment_date' => 'required|date',
            'status' => 'required|max:2',
            'nominee_bild' => 'required|min:1|max:100',
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
            'recruitment_date.date' => 'Ngày tuyển dụng không đúng định dạng !',
            'recruitment_date.required' => 'Ngày tuyển dụng không được để trống !',
            'status.required' => 'Trạng Thái không được để trống !',
            'status.max' => 'Trạng Thái không được lớn hơn 2 ký tự !',
            'nominee_bild.required' => 'Chức danh không được để trống !',
            'nominee_bild.max' => 'Chức danh quá dài !',
            'nominee_bild.min' => 'Chức danh quá ngắn !',
            'gender.required' => 'giới tính không để trống !',
            'gender.max' => 'sai định dạng giới tính !',
            'img_url.image' => 'File ảnh không đúng định dạng!',
            'img_url.mimes' => 'Ảnh phải có đuôi jpg,png,jpeg,gif,svg !',
            'img_url.max' => 'Dung lượng ảnh quá lớn !',
            'img_url.dimensions' => 'Ảnh quá lớn hoặc quá nhỏ !',
            'phone.min' => 'Số điện thoại quá ngắn !',
            'phone.max' => 'Số điện thoại quá dài !',
            'position_id.max' => 'Chức vụ lỗi !',
            'position_id.min' => 'Chức vụ lỗi !',
            'department_id.required' => 'Phòng ban không được trống !',
            'department_id.max' => 'Phòng ban quá dài !'
        ];
    }
}
