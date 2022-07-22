<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CashRegisterRequest;
use App\Http\Resources\CashRegisterResource;
use App\Models\CashRegister;
use Illuminate\Http\Resources\Json\JsonResource;

class CashRegisterController extends Controller
{
    public function index()
    {
        $cash = CashRegister::paginate(10);

        return response()->json($cash);
    }

    public function store(CashRegisterRequest $request): JsonResource
    {
        $cash = new CashRegister();
        $cash->fill($request->all());
        $cash->save();

        return new CashRegisterResource($cash);
    }

    public function show(CashRegister $cash_register): JsonResource
    {
        return new CashRegisterResource($cash_register);
    }

    public function update(CashRegisterRequest $request, CashRegister $cash_register): JsonResource
    {
        $cash_register->update($request->all());

        return new CashRegisterResource($cash_register);
    }

    public function destroy(CashRegister $cash_register): JsonResource
    {
        $cash_register->delete();

        return new CashRegisterResource($cash_register);
    }
}
