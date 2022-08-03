<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CashRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'user_id',
    ];

    public static $rules = [
        'description' => 'required|string|max:100',
    ];

    protected $appends = [
        'user_name',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(CashRegisterDetail::class);
    }

    public function getUsernameAttribute()
    {
        return $this->user->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
