<?php

namespace ViragHttpFoundation\Exception;

use Exception;

class FileUploadException extends Exception
{
    public function __construct($message = 'File upload error', $code = 500, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
