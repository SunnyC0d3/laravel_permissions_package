<?php
 
namespace LNPG\RolesAndPermissions\Middleware;
 
use Closure;

use Illuminate\Support\Facades\Route;
 
class PermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        $routeParameters = Route::current()->parameters();

        foreach ( $routeParameters as $model ) 
        {
            if( $model->hasPermission() || $model->hasPermissionAssociatedToCurrentRole() )
                return $next($request);
        }

        abort( 401 );
    }
}