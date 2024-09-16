<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response(string $message, mixed $data, int $code): Response
    {
        return response()->json([
            'message' => $message,
            'data' => $data ?? ''
        ], $code);
    }
}
