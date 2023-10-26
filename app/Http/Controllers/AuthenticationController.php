<?php
namespace App\Http\Controllers;

use App\Dominio\Services\Login\ILoginService;
use App\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function __construct(
        private readonly ILoginService $loginService
    )
    { }

    public function login(LoginRequest $request): Response
    {
        return $this->Response(
            message: "Login com sucesso",
            data: $this->loginService->login($request),
            code: Response::HTTP_OK);
    }
    public function logout(): Response
    {
        return $this->Response(
            message: "Logout com sucesso",
            data: $this->loginService->logout(),
            code: Response::HTTP_OK
        );
    }
}
