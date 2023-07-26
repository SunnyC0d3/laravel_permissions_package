<?php

declare( strict_types = 1 );

namespace LNPG\RolesAndPermissions\HasClasses;

use LNPG\RolesAndPermissions\Interfaces\HasPermissions;
use LNPG\RolesAndPermissions\Exceptions\PermissionsException;
use LNPG\RolesAndPermissions\Exceptions\RolesException;
use LNPG\RolesAndPermissions\Models\Role;
use Illuminate\Support\Facades\Route;
use LNPG\RolesAndPermissions\Classes\Permissions;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class hasPermissionsAssociatedWithRole extends Permissions implements HasPermissions
{

    public function __construct() 
    {
        parent::__construct();
    }

    public function hasPermission( $model, string $p = '' )
    {       
        if( ! $model->exists )
            throw new ModelNotFoundException(); 

        if( $p === '' )
            $p = Route::getCurrentRoute()->getAction()[ 'controller' ];

        foreach( $model->roles as $role )
        {
            if( $this->hasPermissionsAssociatedWithRole( $role, $p ) )
                return true;
        }
        
        return false;
    }

    protected function hasPermissionsAssociatedWithRole( Role $role, string $route_controller )
    {
        if( empty( $role ) )
            RolesException::notFound();

        if( $route_controller == '' )
            throw new \Exception( 'No route was provided.' );

        if( strpos( $route_controller, '@' ) === false )
            throw new \Exception( 'The correct route was not provided, must contain "controller@method".' );

        if( empty( $role->permissions ) )
            PermissionsException::notFound();
            
        $r_controller = explode( '@', $route_controller )[0];
        $r_method = explode( '@', $route_controller )[1];

        foreach( $role->permissions as $permission )
        {
            if( $r_controller == $permission->requested_controller && $r_method == $permission->requested_method ) 
                return true;
        }

        return false;
    }
}
