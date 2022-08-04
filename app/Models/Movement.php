<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    public const P_CREATE = 'create movement';

    public const P_READ = 'read movement';

    public const P_UPDATE = 'update movement';

    public const P_DELETE = 'delete movement';

    protected $fillable = [
        'type', 'quantity',
        'amount', 'total',
        'cash_register_detail_id', 'product_id',
        'user_id',
    ];

    public static $rules = [
        'cash_register_detail_id' => 'required',
        'movements' => 'required|array',
        'total_expenses' => 'required',
        'total_incomes' => 'required',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
