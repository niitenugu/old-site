<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLES = [
        'owner' => 'Developer',
        'superadmin' => 'Director',
        'admin' => 'Center Head',
        'staff' => 'Staff',
    ];

    const ADMIN_GROUP = [
        'owner' => 'Developer',
        'superadmin' => 'Director',
        'admin' => 'Center Head',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'uid', 'is_active', 'image_url', 
        'image_name', 'phone', 'last_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'is_active' => 'boolean',
    ];

    //Accessors
    public function getPhotoAttribute()
    {
        $avatar = asset('admin_assets/img/icons/avatar.png');

        return ($this->image_url != '') ? $this->image_url : $avatar;
    }

    public function getPositionAttribute()
    {
        return self::ROLES[strtolower($this->role)];
    }

    public function getStatusAttribute()
    {
        return ($this->is_active) ? 'Active' : 'Deactivated';
    }
}
