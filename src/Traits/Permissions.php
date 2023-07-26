<?php

namespace LNPG\RolesAndPermissions\Traits;

use LNPG\RolesAndPermissions\HasClasses\HasPermissionsAssociatedWithPermission;
use LNPG\RolesAndPermissions\HasClasses\HasPermissionsAssociatedWithRole;
use LNPG\RolesAndPermissions\GrantClasses\GrantPermissions;

trait Permissions
{
    public function hasPermission()
    {
        $permissions = new HasPermissionsAssociatedWithPermission();

        return $permissions->hasPermission( $this->getModel() );
    } 

    public function hasPermissionAssociatedToCurrentRole()
    {
        $permissions = new HasPermissionsAssociatedWithRole();

        return $permissions->hasPermission( $this->getModel() );
    }
    public function grantPermission( string $permission )
    {
        $permissions = new GrantPermissions();

        if( $this->hasPermission() || $this->hasPermissionAssociatedToCurrentRole() )
            return false;

        return $permissions->grantPermission( $this->getModel(), $permission );
    } 
}
