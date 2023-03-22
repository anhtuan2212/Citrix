<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
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
            'fullname' => 'required|max:255|min:2',
            'phone' => 'required|min:6',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'address' => 'required',
        ];
    }
        public function messages()
    {
        return [
            'email.unique' => 'Email đã tồn tại !',
            'email.max' => 'Email quá dài !',
            'email.email' => 'Email không đúng định dạng !',
            'email.required' => 'Vui lòng nhập email !',
            'address.required' => 'Vui lòng nhập địa chỉ !',
            'phone.required' => 'Vui lòng nhập số điện thoại !',
            'phone.min' => 'Vui lòng nhập lại số điện thoại !',
            'fullname.required' => 'Vui lòng nhập họ tên !',
            'fullname.min' => 'Vui lòng nhập trên 2 ký tự !',
            'fullname.max' => 'Ký tự quá dài !',
            'password.min' => 'Mật khẩu phải lớn hơn 5 ký tự !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
        ];
        
    }

}
