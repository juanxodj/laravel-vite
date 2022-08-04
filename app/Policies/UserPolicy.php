<?php

namespace App\Policies;

use App\Helper;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return Helper::userHavePermission($user, User::P_READ);
    }

    public function view(User $user)
    {
        return Helper::userHavePermission($user, User::P_READ);
    }

    public function create(User $user)
    {
        return Helper::userHavePermission($user, User::P_CREATE);
    }

    public function update(User $user)
    {
        return Helper::userHavePermission($user, User::P_UPDATE);
    }

    public function delete(User $user)
    {
        return Helper::userHavePermission($user, User::P_DELETE);
    }
}
