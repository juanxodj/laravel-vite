<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:190',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'password' => 'string|min:6|max:200',
            'is_active' => 'required|boolean',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['email'] = 'email';
            $rules['password'] = 'nullable|string|min:6|max:200';
        }

        return $rules;
    }
}
