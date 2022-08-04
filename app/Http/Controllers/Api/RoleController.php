<?php

namespace App\Http\Controllers\Api;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\Movement;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected function resourceAbilityMap()
    {
        $map = parent::resourceAbilityMap();
        $map['updatePermissions'] = 'update';
        $map['userList'] = 'view';

        return $map;
    }

    public function index()
    {
        $roles = Role::where('name', '!=', Role::ROLE_SUPER_ADMIN)
            ->orderByDesc('id')
            ->get();

        $roles->each(function (Role $role) {
            $role->append('acl', 'is_locked');
        });

        return response()->json($roles);
    }

    public function show(Role $role)
    {
        $role->permissions;
        $role->system_modules = $this->systemModules();
        $role->users_total = $role->users()->count();
        $role->is_locked;

        return $role;
    }

    public function store(Request $request)
    {
        $inputs = $this->validate($request, [
            'name' => 'required|string|unique:roles',
        ]);

        if (Role::isLockedRole($inputs['name'])) {
            abort(422, 'Este rol no puede ser modificado.');
        }

        $role = new Role($inputs);
        $role->guard_name = 'web';
        $role->save();

        return response()->json($role, Response::HTTP_CREATED);
    }

    public function update(Request $request, Role $role)
    {
        $inputs = $this->validate($request, [
            'name' => 'required|string|unique:roles',
        ]);

        if ($role->isLocked()) {
            abort(422, 'Este rol no puede ser modificado.');
        }

        $role->fill($inputs);
        $role->save();

        return response()->json($role);
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $input = $this->validate($request, [
            'permissions' => 'required|array',
        ]);

        DB::transaction(function () use ($input, $role) {
            $role->syncPermissions($input['permissions']);
        });

        return response()->json($role);
    }

    public function destroy(Role $role)
    {
        if ($role->isLocked()) {
            abort(422, 'Este rol no puede ser eliminado.');
        }
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => __('general.removed-successfully'),
        ]);
    }

    public function userList(Role $role)
    {
        $users = $role->users()->paginate();

        return response()->json($users);
    }

    /**
     * Obtain all permissions of the system
     */
    private function systemModules()
    {
        $modules[] = [
            'name' => 'Módulo Roles y Permisos',
            'permissions' => Helper::getPermissionsFromModel(Role::class),
        ];

        $modules[] = [
            'name' => 'Módulo Usuarios',
            'permissions' => Helper::getPermissionsFromModel(User::class),
        ];

        $modules[] = [
            'name' => 'Módulo Cajas',
            'permissions' => Helper::getPermissionsFromModel(CashRegister::class),
        ];

        $modules[] = [
            'name' => 'Módulo Producto',
            'permissions' => Helper::getPermissionsFromModel(Product::class),
        ];

        $modules[] = [
            'name' => 'Módulo Movimientos',
            'permissions' => Helper::getPermissionsFromModel(Movement::class),
        ];

        return $modules;
    }
}
