<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function index()
    {
        $cash = User::all();

        return response()->json($cash);
    }

    public function store(UserRequest $request): JsonResource
    {
        $cash = new User();
        $cash->fill($request->all());
        $cash->save();

        return new UserResource($cash);
    }

    public function show(User $user): JsonResource
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user): JsonResource
    {
        $user->update($request->all());

        return new UserResource($user);
    }

    public function destroy(User $user): JsonResource
    {
        $user->delete();

        return new UserResource($user);
    }
}
