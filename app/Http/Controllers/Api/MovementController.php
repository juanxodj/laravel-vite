<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovementRequest;
use App\Http\Resources\MovementResource;
use App\Models\Movement;
use Illuminate\Http\Resources\Json\JsonResource;

class MovementController extends Controller
{
    public function index()
    {
        $cash = Movement::paginate(10);

        return response()->json($cash);
    }

    public function store(MovementRequest $request): JsonResource
    {
        $cash = new Movement();
        $cash->fill($request->all());
        $cash->save();

        return new MovementResource($cash);
    }

    public function show(Movement $cash_register): JsonResource
    {
        return new MovementResource($cash_register);
    }

    public function update(MovementRequest $request, Movement $cash_register): JsonResource
    {
        $cash_register->update($request->all());

        return new MovementResource($cash_register);
    }

    public function destroy(Movement $cash_register): JsonResource
    {
        $cash_register->delete();

        return new MovementResource($cash_register);
    }
}
