<?php

declare( strict_types = 1 );

namespace LNPG\RolesAndPermissions\HasClasses;

use LNPG\RolesAndPermissions\Exceptions\RolesException;
use LNPG\RolesAndPermissions\Classes\Roles;
use LNPG\RolesAndPermissions\Interfaces\HasRoles as I_HasRoles;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HasRoles extends Roles implements I_HasRoles
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function hasRole( $model, string $checkRole )
    {        
        if( ! $model->exists )
            throw new ModelNotFoundException();

        foreach( $model->roles as $role )
        {
            if( empty( $checkRole ) )
                RolesException::emptyArguement();

            if( $role->role === $checkRole )
                return true;
        }

        return false;
    }
}
