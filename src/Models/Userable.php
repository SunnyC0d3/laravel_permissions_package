<?php

namespace LNPG\RolesAndPermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LNPG\RolesAndPermissions\Database\Factories\UserableFactory;

class Userable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'userable_id',
        'userable_type',
    ];

    protected static function newFactory()
    {
        return UserableFactory::new();
    }
}