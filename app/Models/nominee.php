<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class nominee extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'position_id',
        'nominees'
    ];

    public static function nomineeBuild($nominee)
    {
        $html = '';

        foreach ($nominee as $en) {

            $html .= '
            <option value="' . $en->id . '">' . $en->nominees . '</option>
        ';
        }
        return $html;
    }

    public function users(){
        return $this -> hasMany(User::class);
    }
}
