<?php

namespace LNPG\RolesAndPermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LNPG\RolesAndPermissions\Models\Field;

class FieldFactory extends Factory
{
    protected $model = Field::class;

    public function definition()
    {
        return [
            'column_name' => '',
            'model' => ''
        ];
    }
}
