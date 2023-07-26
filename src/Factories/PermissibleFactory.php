<?php

namespace LNPG\RolesAndPermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LNPG\RolesAndPermissions\Models\Permissible;

class PermissibleFactory extends Factory
{
    protected $model = Permissible::class;

    public function definition()
    {
        return [
            'permission_id' => '',
            'permissible_id' => '',
            'permissible_type' => ''
        ];
    }
}
