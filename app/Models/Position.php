<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\User;

class Position extends Model
{
    use HasFactory;

    public function nominees(){
        return $this -> hasMany(Nominee::class)->orderBy("created_at");
    }

    protected $fillable = [
        'id',
        'position',
    ];

    public $timestamps = false;
}
