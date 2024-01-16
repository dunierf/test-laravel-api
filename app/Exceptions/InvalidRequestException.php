<?php

namespace App\Exceptions;

use Exception;

class InvalidRequestException extends Exception
{
    function __construct($msg = 'Please, send header Accept: application/json')
    {
        parent::__construct($msg);
    }
}
