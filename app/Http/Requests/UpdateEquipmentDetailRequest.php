<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentDetailRequest extends FormRequest
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
            'equipment_detail_id_update' => 'required',
            'equipment_detail_warranty_expiration_date' => 'required|date',
            'equipment_detail_date_added' => 'required|date',
            'img_equipment_detail' => 'image|mimes:jpg,png,webp,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=3000,max_height=3000',
            'equipment_detail_imei_update' => 'required',
            'equipment_detail_supplier' => 'required',
            'equipment_detail_status' => 'required|max:1',
            'equipment_detail_specifications' => 'required|min:5|max:1000',
        ];
    }
    public function messages()
    {
        return [
            'img_equipment_detail.image' => 'File ảnh không đúng định dạng!',
            'img_equipment_detail.mimes' => 'Ảnh phải có đuôi jpg,png,jpeg,gif,svg !',
            'img_equipment_detail.max' => 'Dung lượng ảnh quá lớn !',
            'img_equipment_detail.dimensions' => 'Ảnh quá lớn hoặc quá nhỏ !',
            'equipment_detail_id_update.required' => 'Vui lòng cập nhật lại trang rồi thực hiện thao tác !',
            'equipment_detail_warranty_expiration_date.required' => 'Hạn bảo hành không được trống !',
            'equipment_detail_warranty_expiration_date.date' => 'Hạn bảo hành đúng định dạng !',
            'equipment_detail_date_added.date' => 'Ngày nhập đúng định dạng !',
            'equipment_detail_date_added.required' => 'Ngày nhập không được để trống !',
            'equipment_detail_imei_update.required' => 'IMEI không được để trống !',
            'equipment_detail_supplier.required' => 'Nhà cung cấp không được để trống !',
            'equipment_detail_specifications.required' => 'Thông số kỹ thuật không được trống !',
            'equipment_detail_specifications.min' => 'Thông số kỹ thuật quá ngắn !',
            'equipment_detail_specifications.max' => 'Thông số kỹ thuật quá dài !',
        ];
    }
}
