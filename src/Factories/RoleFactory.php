<?php

namespace LNPG\RolesAndPermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LNPG\RolesAndPermissions\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'role' => ''
        ];
    }
}
