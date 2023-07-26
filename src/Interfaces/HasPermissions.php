<?php

namespace LNPG\RolesAndPermissions\Interfaces;

interface HasPermissions
{
    public function hasPermission( $model, string $p = '' ) {}

}