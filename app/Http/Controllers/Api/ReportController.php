<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\CashRegisterDetail;
use App\Models\Movement;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function byCashRegister(Request $request, CashRegister $cash_register)
    {
        $date = $request->query('date');

        $data = CashRegisterDetail::with('movements.product', 'cashRegister')
            ->where('cash_register_id', $cash_register->id)
            ->whereDate('opening', '=', $date)
            ->first();

        return $data;

        return view('pdf.by-cash-register', $data);

        $pdf = Pdf::loadView('pdf.by-cash-register', $data->toArray());

        return $pdf->download("Reporte-{$cash_register['description']}-{$date}.pdf");
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
                $date_end = $date_start;
                $data = Movement::where('product_id', $product_id)
                    ->when($user_id, function ($query) use ($user_id) {
                        return $query->where('user_id', $user_id);
                    })
                    ->whereDate('created_at', '>=', $date_start)
                    ->whereDate('created_at', '<=', $date_end)
                    ->get();
                break;
            case 'between_dates':
                $data = Movement::where('product_id', $product_id)
                    ->when($user_id, function ($query) use ($user_id) {
                        return $query->where('user_id', $user_id);
                    })
                    ->whereDate('created_at', '>=', $date_start)
                    ->whereDate('created_at', '<=', $date_end)
                    ->get();
                break;
            case 'month':
                $month_start = Carbon::parse($month_start . '-01')->format('Y-m-d');
                $month_end = Carbon::parse($month_start . '-01')->endOfMonth()->format('Y-m-d');

                $data = Movement::where('product_id', $product_id)
                    ->when($user_id, function ($query) use ($user_id) {
                        return $query->where('user_id', $user_id);
                    })
                    ->whereDate('created_at', '>=', $month_start)
                    ->whereDate('created_at', '<=', $month_end)
                    ->get();
                break;
            case 'between_months':
                $month_start = Carbon::parse($month_start . '-01')->format('Y-m-d');
                $month_end = Carbon::parse($month_end . '-01')->endOfMonth()->format('Y-m-d');

                $data = Movement::where('product_id', $product_id)
                    ->when($user_id, function ($query) use ($user_id) {
                        return $query->where('user_id', $user_id);
                    })
                    ->whereDate('created_at', '>=', $month_start)
                    ->whereDate('created_at', '<=', $month_end)
                    ->get();
                break;
        }

        return $data;
    }
}
