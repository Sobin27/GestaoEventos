<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends SystemDefaultExceptions
{
    public function __construct(string $message = "Unauthorized access")
    {
        parent::__construct($message);
    }
    function response(): Response
    {
        return response()->json('Unauthorized access', Response::HTTP_UNAUTHORIZED);
    }
}
