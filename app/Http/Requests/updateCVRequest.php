<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class updateCVRequest extends FormRequest
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
            'name_ut_update' => 'required|min:3|max:255',
            'phone_ut_update' => 'required|min:6|max:20',
            'date_of_birth_ut_update' => 'required|date|before:' . $before,
            'gender_ut_update' => 'required|max:1',
            'cv_ut_update' => 'required|mimes:pdf|max:10000',
            'position_ut_update' => 'required',
            'nominees_ut_update' => 'required',
            'email_ut_update' => 'required|email|max:255',
        ];
    }
    public function messages()
    {
        return [
            'email_ut_update.max' => 'Email quá dài !',
            'email_ut_update.email' => 'Email không đúng định dạng !',
            'email_ut_update.required' => 'Email không được để trống !',
            'name_ut_update.min' => 'Tên phải có hơn 3 ký tự !',
            'name_ut_update.required' => 'Tên không được để trống !',
            'name_ut_update.max' => 'Tên quá dài !',
            'phone_ut_update.required' => 'Số điện thoại không được để trống !',
            'phone_ut_update.min' => 'Số điện thoại quá ngắn !',
            'phone_ut_update.max' => 'Số điện thoại quá dài !',
            'date_of_birth_ut_update.required' => 'ngày sinh không được để trống !',
            'date_of_birth_ut_update.date' => 'ngày sinh không đúng định dạng !',
            'date_of_birth_ut_update.before' => 'Tuổi của ứng viên phải lớn hơn 15 !',
            'gender_ut_update.required' => 'Giới tính không được để trống !',
            'gender_ut_update.max' => 'Giới tính quá dài !',
            'cv_ut_update.max' => 'CV có dung lượng quá lớn !',
            'cv_ut_update.mimes' => 'CV phải là file PDF !',
            'cv_ut_update.required' => 'CV không được để trống !',
            'position_ut_update.required' => 'Chức vụ không được để trống !',
            'nominees_ut_update.required' => 'Vị trí ứng tuyển không được để trống !',
        ];
    }
}
