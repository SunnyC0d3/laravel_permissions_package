<?php

namespace LNPG\RolesAndPermissions;

use Illuminate\Support\ServiceProvider;

use LNPG\RolesAndPermissions\Library\Permissions;
use LNPG\RolesAndPermissions\Library\HasPermissions;
use LNPG\RolesAndPermissions\Library\GrantPermissions;
use LNPG\RolesAndPermissions\Library\Roles;
use LNPG\RolesAndPermissions\Library\HasRoles;
use LNPG\RolesAndPermissions\Library\GrantRoles;

class RolesAndPermissionsProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( Permissions::class, function ( $app ) 
        {
            return new Permissions();
        });

        $this->app->bind( HasPermissions::class, function ( $app ) 
        {
            return new HasPermissions();
        });

        $this->app->bind( GrantPermissions::class, function ( $app ) 
        {
            return new GrantPermissions();
        });

        $this->app->bind( Roles::class, function ( $app ) 
        {
            return new Roles();
        });

        $this->app->bind( HasRoles::class, function ( $app ) 
        {
            return new HasRoles();
        });

        $this->app->bind( GrantRoles::class, function ( $app ) 
        {
            return new GrantRoles();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom( __DIR__ . '/Migrations' );
    }
}