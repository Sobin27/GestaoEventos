<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class HttpBadRequestException extends SystemDefaultExceptions
{
    function response(): Response
    {
        return response()->json($this->message, Response::HTTP_BAD_REQUEST);
    }
}
