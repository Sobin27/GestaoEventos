<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ForbiddenException extends SystemDefaultExceptions
{
    public function __construct(string $message = "Resource denied for this user")
    {
        parent::__construct($message);
    }

    function response(): Response
    {
        return response()->json($this->message, Response::HTTP_FORBIDDEN);
    }
}
