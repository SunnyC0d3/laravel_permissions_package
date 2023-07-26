<?php

namespace LNPG\RolesAndPermissions\Traits;

use LNPG\RolesAndPermissions\HasClasses\HasRoles;
use LNPG\RolesAndPermissions\GrantClasses\GrantRoles;

trait Roles
{
    public function hasRole( string $role )
    {
        $roles = new HasRoles();

        return $roles->hasRole( $this->getModel(), $role );
    }

    public function grantRole( string $role )
    {
        $roles = new GrantRoles();

        return $roles->grantRole( $this->getModel(), $role );
    }
}
