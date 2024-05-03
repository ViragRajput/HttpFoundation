<?php

namespace Virag\HttpFoundation\Exception;

use Exception;

class InvalidRequestException extends Exception
{
    public function __construct($message = 'Invalid request', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
