<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CashRegisterDetail;
use App\Models\Movement;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function byCashRegister(Request $request)
    {
        $cash_register_id = $request->query('cash_register_id');
        $date = $request->query('date');

        $data = CashRegisterDetail::with('movements.product', 'cashRegister')
            ->where('cash_register_id', $cash_register_id)
            ->whereDate('opening', '=', $date)
            ->first();

        return $data;

        //return view('pdf.by-cash-register', $data);

        /* $pdf = Pdf::loadView('pdf.by-cash-register', $data->toArray());

        return $pdf->download("Reporte-{$date}.pdf"); */
    }

    public function byProduct(Request $request)
    {
        $product_id = $request->query('product_id');
        $user_id = $request->query('user_id');
        $period = $request->query('period');
        $date_start = $request->query('date_start');
        $date_end = $request->query('date_end');
        $month_start = $request->query('month_start');
        $month_end = $request->query('month_end');

        switch ($period) {
            case 'date':
                $initial_date = $date_start;
                $final_date = $date_start;
                break;
            case 'between_dates':
                $initial_date = $date_start;
                $final_date = $date_end;
                break;
            case 'month':
                $initial_date = Carbon::parse($month_start.'-01')->format('Y-m-d');
                $final_date = Carbon::parse($month_start.'-01')->endOfMonth()->format('Y-m-d');
                break;
            case 'between_months':
                $initial_date = Carbon::parse($month_start.'-01')->format('Y-m-d');
                $final_date = Carbon::parse($month_end.'-01')->endOfMonth()->format('Y-m-d');
                break;
        }

        $data = Movement::where('product_id', $product_id)
            ->with(['product', 'user', 'cashRegisterDetail.cashRegister'])
            ->when($user_id, function ($query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->whereDate('created_at', '>=', $initial_date)
            ->whereDate('created_at', '<=', $final_date)
            ->get();

        return $data;
    }
}
