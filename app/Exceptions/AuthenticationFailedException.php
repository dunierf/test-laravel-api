<?php

namespace App\Exceptions;

use Exception;

class AuthenticationFailedException extends Exception
{
    function __construct($msg = 'Invalid credentials')
    {
        parent::__construct($msg);
    }
}
