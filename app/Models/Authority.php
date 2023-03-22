<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_autho',
        'personnel',
        'departments',
        'equipment',
        'authority',
    ];

    public static function get_Roles_By_Id_User($id)
    {
        $user = User::find($id);
        if (empty($user->autho)) {
            return 0;
        }
        $autho = Authority::find($user->autho);
        $autho->personnel = json_decode($autho->personnel);
        $autho->authority = json_decode($autho->authority);
        return $autho;
    }
}
