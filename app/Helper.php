<?php

namespace App;

use App\Models\User;
use Carbon\Carbon;
use ReflectionClass;

class Helper
{
    public static function userHavePermission(User $user, $permission)
    {
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        if (in_array($permission, $permissions)) {
            return true;
        }

        return false;
    }

    public static function getUserPermissions(User $user)
    {
        return $user->getAllPermissions()->pluck('name')->toArray();
    }

    public static function fromUtcToLocalTimezone(string $utc): Carbon
    {
        return Carbon::createFromDate($utc)->setTimezone(config('app.timezone'));
    }

    public static function getPermissionsFromModel($model, &$permissions = [])
    {
        $reflection = new ReflectionClass($model);
        $constants = $reflection->getConstants();

        foreach ($constants as $constant => $value) {
            if (strpos($constant, 'P_') !== false) {
                $permissions[] = $value;
            }
        }

        return $permissions;
    }
}
