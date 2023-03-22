<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentChild extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_equipment',
        'id_equipment_detail',
    ];
}
