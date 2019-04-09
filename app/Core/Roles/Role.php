<?php

namespace App\Core\Roles;

use Illuminate\Database\Eloquent\Model;

class Role extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public static function defaultRoles()
    {
        return [
            'Admin',
            'IT',
            'Finance',
            'Support',
        ];
    }
}
