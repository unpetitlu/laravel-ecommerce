<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;

class AdminPolicy
{
    use HandlesAuthorization;

    public function isAdmin(User $user)
    {
        return $user->is_admin ? true : false;
    }
}
