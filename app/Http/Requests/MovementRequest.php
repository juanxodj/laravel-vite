<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'cash_register_id' => 'required',
            'product_id' => 'required',
        ];

        return $rules;
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
