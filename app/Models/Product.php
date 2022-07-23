<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
    ];

    public static $rules = [
        'description' => 'required|string|max:100',
        'price' => 'required|numeric',
    ];
}
