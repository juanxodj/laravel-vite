<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CashRegister extends Model
{
    use HasFactory;

    public const P_CREATE = 'create cash register';

    public const P_READ = 'read cash register';

    public const P_UPDATE = 'update cash register';

    public const P_DELETE = 'delete cash register';

    public const P_DETAIL = 'read cash register detail';

    public const P_OPEN = 'open cash register';

    public const P_CLOSE = 'close cash register';

    public const P_SETTLEMENT = 'cash register settlement';

    public const P_REPORT = 'cash register report';

    protected $fillable = [
        'description', 'user_id',
    ];

    public static $rules = [
        'description' => 'required|string|max:100',
        'user_id' => 'required',
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
        return $this->user->name ?? '-';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
