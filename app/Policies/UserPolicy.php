<?php

namespace App\Policies;

use App\Models\Authority;
use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\App;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }



    public function update(User $user)
    {
        return $user->level > 3;
    }

    public function personnel(User $user)
    {
        $autho = Authority::get_Roles_By_Id_User($user->id);
        return $autho->personnel->personnel_autho_access === "true";
    }

    public function authentication(User $user)
    {
        $autho = Authority::get_Roles_By_Id_User($user->id);
        return $autho->authority === "true";
    }
}
