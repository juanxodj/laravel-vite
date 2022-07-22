<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'description' => 'required|string|max:100',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'description' => __('request.description'),
        ];
    }
}
