<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddInterviewRequest extends FormRequest
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
            'interviewer1' => 'required|max:20',
            'interviewer2' => 'required|max:20',
            'interview_date' => 'required|date',
            'interview_time' => 'required',
            'location' => 'required|min:6|max:255',
            'cate_inter' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'interviewer1.required' => 'Phải có đủ 2 người phỏng vấn !',
            'interviewer1.max' => 'Tham số người phỏng vấn 1 quá dài !',
            'interviewer2.max' => 'Tham số người phỏng vấn 2 quá dài !',
            'interviewer2.required' => 'Phải có đủ 2 người phỏng vấn !',
            'interview_date.date' => 'Ngày phỏng vấn phải đúng định dạng !',
            'interview_date.required' => 'Ngày phỏng vấn không được trống !',
            'interview_time.required' => 'Giờ phỏng vấn không được trống !',
            'location.required' => 'Vui lòng nhập địa chỉ !',
            'location.min' => 'Địa chỉ/ Đường dẫn quá ngắn !',
            'location.max' => 'Địa chỉ/ Đường dẫn quá dài !',
            'cate_inter.required' => 'Hình thức phỏng vấn không được để trống !',
            'cate_inter.boolean' => 'Hình thức phỏng vấn sai định !',
        ];
    }
}
