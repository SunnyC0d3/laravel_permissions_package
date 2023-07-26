<?php

declare( strict_types = 1 );

namespace LNPG\RolesAndPermissions\HasClasses;

use LNPG\RolesAndPermissions\Interfaces\HasPermissions;
use LNPG\RolesAndPermissions\Exceptions\PermissionsException;
use LNPG\RolesAndPermissions\Models\Permission;
use Illuminate\Support\Facades\Route;
use LNPG\RolesAndPermissions\Classes\Permissions;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class hasPermissionsAssociatedWithPermission extends Permissions implements HasPermissions
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

        foreach( $model->permissions as $permission )
        {
            if( $this->hasPermissionsAssociatedWithPermission( $permission, $p ) )
                return true;
        }
        
        return false;
    }

    protected function hasPermissionsAssociatedWithPermission( Permission $permission, string $route_controller )
    {
        if( empty( $permission ) )
            PermissionsException::notFound();

        if( $route_controller == '' )
            throw new \Exception( 'No route was provided.' );

        if( strpos( $route_controller, '@' ) === false )
            throw new \Exception( 'The correct route was not provided, must contain "controller@method".' );

        $r_controller = explode( '@', $route_controller )[0];
        $r_method = explode( '@', $route_controller )[1];

        if( $r_controller == $permission->requested_controller && $r_method == $permission->requested_method ) 
            return true;

        return false;
    }
}
