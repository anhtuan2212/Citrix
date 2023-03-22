<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateInterviewRequest extends FormRequest
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
            'note' => 'required|min:6|max:255',
            'point' => 'required|max:3'

        ];
    }
    public function messages()
    {
        return [
            'note.required' => 'Đánh giá không được để trống !',
            'note.min' => 'Đánh giá quá ngắn !',
            'note.max' => 'Đánh giá quá dài !',
            'point.max' => 'Điểm quá dài !',
            'point.required' => 'Điểm không được để trống !',

        ];
    }
}
