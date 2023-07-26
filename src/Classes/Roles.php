<?php

declare( strict_types = 1 );

namespace LNPG\RolesAndPermissions\Classes;

use LNPG\RolesAndPermissions\Interfaces\CRUD;
use LNPG\RolesAndPermissions\Exceptions\RolesException;
use LNPG\RolesAndPermissions\Models\Role;

class Roles implements CRUD
{
    protected $db_table;

    public function __construct() 
    {
        $this->reset();
    }

    protected function reset() : void 
    {
        $this->db_table = new Role();
    }

    public function create( array $data ) : void
    {
        $this->reset();

        if( empty( $data ) )
            RolesException::emptyArguement();

        foreach( $data as $record )
        {
            $result = [];

            if( empty( $record ) )
                RolesException::emptyArguement();

            foreach( $record as $record_key => $record_value )
            {
                $result = $this->db_table->where( $record_key, $record_value );
            }

            if( $result->exists() )
                RolesException::exists();

            $record[ 'created_at' ] = now();
            $record[ 'updated_at' ] = now();

            $result->insert( $record );
        }
    }

    public function read( array $data = [] ) : \Illuminate\Support\Collection|string
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
            RolesException::emptyArguement();

        foreach( $data as $record )
        {
            $result = [];

            if( empty( $record ) )
                RolesException::emptyArguement();

            foreach( $record as $record_key => $record_value )
            {
                if( $record_key === 'id' && $record_value !== '' )
                    $result = $this->db_table->where( $record_key, $record_value );
            }

            if( $result === [] )
                RolesException::invalidKey( 'id' );

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
            RolesException::emptyArguement();
    
        foreach( $data as $record )
        {
            $result = [];

            if( empty( $record ) )
                RolesException::emptyArguement();

            foreach( $record as $record_key => $record_value )
            {
                $result = $this->db_table->where( $record_key, $record_value );
            }

            if( !empty( $result ) )
                $result->delete();
        }
    }
}
