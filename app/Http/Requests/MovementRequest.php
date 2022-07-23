<?php

namespace App\Http\Requests;

use App\Models\Movement;
use Illuminate\Foundation\Http\FormRequest;

class MovementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return Movement::$rules;
    }

    public function attributes()
    {
        return [
            'type' => __('request.type'),
            'quantity' => __('request.quantity'),
            'amount' => __('request.amount'),
            'total' => __('request.total'),
            'cash_register_id' => __('request.cash_register'),
            'product_id' => __('request.product'),
        ];
    }
}
