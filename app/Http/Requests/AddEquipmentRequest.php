<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEquipmentRequest extends FormRequest
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
            'id' => 'required|max:8',
            'quantity' => 'required|max:20',
            'add_date' => 'date',
            'warranty' => 'date',
            'supplier_id' => 'required|max:6',
            'specifications' => 'required|max:1000|min:6'
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Vui lòng thực hiện lại thao tác !',
            'id.max' => 'Truyền nhập id quá dài !',
            'quantity.required' => 'Số lượng sản phẩm không được để trống !',
            'supplier_id.required' => 'Nhà cung cấp không được để trống !',
            'supplier_id.max' => 'Nhà cung cấp quá dài !',
            'add_date.date' => 'Ngày nhập phải đúng định dạng !',
            'warranty.date' => 'Hạn bảo hành phải đúng định dạng !',
            'specifications.required' => 'Thông số kỹ thuật không được để trống !',
            'specifications.max' => 'Thông số kỹ thuật quá dài !',
            'specifications.min' => 'Thông số kỹ thuật quá ngắn !',

        ];
    }
}
