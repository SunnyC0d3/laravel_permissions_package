<?php

namespace LNPG\RolesAndPermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LNPG\RolesAndPermissions\Models\Permission;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition()
    {
        return [
            'requested_controller' => '',
            'requested_method' => ''
        ];
    }
}
