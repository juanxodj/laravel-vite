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

        if (auth()->user()->is_super_admin) {
            $cashRegister = CashRegisterDetail::with('cashRegister')
                ->where('status', 'open')
                ->orderByDesc('id')
                ->get();
        } else {
            $cashRegister = CashRegisterDetail::with('cashRegister')
                ->where('status', 'open')
                ->where('user_open_id', Auth::id())
                ->orderByDesc('id')
                ->get();
        }

        return response()->json(compact('product', 'cashRegister'));
    }

    public function store(MovementRequest $request)
    {
        $detail = [];

        foreach ($request->movements as $mov) {
            $movement = new Movement();
            $movement->type = $mov['type'] === 'Ingreso' ? 'income' : 'expenses';
            $movement->quantity = $mov['quantity'];
            $movement->amount = $mov['amount'];
            $movement->total = $mov['quantity'] * $mov['amount'];
            $movement->cash_register_detail_id = $request->cash_register_detail_id;
            $movement->product_id = $mov['product_id'];
            $movement->user_id = Auth::id();
            $movement->save();
            $detail[] = $movement;
        }

        return response()->json($detail);
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
