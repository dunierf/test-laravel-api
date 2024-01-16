<?php

namespace App\Exceptions;

use Exception;

class InsufficientPrivilegesException extends Exception
{
    function __construct($msg = 'Insufficient privileges')
    {
        parent::__construct($msg);
    }
}
