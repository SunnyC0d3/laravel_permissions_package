<?php

namespace LNPG\RolesAndPermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LNPG\RolesAndPermissions\Models\Userable;

class UserableFactory extends Factory
{
    protected $model = Userable::class;

    public function definition()
    {
        return [
            'user_id' => '',
            'userable_id' => '',
            'userable_type' => ''
        ];
    }
}
