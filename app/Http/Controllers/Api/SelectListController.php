<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class SelectListController extends Controller
{
    public function index($type, Request $request)
    {
        $input = $this->validate($request, [
            'search' => 'nullable|string|max:150',
        ]);

        $search = $input['search'] ?? null;

        switch ($type) {
            case 'roles':
                return $this->getRoles($search);
            case 'users':
                return $this->getUsers($search);
            default:
                abort(422, 'No existe');
        }
    }

    public function show($type, $id)
    {
        switch ($type) {
            case 'roles':
                return Role::select('id', 'name')->findOrFail($id);
            case 'users':
                return User::select('id', 'name')->findOrFail($id);
            default:
                abort(422, 'No existe');
        }
    }

    public function getRoles($search)
    {
        $query = Role::select('id', 'name');

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->get();
    }

    public function getUsers($search)
    {
        $query = User::select('id', 'name');

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->get();
    }
}
