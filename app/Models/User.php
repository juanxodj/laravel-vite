<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens, HasRoles;

    public const P_CREATE = 'create user';

    public const P_READ = 'read user';

    public const P_UPDATE = 'update user';

    public const P_DELETE = 'delete user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'is_super_admin',
    ];

    public function getAclAttribute()
    {
        return [
            'show' => auth()->user()->can(self::P_READ),
            'update' => auth()->user()->can(self::P_UPDATE),
            'delete' => auth()->user()->can(self::P_DELETE),
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getIsSuperAdminAttribute()
    {
        return $this->hasRole(Role::ROLE_SUPER_ADMIN);
    }

    public function getIsActiveAttribute()
    {
        return $this->attributes['is_active'] ? true : false;
    }

    public function getRoleAttribute()
    {
        return optional($this->roles()->first())->name;
    }
}
