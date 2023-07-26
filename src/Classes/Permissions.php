<?php

declare( strict_types = 1 );

namespace LNPG\RolesAndPermissions\Classes;

use LNPG\RolesAndPermissions\Interfaces\CRUD;
use LNPG\RolesAndPermissions\Exceptions\PermissionsException;
use LNPG\RolesAndPermissions\Models\Permission;

class Permissions implements CRUD
{
    protected $db_table;

    public function __construct() 
    {
        $this->reset();
    }

    protected function reset()
    {
        $this->db_table = new Permission();
    }

    public function create( array $data ) : void
    {
        $this->reset();

        if( empty( $data ) )
            PermissionsException::emptyArguement();

        foreach( $data as $record )
        {
            $result = [];

            if( empty( $record ) )
                PermissionsException::emptyArguement();

            foreach( $record as $record_key => $record_value )
            {
                $result = $this->db_table->where( $record_key, $record_value );
            }

            if( $result->exists() )
                PermissionsException::exists();

            $record[ 'created_at' ] = now();
            $record[ 'updated_at' ] = now();

            $result->insert( $record );
        }
    }

    public function read( array $data = [] ) : \Illuminate\Support\Collection|array
    {
        $this->reset();

        $result = [];

        if( !empty( $data ) )
        {
            foreach( $data as $record )
            {
                foreach( $record as $record_key => $record_value )
                {
                    $result = $this->db_table->where( $record_key, $record_value );
                }
            }
        }

        return !empty( $result ) ? $result->get() : $result;
    }

    public function update( array $data ) : void
    {
        $this->reset();

        if( empty( $data ) )
            PermissionsException::emptyArguement();

        foreach( $data as $record )
        {
            $result = [];

            if( empty( $record ) )
                PermissionsException::emptyArguement();

            foreach( $record as $record_key => $record_value )
            {
                if( $record_key === 'id' && $record_value !== '' )
                    $result = $this->db_table->where( $record_key, $record_value );
            }

            if( $result === [] )
                PermissionsException::invalidKey( 'id' );

            if( $result->exists() )
            {
                $record[ 'updated_at' ] = now();
                $result->update( $record );
            }
        }
    }

    public function delete( array $data ) : void
    {
        $this->reset();

        if( empty( $data ) )
            PermissionsException::emptyArguement();
    
        foreach( $data as $record )
        {
            $result = [];

            if( empty( $record ) )
                PermissionsException::emptyArguement();

            foreach( $record as $record_key => $record_value )
            {
                $result = $this->db_table->where( $record_key, $record_value );
            }

            if( !empty( $result ) )
                $result->delete();
        }
    }
}
