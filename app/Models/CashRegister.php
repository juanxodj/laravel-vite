<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CashRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    public static $rules = [
        'description' => 'required|string|max:100',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(CashRegisterDetail::class);
    }
}
