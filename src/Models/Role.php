<?php

namespace LNPG\RolesAndPermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use LNPG\RolesAndPermissions\Database\Factories\RoleFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role'
    ];

    public function permissions()
    {
        return $this->morphToMany( 'LNPG\RolesAndPermissions\Models\Permission', 'permissible' )->withTimestamps();
    }

    public function users()
    {
        return $this->morphToMany( User::class, 'userable' )->withTimestamps();
    }

    protected static function newFactory()
    {
        return RoleFactory::new();
    }
}
