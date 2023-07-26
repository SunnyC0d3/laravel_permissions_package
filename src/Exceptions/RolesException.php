<?php

namespace LNPG\RolesAndPermissions\Exceptions;

use \Exception;

class RolesException extends Exception
{
    public function __construct( $body = '', $code = 0, Throwable $previous = null ) 
    {
        parent::__construct( $body, $code, $previous );
    }

    public static function notFound()
    {
        throw new RolesException( "Role not found.", '1' );
    }

    public static function emptyArguement() 
    {
        throw new RolesException( "There are no values provided within the arguement. Please make sure it contains the correct values.", '256' );
    }

    public static function invalidKey( string $value ) 
    {
        throw new RolesException( 'The following key - "' . $value . '" cannot be found within the data provided. Please make sure the key provided is part of the array.', '256' );
    }

    public static function exists()
    {
        throw new RolesException( "Role already exists.", '1' );
    }

    public static function hasRole()
    {
        throw new RolesException( "User is already assigned this role.", '256' );
    }

    public function __toString() 
    {
        return __CLASS__ . ": [{ $this->code }]: { $this->body }\n";
    }
}

/** 
 * I want it to throw an exception elegantly
 * 
 * Clean way to use the library 
 */

// 0: This is the default exception code, which is used when no specific code is provided. It indicates that an error has occurred, but the exact nature of the error is not known.

// E_ERROR (1): This code indicates a fatal error that prevents the script from continuing. Examples include out-of-memory errors and undefined function errors.

// E_WARNING (2): This code indicates a non-fatal error that allows the script to continue. Examples include using undefined variables and passing the wrong number of arguments to a function.

// E_PARSE (4): This code indicates a parsing error in the script. Examples include syntax errors and unexpected tokens.

// E_NOTICE (8): This code indicates an issue that may cause problems in the future, but does not affect the current execution of the script. Examples include using uninitialized variables and accessing array indexes that do not exist.

// E_CORE_ERROR (16): This code indicates a fatal error that occurs during the initialization of PHP. Examples include errors in the PHP configuration file and missing extensions.

// E_CORE_WARNING (32): This code indicates a non-fatal error that occurs during the initialization of PHP. Examples include errors in the PHP configuration file and missing extensions.

// E_COMPILE_ERROR (64): This code indicates a fatal error that occurs during compilation of the script. Examples include syntax errors and undefined classes or functions.

// E_COMPILE_WARNING (128): This code indicates a non-fatal error that occurs during compilation of the script. Examples include using deprecated features and assigning values to constants.

// E_USER_ERROR (256): This code indicates a fatal error that is triggered by the user's code. Examples include invalid input and database connection errors.

// E_USER_WARNING (512): This code indicates a non-fatal error that is triggered by the user's code. Examples include using deprecated functions and failing to close resources.

// E_USER_NOTICE (1024): This code indicates an issue that is triggered by the user's code, but does not affect the functionality of the script. Examples include deprecated features and non-critical configuration errors.