<?php

namespace LNPG\RolesAndPermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use LNPG\RolesAndPermissions\Database\Factories\PermissionFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'requested_controller',
        'requested_method'
    ];

    public function roles()
    {
        return $this->morphedByMany( 'LNPG\RolesAndPermissions\Models\Role', 'permissible' )->withTimestamps();
    }

    public function users()
    {
        return $this->morphToMany( User::class, 'userable' )->withTimestamps();
    }
    protected static function newFactory()
    {
        return PermissionFactory::new();
    }
}
