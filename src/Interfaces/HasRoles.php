<?php

namespace LNPG\RolesAndPermissions\Interfaces;

interface HasRoles
{
    public function hasRole( $model, string $checkRole ) {}

}