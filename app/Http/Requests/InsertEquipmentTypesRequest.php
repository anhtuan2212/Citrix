<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertEquipmentTypesRequest extends FormRequest
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
            'equipment_type' => 'required|min:2|max:255',
            'equipment_type_code_insert' => 'required|min:2|max:5',
        ];
    }

    public function messages()
    {
        return [
            'equipment_type.required' => 'Tên thể loại không được để trống !',
            'equipment_type.min' => 'Tên quá ngắn !',
            'equipment_type.max' => 'Tên quá dài !',
            'equipment_type_code_insert.required' => 'Mã thể loại không được để trống !',
            'equipment_type_code_insert.min' => 'Mã quá ngắn !',
            'equipment_type_code_insert.max' => 'Mã quá dài !',
        ];
    }
}
