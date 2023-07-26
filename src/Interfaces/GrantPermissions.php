<?php

namespace LNPG\RolesAndPermissions\Interfaces;

interface GrantPermissions
{
    public function grantPermission( $model, string $permission = '' ) {}

}