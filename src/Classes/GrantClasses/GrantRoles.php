<?php

declare( strict_types = 1 );

namespace LNPG\RolesAndPermissions\GrantClasses;

use LNPG\RolesAndPermissions\Exceptions\RolesException;
use LNPG\RolesAndPermissions\Interfaces\GrantRoles as I_GrantRoles;
use LNPG\RolesAndPermissions\Classes\Roles;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GrantRoles extends Roles implements I_GrantRoles
{
    protected $roles;

    public function __construct() 
    {
        parent::__construct();
    }

    public function grantRole( $model, string $role = '' )
    {
        $this->reset();

        if( empty( $model ) )
            throw new ModelNotFoundException(); 

        if( empty( $role ) )
            RolesException::emptyArguement();

        $data = [
            'role' => $role
        ];

        $result = [];

        foreach( $data as $key => $value )
        {
            $result = $this->db_table->where( $key, $value );
        }

        if( ! $result->exists() )
            $this->create( array( $data ) );

        $roles = $this->read( array( $data ) );

        foreach( $roles as $r )
        {
            if( $role == $r->role ) 
            {
                $model->roles()->attach( $r->id );
            }
        }
    }
}
