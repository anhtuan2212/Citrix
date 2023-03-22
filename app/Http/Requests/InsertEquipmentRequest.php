<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertEquipmentRequest extends FormRequest
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
            'equipment_name' => 'required|min:4',
            'equipment_type' => 'required',
            'equipment_quantity' => 'required|max:5',
            'equipment_date_added' => 'required|date',
            'equipment_warranty_expiration_date' => 'required|date',
            'equipment_supplier' => 'required',
            'equipment_specifications' => 'required|min:6|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'equipment_name.required' => 'Tên thiết bị không được để trống !',
            'equipment_name.min' => 'Tên phải có ít nhất 4 ký tự !',
            'equipment_type.required' => 'Thể loại không được để trống !',
            'equipment_quantity.required' => 'Số lượng không được để trống !',
            'equipment_quantity.max' => 'Số lượng quá lớn !',
            'equipment_date_added.required' => 'Ngày nhập không được để trống !',
            'equipment_date_added.date' => 'Ngày nhập không đúng định dạng !',
            'equipment_supplier.required' => 'Nhà cung cấp không được để trống !',
            'equipment_specifications.required' => 'Thông số kỹ thuật không được để trống !',
            'equipment_specifications.min' => 'Thông số kỹ thuật quá ngắn !',
            'equipment_specifications.max' => 'Thông số kỹ thuật quá dài !',
        ];
    }
}
