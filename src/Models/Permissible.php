<?php

namespace LNPG\RolesAndPermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LNPG\RolesAndPermissions\Database\Factories\PermissibleFactory;

class Permissible extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_id',
        'permissible_id',
        'permissible_type',
    ];

    protected static function newFactory()
    {
        return PermissibleFactory::new();
    }
}