<?php

namespace LNPG\RolesAndPermissions\Interfaces;

interface GrantRoles
{
    public function grantRole( $model, string $role = '' ) {}

}