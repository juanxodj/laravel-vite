<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovementRequest;
use App\Http\Resources\MovementResource;
use App\Models\CashRegisterDetail;
use App\Models\Movement;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MovementController extends Controller
{
    public function index()
    {
        $product = Product::all();

        $cashRegister = CashRegisterDetail::with('cashRegister')
            ->where('status', 'open')
            ->orderByDesc('id')
            ->get();

        return response()->json(compact('product', 'cashRegister'));
    }

    public function store(MovementRequest $request): JsonResource
    {
        $movement = new Movement();
        $movement->fill($request->all());
        $movement->user_id = Auth::id();
        $movement->save();

        return new MovementResource($movement);
    }

    public function show(Movement $movement): JsonResource
    {
        return new MovementResource($movement);
    }

    public function update(MovementRequest $request, Movement $movement): JsonResource
    {
        $movement->update($request->all());

        return new MovementResource($movement);
    }

    public function destroy(Movement $movement): JsonResource
    {
        $movement->delete();

        return new MovementResource($movement);
    }
}
