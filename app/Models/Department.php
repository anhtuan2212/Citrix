<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\nominee;

class Department extends Model
{
    use HasFactory;
    use NodeTrait;

    public function users(){
        return $this -> hasMany(User::class, 'department_id', 'id')->orderBy('position_id');
    }
}
