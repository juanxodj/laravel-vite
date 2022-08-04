<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const P_CREATE = 'create product';

    public const P_READ = 'read product';

    public const P_UPDATE = 'update product';

    public const P_DELETE = 'delete product';

    protected $fillable = [
        'type',
        'description',
        'price',
    ];

    public static $rules = [
        'type' => 'required',
        'description' => 'required|string|max:100',
        'price' => 'required|numeric',
    ];

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strtoupper($value);
    }
}
