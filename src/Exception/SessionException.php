<?php

namespace Virag\HttpFoundation\Exception;

use Exception;

class SessionException extends Exception
{
    public function __construct($message = 'Session error', $code = 500, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
