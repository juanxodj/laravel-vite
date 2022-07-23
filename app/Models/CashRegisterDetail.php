<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashRegisterDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'opening', 'closing',
        'initial_balance', 'ending_balance',
        'status', 'cash_register_id',
    ];

    public function cashRegister(): BelongsTo
    {
        return $this->belongsTo(CashRegister::class);
    }
}