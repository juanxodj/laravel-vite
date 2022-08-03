<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return Product::$rules;
    }

    public function attributes()
    {
        return [
            'type' => __('request.type'),
            'description' => __('request.description'),
            'price' => __('request.price'),
        ];
    }
}
