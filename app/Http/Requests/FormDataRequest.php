<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Department;

class FormDataRequest extends FormRequest
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
            'name' => 'required|min:6',
            'code' => 'required|min:4',
            'id_department_parent' => 'different:id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không thể bỏ trống',
            'name.min' => 'Tên phải có ít nhất 6 ký tự',

            'code.min' => 'Tên phải có ít nhất 4 ký tự',
            'code.required' => 'Mã không thể bỏ trống',
            'code.unique' => 'Mã phòng ban đã tồn tại',

            'id_department_parent.different' => 'Phòng ban không thể trùng với phòng ban hiện tại'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                response()->json(['status' => 0, 'msg' => $errors])
            );
        }
        parent::failedValidation($validator);
    }

}
