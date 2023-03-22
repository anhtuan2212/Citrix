<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_transfer',
        'user_recipient',
        'equipment_id',
        'transfer_date',
        'equipment_detail',
        'department_id',
        'note',
        'status',
    ];
}
