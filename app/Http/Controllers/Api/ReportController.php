<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CashRegisterDetail;

class ReportController extends Controller
{
    public function byCashRegister(CashRegisterDetail $detail)
    {
        return $detail;
    }
}
