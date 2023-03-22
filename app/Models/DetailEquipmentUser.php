<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEquipmentUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_detail_id',
        'user_id',
        'transfer_id',
    ];
}
