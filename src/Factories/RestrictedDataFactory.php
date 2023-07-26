<?php

namespace LNPG\RolesAndPermissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LNPG\RolesAndPermissions\Models\RestrictedData;

class RestrictedDataFactory extends Factory
{
    protected $model = RestrictedData::class;

    public function definition()
    {
        return [
            'model' => '',
            'table_row_id' => ''
        ];
    }
}
