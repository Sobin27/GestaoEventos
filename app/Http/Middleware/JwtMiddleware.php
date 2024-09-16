<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Http\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'Token expirado'], Response::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
        } catch (Exception $e) {
            return response()->json(['status' => 'Token não encontrado'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
