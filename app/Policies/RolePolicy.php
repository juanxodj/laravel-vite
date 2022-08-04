<?php

namespace App\Policies;

use App\Helper;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return Helper::userHavePermission($user, Role::P_READ);
    }

    public function view(User $user, Role $role)
    {
        return Helper::userHavePermission($user, Role::P_READ);
    }

    public function create(User $user)
    {
        return Helper::userHavePermission($user, Role::P_CREATE);
    }

    public function update(User $user, Role $role)
    {
        return Helper::userHavePermission($user, Role::P_UPDATE);
    }

    public function delete(User $user, Role $role)
    {
        return Helper::userHavePermission($user, Role::P_DELETE);
    }
}
