<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interview extends Model
{
    use HasFactory;
    protected $fillable = [
        'interviewer1',
        'interviewer2',
        'interview_date',
        'interview_time',
        'cate_inter',
        'location',
        'status',
    ];
}
