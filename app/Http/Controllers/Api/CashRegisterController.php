<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CashRegisterRequest;
use App\Http\Resources\CashRegisterResource;
use App\Models\CashRegister;
use App\Models\CashRegisterDetail;
use App\Models\CashSettlement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashRegisterController extends Controller
{
    public function index()
    {
        $cash = CashRegister::all();

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

    public function detail(CashRegister $cash_register)
    {
        $details = $cash_register->details()->with('movements', 'settlement')->get();
        return response()->json($details);
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

    public function open(Request $request, CashRegister $cash_register)
    {
        $request->validate([
            'initial_balance' => 'required',
        ]);

        $details = DB::table('cash_register_details')
            ->where('cash_register_id', $cash_register->id)
            ->where('status', 'open')
            ->get();

        if ($details->contains('status', 'open')) {
            return abort(500, 'No puede abrir una caja porque existe una abierta.');
        }

        $detail = new CashRegisterDetail();
        $detail->opening = Carbon::now();
        $detail->initial_balance = $request->initial_balance;
        $detail->status = 'open';
        $detail->cash_register_id = $cash_register->id;
        $detail->user_open_id = Auth::id();
        $detail->save();

        return response()->json($detail);
    }

    public function close(CashRegisterDetail $cash_register)
    {
        $movements = DB::table('movements')
            ->where('cash_register_detail_id', $cash_register->id)
            ->get();

        $income = 0;
        $expenses = 0;

        foreach ($movements->toArray() as $value) {
            if ($value->type === 'expenses') {
                $expenses += $value->total;
            } else {
                $income += $value->total;
            }
        }

        $cash_register->closing = Carbon::now();
        $cash_register->ending_balance = $cash_register->initial_balance + $income - $expenses;
        $cash_register->status = 'close';
        $cash_register->user_close_id = Auth::id();
        $cash_register->update();

        return response()->json($cash_register);
    }

    public function settlement(Request $request, CashRegisterDetail $cash_register)
    {
        $request->validate([
            'bill_200' => 'required',
            'bill_100' => 'required',
            'bill_50' => 'required',
            'bill_20' => 'required',
            'bill_10' => 'required',
            'bill_5' => 'required',
            'bill_1' => 'required',
            'total' => 'required',
        ]);

        $settlement = new CashSettlement();
        $settlement->bill_200 = $request->bill_200;
        $settlement->bill_100 = $request->bill_100;
        $settlement->bill_50 = $request->bill_50;
        $settlement->bill_20 = $request->bill_20;
        $settlement->bill_10 = $request->bill_10;
        $settlement->bill_5 = $request->bill_5;
        $settlement->bill_1 = $request->bill_1;
        $settlement->total = $request->total;
        $settlement->cash_register_detail_id = $cash_register->id;
        $settlement->save();

        return response()->json($settlement);
    }
}
