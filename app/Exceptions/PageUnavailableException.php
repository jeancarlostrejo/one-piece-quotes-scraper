<?php

namespace App\Exceptions;

use Exception;

class PageUnavailableException extends Exception
{
    public function __construct(string $message = "The page you are trying to scrape is not available", int $code = 500, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }

}
