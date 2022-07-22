<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'quantity',
        'amount', 'total',
        'cash_register_id', 'product_id',
        'user_id',
    ];
}
