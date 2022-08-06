<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\Product;
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
            case 'cash-registers':
                return $this->getCashRegisters($search);
            case 'products':
                return $this->getProducts($search);
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
            case 'cash-registers':
                return CashRegister::select('id', 'description')->findOrFail($id);
            case 'products':
                return Product::select('id', 'description')->findOrFail($id);
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

        if (! empty($search)) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        return $query->get();
    }

    public function getUsers($search)
    {
        $query = User::select('id', 'name');

        if (! empty($search)) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        return $query->get();
    }

    public function getProducts($search)
    {
        $query = Product::select('id', 'description');

        if (! empty($search)) {
            $query->where('description', 'like', '%'.$search.'%');
        }

        return $query->get();
    }

    public function getCashRegisters($search)
    {
        $query = CashRegister::select('id', 'description');

        if (! empty($search)) {
            $query->where('description', 'like', '%'.$search.'%');
        }

        return $query->get();
    }
}
