<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashSettlement extends Model
{
    use HasFactory;

    public const P_CREATE = 'create settlement';

    public const P_READ = 'read settlement';

    public const P_UPDATE = 'update settlement';

    public const P_DELETE = 'delete settlement';

    protected $fillable = [
        'bill_200', 'bill_100', 'bill_50',
        'bill_20', 'bill_10', 'bill_5', 'bill_1',
        'total', 'cash_register_detail_id',
    ];
}
