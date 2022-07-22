<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'description' => 'required|string|max:100',
            'price' => 'required|decimal',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'description' => __('request.description'),
            'price' => __('request.price'),
        ];
    }
}
