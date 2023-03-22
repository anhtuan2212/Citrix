<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEquipmentDepartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipment_detail_id',
        'department_id',
        'transfer_id',
    ];
}
