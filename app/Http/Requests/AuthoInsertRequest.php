<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthoInsertRequest extends FormRequest
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
            'autho_name' => 'required|min:3|max:255',
            'personnel_autho_access' => 'required',
            'insert_personnel' => 'required',
            'update_personnel' => 'required',
            'delete_personnel' => 'required',
            'accept_cv_autho' => 'required',
            'update_cv_autho' => 'required',
            'inter_cv_autho' => 'required',
            'eva_cv_autho' => 'required',
            'offer_cv_autho' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'autho_name.required' => 'Tên nhóm không được để trống !',
            'autho_name.max' => 'Tên nhóm quá dài !',
            'autho_name.min' => 'Tên nhóm quá ngắn !',
            'personnel_autho_access.required' => 'Check personnel_autho_access không được để trống !',
            'insert_personnel.required' => 'Check insert_personnel không được để trống !',
            'update_personnel.required' => 'Check update_personnel không được để trống !',
            'delete_personnel.required' => 'Check delete_personnel không được để trống !',
            'accept_cv_autho.required' => 'Check accept_cv_autho không được để trống !',
            'update_cv_autho.required' => 'Check update_cv_autho không được để trống !',
            'inter_cv_autho.required' => 'Check inter_cv_autho không được để trống !',
            'eva_cv_autho.required' => 'Check eva_cv_autho không được để trống !',
            'offer_cv_autho.required' => 'Check offer_cv_autho không được để trống !',
        ];
    }
}
