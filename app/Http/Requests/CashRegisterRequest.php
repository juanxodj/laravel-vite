<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\CashRegister;
use Illuminate\Foundation\Http\FormRequest;

class CashRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return CashRegister::$rules;
    }

    public function attributes()
    {
        return [
            'description' => __('request.description'),
        ];
    }
}
