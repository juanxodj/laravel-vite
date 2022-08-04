<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use ReflectionClass;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        if (! Role::where('name', \App\Models\Role::ROLE_SUPER_ADMIN)->exists()) {
            Role::create([
                'name' => \App\Models\Role::ROLE_SUPER_ADMIN,
            ]);
        }

        if (! Role::where('name', \App\Models\Role::ROLE_ADMIN)->exists()) {
            $adminRole = Role::create([
                'name' => \App\Models\Role::ROLE_ADMIN,
            ]);
        }

        if (! Role::where('name', \App\Models\Role::ROLE_USER)->exists()) {
            $userRole = Role::create([
                'name' => \App\Models\Role::ROLE_USER,
            ]);
        }

        $this->registerPermissions(\App\Models\CashRegister::class, [$adminRole, $userRole]);
        $this->registerPermissions(\App\Models\CashRegisterDetail::class, [$adminRole, $userRole]);
        $this->registerPermissions(\App\Models\CashSettlement::class, [$adminRole, $userRole]);
        $this->registerPermissions(\App\Models\Movement::class, [$adminRole, $userRole]);
        $this->registerPermissions(\App\Models\Product::class, [$adminRole, $userRole]);
        $this->registerPermissions(\App\Models\Role::class, [$adminRole]);
        $this->registerPermissions(\App\Models\User::class, [$adminRole]);
    }

    protected function registerPermissions($model, array $roles)
    {
        $reflection = new ReflectionClass($model);
        $constants = $reflection->getConstants();

        foreach ($constants as $constant => $value) {
            if (strpos($constant, 'P_') !== false) {
                Permission::findOrCreate($value);
                foreach ($roles as $role) {
                    $role->givePermissionTo($value);
                }
            }
        }
    }
}
