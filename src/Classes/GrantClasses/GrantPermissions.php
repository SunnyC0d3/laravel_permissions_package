<?php

declare( strict_types = 1 );

namespace LNPG\RolesAndPermissions\GrantClasses;

use LNPG\RolesAndPermissions\Classes\Permissions;
use LNPG\RolesAndPermissions\Interfaces\GrantPermissions as I_GrantPermissions;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GrantPermissions extends Permissions implements I_GrantPermissions
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function grantPermission( $model, string $permission = '' )
    {
        $this->reset();

        if( empty( $model ) )
            throw new ModelNotFoundException(); 

        if( $permission == '' )
            throw new \Exception( 'No route was provided.' );

        if( strpos( $permission, '@' ) === false )
            throw new \Exception( 'The correct route was not provided, must contain "controller@method".' );

        $r_controller = explode( '@', $permission )[0];
        $r_method = explode( '@', $permission )[1];

        $data = [
            'requested_controller' => $r_controller,
            'requested_method' => $r_method,
        ];

        $result = [];

        foreach( $data as $key => $value )
        {
            $result = $this->db_table->where( $key, $value );
        }

        if( ! $result->exists() )
            $this->create( array( $data ) );

        $permissions = $this->read( array( $data ) );

        foreach( $permissions as $p )
        {
            if( $r_controller == $p->requested_controller && $r_method == $p->requested_method ) 
            {
                $model->permissions()->attach( $p->id );
            }
        }
    }
}
